<?php // ScriptSquare - Core Functionality

error_reporting(E_ALL);
ini_set('display_errors', 1);

// disable direct file access
if (!defined('ABSPATH')) {

    exit;
}



// Get Drug By Name
function scriptsquareplugin_get_drug_by_name($drug_name)
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

        $request = wp_remote_get($url . "drugs?drugname=".$drug_name."&includestrength=false", $args);

        if (is_wp_error($request)) {
            $result['success'] = false;
            $result['error_message'] = 'There was an error when making api call!';
            return $result;
        }

        $body = wp_remote_retrieve_body($request);

        $data = json_decode($body);

        if(isset($data->message)) {
            $result['success'] = false;
            $result['error_message'] = $data->message;
            return $result;
        } else {
            $drugs = [];
            update_option('scriptsquare_drugs_data', $data);
            /*
            foreach($data as $item) {
                $drug = [
                    'Item_Status_Flag'          => $item->Item_Status_Flag,
                    'Dosage_Form'               => $item->Dosage_Form,
                    'Dosage_Form2'              => $item->Dosage_Form2,
                    'GPI10'                     => $item->GPI10,
                    'Maintenance_Drug_Code'     => $item->Maintenance_Drug_Code,
                    'RX_OTC_Indicator_Code'     => $item->RX_OTC_Indicator_Code,
                    'Product_Name'              => $item->Product_Name,
                    'Rx_Rank_Code'              => $item->Rx_Rank_Code,
                    'Repackage_Code'            => $item->Repackage_Code,
                    'Route_of_Administration'   => $item->Route_of_Administration,
                    'Third_Party_Restriction_Code'          => $item->Third_Party_Restriction_Code,
                    'Unit_Dose_Unit_of_Use_Package_Code'    => $item->Unit_Dose_Unit_of_Use_Package_Code,
                ];
                echo '<pre>';
                print_r($drug);
                $request = wp_remote_get($url . "drugs?gpi10=".$item->GPI10, $args);
                if (is_wp_error($request)) {
                    $result['success'] = false;
                    $result['error_message'] = 'There was an error when making api call!';
                    return $result;
                }

                $body = wp_remote_retrieve_body($request);
                $gpi10_data = json_decode($body);
                if(isset($gpi10_data->message)) {
                    $result['success'] = false;
                    $result['error_message'] = $gpi10_data->message;
                    return $result;
                } else {
                    print_r($gpi10_data);
                    exit;
                }
            }
            */
            $result['content'] = $data;
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

        $result = scriptsquareplugin_get_drug_by_name($keyword);

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

remove_filter( 'template_include', 'listing_templates' );
add_filter( 'template_include', 'scriptsquare_listing_templates' );

// custom plugin styles
function scriptsquareplugin_custom_styles() {
    wp_enqueue_style( 'scriptsquareplugin', plugin_dir_url( dirname( __FILE__ ) ) . 'public/css/scriptsquareplugin_style.css', array(), null, 'screen' );
}
add_action( 'wp_enqueue_scripts', 'scriptsquareplugin_custom_styles' );
