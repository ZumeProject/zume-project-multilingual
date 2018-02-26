<?php

/**
 * Changes the logo link from wordpress.org to your site
 */
function zume_login_url() {
    return site_url();
}
add_filter( 'login_headerurl', 'zume_login_url' );

/**
 * Changes the alt text on the logo to show your site name
 */
function zume_login_title() {
    return get_option( 'blogname' );
}
add_filter( 'login_headertitle', 'zume_login_title' );


/**
 * redirect all logins to the home page
 */
add_filter( 'login_redirect', function( $url, $query, $user ) {
    return home_url();
}, 10, 3 );
