<?php // ScriptSquare - Core Functionality

error_reporting(E_ALL);
ini_set('display_errors', 1);

// disable direct file access
if (!defined('ABSPATH')) {

    exit;
}

function scriptsquareplugin_geocode($address){

    // url encode the address
    $address = urlencode($address);
    $api_key = get_option( 'listeo_maps_api_server' );
    // google map geocode api url
    $url = "https://maps.google.com/maps/api/geocode/json?address={$address}&key={$api_key}";

    // get the json response
    $resp_json = wp_remote_get($url);

    $resp = json_decode( wp_remote_retrieve_body( $resp_json ), true );

    print_r($resp);
    // response status will be 'OK', if able to geocode given address
    if($resp['status']=='OK'){

        // get the important data
        $zip_code = $resp['results'][0]['address_components'][7]['long_name'];
        return $zip_code;

    }else{
        return false;
    }
}

// Get Drug By Name
function scriptsquareplugin_get_drug_by_name($drug_name, $zip_code)
{
    $result = [
        'success' => true,
        'error_message' => '',
    ];
    $options = get_option('scriptsquareplugin_options', scriptsquareplugin_options_default());

    if (isset($options['api_url']) && !empty($options['api_url'])) {

        $url = esc_url($options['api_url']);

        $args = [
            'headers' => array(
                'Content-Type' => 'application/json',
                'X-Api-Key' => $options['api_key'],
            )
        ];

        $zip_data = [];
        $ncpdp_array = [];

        if($zip_code){
            $request = wp_remote_get($url . "pharmacies?zip=".$zip_code."&radius=10", $args);

            if (is_wp_error($request)) {
                $result['success'] = false;
                $result['error_message'] = 'There was an error when making api call!';
                return $result;
            }

            $body = wp_remote_retrieve_body($request);

            $zip_data_array = json_decode($body);

            if(isset($zip_data_array->message)) {
                $result['success'] = false;
                $result['error_message'] = $zip_data_array->message;
                return $result;
            } else {
                foreach($zip_data_array as $pharmacy) {
                    $zip_data[$pharmacy->NCPDP] = [
                        'NCPDP'             => $pharmacy->NCPDP,
                        'NPI'               => $pharmacy->NPI,
                        'Pharmacy'          => $pharmacy->Pharmacy,
                        'StoreNumber'       => $pharmacy->StoreNumber,
                        'Address1'          => $pharmacy->Address1,
                        'Distance'          => $pharmacy->Distance,
                        'AffiliationCode'   => $pharmacy->AffiliationCode,
                        'Affiliation'       => $pharmacy->Affiliation,
                        'City'              => $pharmacy->City,
                        'State'             => $pharmacy->State,
                        'Zip'               => $pharmacy->Zip,
                        'Phone'             => $pharmacy->Phone,
                    ];
                    $ncpdp_array[] = "".$pharmacy->NCPDP;
                }
            }
        }

        $request = wp_remote_get($url . "drugs?drugname=".$drug_name."&includestrength=true", $args);

        if (is_wp_error($request)) {
            $result['success'] = false;
            $result['error_message'] = 'There was an error when making api call!';
            return $result;
        }

        $body = wp_remote_retrieve_body($request);

        $drug_data = json_decode($body);

        if(isset($drug_data->message)) {
            $result['success'] = false;
            $result['error_message'] = $drug_data->message;
            return $result;
        } else {
            $drugs = [];
            $search_result = [];

            if(empty($zip_data) || empty($drug_data)) {
                $drugs = [];
            } else {
                $gpi10_code = '';
                $gpi14_code = '';
                foreach($drug_data as $data) {
                    $drug = [];
                    $drug['product_name'] = $data->Product_Name;
                    $drug['gpi10'] = $data->GPI;
                    $drug['dosage_form'] = $data->Dosage_Form;
                    $drug['strength'] = $data->Strength;
                    $drug['full_name'] = $data->Drug_Name_Full;
                    $drug['type'] = $data->DrugType;
                    $drugs[$data->Drug_Name_Full] = $drug;
                    $gpi10_code = $data->GPI;
                }
                //Get GPI14 code from GPI10
                if(!empty($gpi10_code)) {
                    $request = wp_remote_get($url . "drugs?gpi10=".$gpi10_code, $args);
                    if (is_wp_error($request)) {
                        $result['success'] = false;
                        $result['error_message'] = 'There was an error when making api call!';
                        return $result;
                    }

                    $body = wp_remote_retrieve_body($request);
                    $gpi10_data_array = json_decode($body);
                    if(isset($gpi10_data_array->message)) {
                        $result['success'] = false;
                        $result['error_message'] = $gpi10_data_array->message;
                        return $result;
                    } else {
                        foreach($gpi10_data_array as $gpi10_data) {
                            if(isset($drugs[$gpi10_data->Drug_Name_Full])) {
                                $drugs[$gpi10_data->Drug_Name_Full]['gpi14'] = $gpi10_data->GPI14;
                            }
                        }
                    }
                }
                //Get NDC from GPI14
                $ndc_array = [];
                if(!empty($drugs)) {
                    foreach($drugs as $drug) {
                        $request = wp_remote_get($url . "drugs?gpi14=".$drug['gpi14'], $args);
                        if (is_wp_error($request)) {
                            $result['success'] = false;
                            $result['error_message'] = 'There was an error when making api call!';
                            return $result;
                        }

                        $body = wp_remote_retrieve_body($request);
                        $gpi14_data_array = json_decode($body);

                        if(isset($gpi14_data_array->message)) {
                            $result['success'] = false;
                            $result['error_message'] = $gpi14_data_array->message;
                            return $result;
                        } else {
                            foreach($gpi14_data_array as $gpi14_data) {
                                if(isset($drugs[$gpi14_data->Drug_Name_Full])) {
                                    $drugs[$gpi14_data->Drug_Name_Full]['NDC'] = $gpi14_data->NDC;
                                    $drugs[$gpi14_data->NDC] = $drugs[$gpi14_data->Drug_Name_Full];
                                    $ndc_array[] = "".$gpi14_data->NDC;
                                }
                            }
                        }
                    }
                }

                //Get Price from NDC and NDCPC
                //Paramount API has limit for pharmacy and drug sizes.
                $size = 70;
                $ncpdp_chunk = array_chunk($ncpdp_array, $size);
                $ndc_chunk = array_chunk($ndc_array, $size);

                $price_array = [];

                foreach($ncpdp_chunk as $ncpdp) {
                    foreach($ndc_chunk as $ndc) {
                        $body = [
                            'NCPDP'  => $ncpdp,
                            'NDC' => $ndc,
                            'Quantity' => 30
                        ];

                        $body = wp_json_encode( $body );
                        $args['body'] = $body;
                        $args['data_format'] = 'body';
                        $request = wp_remote_post($url . "drugprices", $args);
                        if (is_wp_error($request)) {
                            $result['success'] = false;
                            $result['error_message'] = 'There was an error when making api call!';
                            return $result;
                        }

                        $body = wp_remote_retrieve_body($request);
                        $price_data_array = json_decode($body);
                        if(isset($price_data_array->message)) {
                            $result['success'] = false;
                            $result['error_message'] = $price_data_array->message;
                            return $result;
                        } else {
                            $price_array = array_merge($price_array, $price_data_array);
                        }
                    }
                }

                //Get Result. Rearrange array with Pharmacy, Drug Info and Price
                foreach($price_array as $price) {
                    $search_result[] = [
                        'Cost'          => $price->Cost,
                        'Pharmacy'      => $zip_data[$price->NCPDP],
                        'Drug'          => $drugs[$price->NDC],
                        'BrandGeneric'  => $price->BrandGeneric
                    ];
                }
            }

            update_option('scriptsquare_drugs_data', $search_result);

            print_r($search_result); exit;
            $result['content'] = $search_result;
        }
    }

    return $result;
}

