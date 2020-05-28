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

    // response status will be 'OK', if able to geocode given address
    if($resp['status']=='OK'){

        // get the important data
        foreach($resp['results'][0]['address_components'] as $item) {
            if($item['types'][0] == 'postal_code') {
                $zip_code = $item['long_name'];
            }
        }
        return $zip_code;

    }else{
        return false;
    }
}
// Sort drugs
function scriptsquareplugin_sort_drugs(&$drugs, $sort_by="Distance", $option=1)
{
    if($sort_by == "Distance") {
        if($option) {
            usort($drugs, function($a, $b) {
                return $a['Pharmacy']['Distance'] <=> $b['Pharmacy']['Distance'];
            });
        } else {
            usort($drugs, function($a, $b) {
                return $b['Pharmacy']['Distance'] <=> $a['Pharmacy']['Distance'];
            });
        }
    } else if($sort_by == 'g_price') {
        if($option) {
            usort($drugs, function($a, $b) {
                return $a['g_price'] <=> $b['g_price'];
            });
        } else {
            usort($drugs, function($a, $b) {
                return $b['g_price'] <=> $a['g_price'];
            });
        }
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
                foreach($drug_data as $data) {
                    $drug = [];
                    $drug['product_name'] = $data->Product_Name;
                    $drug['GPI'] = $data->GPI;
                    $drug['dosage_form'] = $data->Dosage_Form;
                    $drug['strength'] = $data->Strength;
                    $drug['full_name'] = $data->Drug_Name_Full;
                    $drug['type'] = $data->DrugType;
                    $drugs[$data->GPI] = $drug;
                }

                //Get GPI14 code from GPI10
                /*
                if(!empty($drugs)) {
                    foreach($drugs as $drug) {
                        $request = wp_remote_get($url . "drugs?gpi10=".$drug['gpi10'], $args);
                        if (is_wp_error($request)) {
                            $result['success'] = false;
                            $result['error_message'] = 'There was an error when making api call!';
                            return $result;
                        }

                        $body = wp_remote_retrieve_body($request);
                        $gpi10_data_array = json_decode($body);
                        print_r($gpi10_data_array);
                        if(isset($gpi10_data_array->message)) {
                            $result['success'] = false;
                            $result['error_message'] = $gpi10_data_array->message;
                            return $result;
                        } else {
                            foreach($gpi10_data_array as $gpi10_data) {
                                if(isset($drugs[$gpi10_data->GPI14])) {
                                    $drugs[$gpi10_data->Drug_Name_Full]['gpi14'] = $gpi10_data->GPI14;
                                } else {

                                }
                            }
                        }
                    }
                }
                */
                //Get NDC from GPI14
                $ndc_array = [];
                if(!empty($drugs)) {
                    foreach($drugs as $drug) {
                        $request = wp_remote_get($url . "drugs?gpi14=".$drug['GPI']."&DrugType=G&DrugName=SILDENAFIL_TAB_25MG", $args);
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
                                if(isset($drugs[$gpi14_data->GPI14])) {
                                    if(!isset($drugs[$gpi14_data->GPI14]['NDC'])) {
                                        $drugs[$gpi14_data->GPI14]['NDC'] = [
                                            'G' => [],
                                            'B' => []
                                        ];
                                    }
                                    //if generic
                                    if($gpi14_data->Multi_Source_Code == 'Y') {
                                        $drugs[$gpi14_data->GPI14]['NDC']['G'][] = [
                                            'NDC' => $gpi14_data->NDC,
                                            'Drug_Name_Full' => $gpi14_data->Drug_Name_Full
                                        ];
                                    } else {
                                        $drugs[$gpi14_data->GPI14]['NDC']['B'][] = [
                                            'NDC' => $gpi14_data->NDC,
                                            'Drug_Name_Full' => $gpi14_data->Drug_Name_Full
                                        ];
                                    }

                                    if(!in_array($gpi14_data->NDC, $ndc_array)) {
                                        $ndc_array[] = "".$gpi14_data->NDC;
                                    }
                                }
                            }
                        }
                    }
                }

                //Get Price from NDC and NDCPC
                //Paramount API has limit for pharmacy and drug sizes.
                $ncpdp_size = 70; $ndc_size = 40;
                $ncpdp_chunk = array_chunk($ncpdp_array, $ncpdp_size);
                $ndc_chunk = array_chunk($ndc_array, $ndc_size);

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
                /*
                foreach($price_array as $price) {
                    if($price->BrandGeneric == 'G') {
                        $search_result[] = [
                            'Cost'          => $price->Cost,
                            'Pharmacy'      => $zip_data[$price->NCPDP],
                            'Drug'          => $drugs[$price->NDC],
                            'BrandGeneric'  => $price->BrandGeneric
                        ];
                    }
                }
                */
                $drugs_with_pharmacies = [];
                foreach($drugs as $drug) {
                    $drugs_with_pharmacies[$drug['GPI']] = [
                        'drug' => $drug,
                        'pharmacy' => [],
                    ];
                    foreach($zip_data as $pharmacy) {
                        $g_price = 0; $g_count = 0;
                        $b_price = 0; $b_count = 0;
                        foreach($price_array as $price) {
                            foreach($drug['NDC']['G'] as $ndc) {
                                if($ndc['NDC'] == $price->NDC && $price->NCPDP == $pharmacy['NCPDP']) {
                                    $g_price += $price->Cost;
                                    $g_count++;
                                    break;
                                }
                            }
                            foreach($drug['NDC']['B'] as $ndc) {
                                if($ndc['NDC'] == $price->NDC) {
                                    $b_price += $price->Cost;
                                    $b_count++;
                                    break;
                                }
                            }
                        }
                        $drugs_with_pharmacies[$drug['GPI']]['pharmacy'][] = [
                            'pharmacy' => $pharmacy,
                            'g_price' => $g_price/$g_count,
                            'b_price' => $b_price/$b_count,
                        ];
                    }
                }

                foreach($drugs_with_pharmacies as $drug) {
                    foreach($drug['pharmacy'] as $pharmacy) {
                        $search_result[] = [
                            'b_price'       => $pharmacy['b_price'],
                            'g_price'       => $pharmacy['g_price'],
                            'Pharmacy'      => $pharmacy['pharmacy'],
                            'Drug'          => $drug['drug'],
                        ];
                    }
                }
                scriptsquareplugin_sort_drugs($search_result, 'Distance', 1);
            }

            update_option('scriptsquare_drugs_data', $search_result);

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
        $address = get_query_var( 'location_search' );

        $zip_code = scriptsquareplugin_geocode($address);

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

