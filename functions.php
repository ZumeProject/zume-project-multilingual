<?php
/**
 * Zume Project
 */

// Debugging Functions
require_once( 'functions/utilities/debugger-log.php' ); // debug logger used for development.
require_once( 'functions/utilities/global-functions.php' ); // debug logger used for development.

// Migration Engine
//try {
//    require_once( 'functions/class-migration-engine.php' );
//    Zume_Migration_Engine::migrate( 0 );
//} catch ( Throwable $e ) {
//    new WP_Error( 'migration_error', 'Migration engine failed to migrate.' );
//}

// Zume Tables Setup
global $wpdb;
//require_once 'functions/activator.php';
//$wpdb->zume_logging = $wpdb->prefix . 'zume_logging';

require_once( 'functions/post-types/video-post-type.php' );
require_once( 'functions/post-types/pdf-download-post-type.php' );
if ( is_admin() ) {
    require_once( 'functions/post-types/pieces-page-metabox.php' );
    require_once( 'functions/post-types/landing-template-metaboxes.php' );
}

// Language Files
require_once( 'translations/translation.php' ); // Adds support for multiple languages
require_once( 'functions/zume-polylang-integration.php' ); // Adds support for multiple languages
require_once( 'functions/network-dashboard-remote-integration.php' );
require_once( 'functions/yoast-integration.php' );

// Zume Theme Files
require_once( 'functions/login/zume-login.php' ); // Customize the login page
require_once( 'functions/enqueue-scripts.php' ); // Register scripts and stylesheets
if ( is_admin() ) {
    require_once( 'functions/utilities/tgm-config.php' ); // monitors required plugin dependencies
}

require_once( 'functions/utilities/theme-support.php' ); // Theme support options
require_once( 'functions/utilities/cleanup.php' ); // WP Head and other cleanup functions
require_once( 'functions/utilities/menu.php' ); // Register custom menus and menu walkers
require_once( 'functions/multi-role/multi-role.php' ); // Adds multi role features

require_once( 'functions/restrict-rest-api.php' ); // Restricts the default REST API to logged in users
remove_action( 'rest_api_init', 'create_initial_rest_routes', 99 );
require_once( 'functions/restrict-xml-rpc-pingback.php' ); // Restricts RPC vulnerability

// Zume 3.0 Files to Deprecate after 4.0 upgrade
require_once( 'functions/zume-course.php' ); // zume course
$zume_course = Zume_Course::instance();
require_once( 'functions/zume-dashboard.php' ); // zume dashboard
require_once( 'functions/zume-rest-api.php' );
// end 3.0


// zume 4.0
require_once( 'dt-mapping/loader.php' );
new DT_Mapping_Module_Loader( 'theme' );

require_once( 'functions/zume-v4-rest-api.php' );
require_once( 'functions/zume-v4-users.php' );
require_once( 'functions/zume-v4-groups.php' );
require_once( 'functions/zume-v4-progress.php' );
require_once( 'functions/zume-v4-pieces.php' );
require_once( 'functions/zume-v4-seo-strings.php' );
require_once( 'functions/zume-content.php' );
require_once( 'functions/zume-three-month-plan.php' );
require_once( 'functions/zume-v4-modal-pieces-content.php' );
//require_once( 'functions/logging/zume-logging.php' ); // zume logging of critical path actions

require_once( 'functions/zume-functions.php' ); // general zume functions
require_once( 'functions/logging/zume-mailchimp.php' ); //


// Zume - DT - Integration

require_once( 'functions/zume-dt-integration/site-link-post-type.php' );
Site_Link_System::instance();

// @todo remove section?
//require_once( 'functions/zume-dt-integration/wp-async-request.php' );
//require_once( 'functions/zume-dt-integration/zume.php' );
//require_once( 'functions/zume-dt-integration/zume-hooks.php' );
//require_once( 'functions/zume-dt-integration/zume-async-send.php' );
//require_once( 'functions/zume-dt-integration/zume-endpoints.php' );
//require_once( 'functions/zume-dt-integration/zume-site-stats.php' );
// end remove section?

require_once( 'functions/zume-v4-global-network-link.php' );


if ( is_admin() ) {
    require_once( 'functions/tab-keys.php' );
    require_once( 'functions/zume-dt-integration/menu-and-tabs.php' );
    require_once( 'functions/zume-resource-metabox.php' ); // zume logging of critical path actions
    require_once( 'functions/zume-dt-integration/system-check-metabox.php' );

    add_filter( 'manage_pages_columns', 'add_template_column' );
    add_action( 'manage_pages_custom_column', 'add_template_value', 10, 2 );
}

function add_template_column( $cols ) {
    $cols['template'] = 'Template';
    return $cols;
}
function add_template_value( $column_name, $post_id ) {
    if ( 'template' === $column_name ) {
        $template = get_post_meta( $post_id, '_wp_page_template', true );
        if ( isset( $template ) && $template ) {
            echo esc_html( $template );
        } else {
            echo 'None';
        }
    }

}




/**
 * redirect all logins to the home page
 */
add_filter( 'login_redirect', function( $url, $query, $user ) {
    return zume_dashboard_url();
}, 10, 3 );

function zume_mirror_url(){
    return 'https://storage.googleapis.com/zume-file-mirror/';
}

function zume_alt_video( $current_language = null ) {
    $alt_video = false;

    if ( ! $current_language ) {
        $current_language = zume_current_language();
    }

    if ( false /* disabled until added */ ) {
        // @todo add check for user preference
        $alt_video = true;
    }

    if ( ! $alt_video ) {
        $alt_video = ( 'id' === $current_language ); // @todo expand this if more than indonesian is a problem
    }

    return $alt_video;
}

/**
 * @return bool|mixed
 */
function zume_v4_ready_language() {
    $ready = array();

//    $ready['id'] = false;

    $current = zume_current_language();

    return $ready[$current] ?? true;
}

if ( ! function_exists( 'dt_recursive_sanitize_array' ) ) {
    function dt_recursive_sanitize_array( array $array ) : array {
        foreach ( $array as $key => &$value ) {
            if ( is_array( $value ) ) {
                $value = dt_recursive_sanitize_array( $value );
            }
            else {
                $value = sanitize_text_field( wp_unslash( $value ) );
            }
        }
        return $array;
    }
}