//replicate pre_get_posts_listings from class-listeo-core-search and remove unnecessary parts.
function scriptsquare_pre_get_posts_listings( $query ) {

    if ( is_admin() || ! $query->is_main_query() ){
        return $query;
    }

    if ( !is_admin() && $query->is_main_query() && is_post_type_archive( 'listing' ) ) {
        $per_page = get_option('listeo_listings_per_page',10);
        $query->set( 'posts_per_page', $per_page );
    }

    if ( is_tax('listing_category') || is_tax('service_category') || is_tax('event_category') || is_tax('rental_category') || is_tax('listing_feature')  || is_tax('region') ) {

        $per_page = get_option('listeo_listings_per_page',10);
        $query->set( 'posts_per_page', $per_page );
    }

    if ( is_post_type_archive( 'listing' ) || is_author() || is_tax('listing_category') || is_tax('listing_feature') || is_tax('event_category') || is_tax('service_category') || is_tax('rental_category') || is_tax('region')) {

        $ordering_args = Listeo_Core_Listing::get_listings_ordering_args( );

        if(isset($ordering_args['meta_key']) && $ordering_args['meta_key'] != '_featured' ){
            $query->set('meta_key', $ordering_args['meta_key']);
        }

        $query->set('orderby', $ordering_args['orderby']);
        $query->set('order', $ordering_args['order'] );

        $keyword = get_query_var( 'keyword_search' );
        $zip_code = get_query_var( 'location_search' );
        if(preg_match("/^\d+/", $zip_code, $matches)){
            $address = $matches[0];
            echo $address;
            $zip_code = scriptsquareplugin_geocode($address);
        }

        echo $zip_code; exit;
        $result = scriptsquareplugin_get_drug_by_name($keyword, $zip_code);

        update_option('scriptsquare_drugs_data', $result);

        $query->set('post_type', 'listing');

    }

    return $query;
}