//function for phone number
function format_phone($country, $phone) {
	$function = 'format_phone_' . $country;
	if(function_exists($function)) {
		return $function($phone);
	}
	return $phone;
}

function format_phone_us($phone) {
	// note: making sure we have something
	if(!isset($phone{3})) { return ''; }
	// note: strip out everything but numbers
	$phone = preg_replace("/[^0-9]/", "", $phone);
	$length = strlen($phone);
	switch($length) {
		case 7:
			return preg_replace("/([0-9]{3})([0-9]{4})/", "$1-$2", $phone);
			break;
		case 10:
			return preg_replace("/([0-9]{3})([0-9]{3})([0-9]{4})/", "($1) $2-$3", $phone);
			break;
		case 11:
			return preg_replace("/([0-9]{1})([0-9]{3})([0-9]{3})([0-9]{4})/", "$1($2) $3-$4", $phone);
			break;
		default:
			return $phone;
			break;
	}
}
// end of function

//replace ajax call
function scriptsquare_ajax_get_listings() {
    $template_loader = new Listeo_Core_Template_Loader;
    $ss_template_loader = new ScriptSquare_Template_Loader;
/*
    $location  	= (isset($_REQUEST['location_search'])) ? sanitize_text_field( stripslashes( $_REQUEST['location_search'] ) ) : '';
    $keyword   	= (isset($_REQUEST['keyword_search'])) ? sanitize_text_field( stripslashes( $_REQUEST['keyword_search'] ) ) : '';
    $radius   	= (isset($_REQUEST['search_radius'])) ?  sanitize_text_field( stripslashes( $_REQUEST['search_radius'] ) ) : '';
*/

    $orderby   	= (isset($_REQUEST['listeo_core_order'])) ?  sanitize_text_field( stripslashes( $_REQUEST['listeo_core_order'] ) ) : '';
/*
    $style   	= sanitize_text_field( stripslashes( $_REQUEST['style'] ) );
    $grid_columns  = sanitize_text_field( stripslashes( $_REQUEST['grid_columns'] ) );
    $per_page   = sanitize_text_field( stripslashes( $_REQUEST['per_page'] ) );
    $date_range =  (isset($_REQUEST['date_range'])) ? sanitize_text_field( stripslashes( $_REQUEST['date_range'] ) ) : '';


    $region   	= (isset($_REQUEST['tax-region'])) ?  sanitize_text_field( stripslashes( $_REQUEST['tax-region'] ) ) : '';
    $category   	= (isset($_REQUEST['tax-listing_category'])) ?  sanitize_text_field( stripslashes( $_REQUEST['tax-listing_category'] ) ) : '';
    $feature   	= (isset($_REQUEST['tax-listing_feature'])) ?  sanitize_text_field( stripslashes( $_REQUEST['tax-listing_feature'] ) ) : '';

    $date_start = '';
    $date_end = '';

    if($date_range){

        $dates = explode(' - ',$date_range);
        $date_start = $dates[0];
        $date_end = $dates[1];

        // $date_start = esc_sql ( date( "Y-m-d H:i:s", strtotime(  $date_start )  ) );
     //    $date_end = esc_sql ( date( "Y-m-d H:i:s", strtotime( $date_end ) )  );

    }

    if(empty($per_page)) { $per_page = get_option('listeo_listings_per_page',10); }

    $query_args = array(
        'ignore_sticky_posts'    => 1,
        'post_type'         => 'listing',
        'orderby'           => $orderby,
        'order'             =>  $order,
        'offset'            => ( absint( $_REQUEST['page'] ) - 1 ) * absint( $per_page ),
        'location'   		=> $location,
        'keyword'   		=> $keyword,
        'search_radius'   	=> $radius,
        'posts_per_page'    => $per_page,
        'date_start'    	=> $date_start,
        'date_end'    		=> $date_end,
        'tax-region'    		=> $region,
        'tax-listing_feature'   => $feature,
        'tax-listing_category'  => $category,

    );

    $query_args['listeo_orderby'] = (isset($_REQUEST['listeo_core_order'])) ? sanitize_text_field( $_REQUEST['listeo_core_order'] ) : false;

    $taxonomy_objects = get_object_taxonomies( 'listing', 'objects' );
    foreach ($taxonomy_objects as $tax) {
        if(isset($_REQUEST[ 'tax-'.$tax->name ] )) {
            $query_args[ 'tax-'.$tax->name ] = $_REQUEST[ 'tax-'.$tax->name ];
        }
    }

    $available_query_vars = $this->build_available_query_vars();
    foreach ($available_query_vars as $key => $meta_key) {
        if(isset($_REQUEST[ $meta_key ])){
            $query_args[ $meta_key ] = $_REQUEST[ $meta_key ];
        }

    }


    // add meta boxes support

    $orderby = isset($_REQUEST['listeo_core_order']) ? $_REQUEST['listeo_core_order'] : 'date';


    // if ( ! is_null( $featured ) ) {
    // 	$featured = ( is_bool( $featured ) && $featured ) || in_array( $featured, array( '1', 'true', 'yes' ) ) ? true : false;
    // }


    $listings = Listeo_Core_Listing::get_real_listings( apply_filters( 'listeo_core_output_defaults_args', $query_args ));
    $result = array(
        'found_listings'    => $listings->have_posts(),
        'max_num_pages' => $listings->max_num_pages,
    );
*/
    $drugs = get_option('scriptsquare_drugs_data');

    $order = 'Distance';
    $direction = 1;
    if($orderby == 'distance-asc') {
        $order = 'Distance';
        $direction = 1;
    } else if($orderby == 'distance-desc') {
        $order = 'Distance';
        $direction = 0;
    } else if($orderby == 'price-asc') {
        $order = 'g_price';
        $direction = 1;
    } else if($orderby == 'price-desc') {
        $order = 'g_price';
        $direction = 0;
    }
    scriptsquareplugin_sort_drugs($drugs['content'], $order, $direction);
    update_option('scriptsquare_drugs_data', $drugs);

    ob_start();
    ?>
        <div class="loader-ajax-container" style=""> <div class="loader-ajax"></div> </div>
            <?php
                if ( $drugs['success'] ) :
                    $count = 0;
                    foreach($drugs['content'] as $drug) {
                        $count++;
                        if($count>20) break;
                        update_option('scriptsquare_drug', $drug);
                        $template_loader->get_template_part( 'content-listing' );
                    }
                else :
                    $ss_template_loader->get_template_part( 'archive/ss-no-found' );
                endif;
            ?>
            <div class="clearfix"></div>
        </div>
    <?php

    $result['html'] = ob_get_clean();
    $result['pagination'] = [];//listeo_core_ajax_pagination( $listings->max_num_pages, absint( $_REQUEST['page'] ) );

    wp_send_json($result);

}