/* handles single listing and archive listing view */
function scriptsquare_listing_templates( $template ) {
    $post_type = get_post_type();
    $custom_post_types = array( 'listing' );

    $ss_template_loader = new ScriptSquare_Template_Loader;
    $template_loader = new Listeo_Core_Template_Loader;
    if ( in_array( $post_type, $custom_post_types ) ) {

        if ( is_archive() && !is_author() ) {

            $template = $ss_template_loader->locate_template('ss-archive-' . $post_type . '.php');

            return $template;
        }

        if ( is_single() ) {
            $template = $template_loader->locate_template('single-' . $post_type . '.php');
            return $template;
        }
    }

    if( is_tax( 'listing_category' ) ){
        $template = $ss_template_loader->locate_template('ss-archive-listing.php');
    }

    if( is_post_type_archive( 'listing' ) ){
        $template = $ss_template_loader->locate_template('ss-archive-listing.php');
    }

    return $template;
}

// add custom option for drugs data
$scriptsquare_drugs_data = array();
add_option('scriptsquare_drugs_data', $scriptsquare_drugs_data);

// remove listeo core
remove_action('pre_get_posts', 'pre_get_posts_listings');
add_action('pre_get_posts', 'scriptsquare_pre_get_posts_listings');

// remove_filter( 'template_include', 'listing_templates' );
// add_filter( 'template_include', 'scriptsquare_listing_templates' );

// custom plugin styles
function scriptsquareplugin_custom_styles() {
    wp_enqueue_style( 'scriptsquareplugin', plugin_dir_url( dirname( __FILE__ ) ) . 'public/css/scriptsquareplugin_style.css', array(), null, 'screen' );
}
add_action( 'wp_enqueue_scripts', 'scriptsquareplugin_custom_styles' );