// add custom option for drugs data
$scriptsquare_drugs_data = array();
add_option('scriptsquare_drugs_data', $scriptsquare_drugs_data);

$scriptsquare_drug = array();
add_option('scriptsquare_drug', $scriptsquare_drug);

// remove listeo core
remove_action('pre_get_posts', 'pre_get_posts_listings');
add_action('pre_get_posts', 'scriptsquare_pre_get_posts_listings');

remove_filter( 'template_include', 'listing_templates' );
add_filter( 'template_include', 'scriptsquare_listing_templates' );

// remove listeo core ajax action
remove_all_actions( 'wp_ajax_listeo_get_listings');
add_action( 'wp_ajax_listeo_get_listings', 'scriptsquare_ajax_get_listings' );


// custom plugin styles
function scriptsquareplugin_custom_styles() {
    wp_enqueue_style( 'scriptsquareplugin', plugin_dir_url( dirname( __FILE__ ) ) . 'public/css/scriptsquareplugin_style.css', array(), null, 'screen' );
    wp_enqueue_script( 'scriptsquareplugin', plugin_dir_url( dirname( __FILE__ ) ) . 'public/js/scriptsquareplugin_ajax.js', array('jquery') );
}
add_action( 'wp_enqueue_scripts', 'scriptsquareplugin_custom_styles' );
