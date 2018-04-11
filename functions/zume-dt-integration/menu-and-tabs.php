<?php
/**
 * DT_Webform_Menu class for the admin page
 *
 * @class       DT_Webform_Menu
 * @version     0.1.0
 * @since       0.1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

/**
 * Class DT_Webform_Menu
 */
Zume_Integration_Menu::instance(); // Initialize class
class Zume_Integration_Menu
{
    public $token;

    private static $_instance = null;

    public static function instance()
    {
        if ( is_null( self::$_instance ) ) {
            self::$_instance = new self();
        }
        return self::$_instance;
    } // End instance()

    /**
     * Constructor function.
     *
     * @access  public
     * @since   0.1.0
     */
    public function __construct()
    {
        $this->token = 'site_link_system_settings';
        add_action( "admin_menu", [ $this, "register_menu" ] );

    } // End __construct()

    /**
     * Loads the subnav page
     *
     * @since 0.1.0
     */
    public function register_menu()
    {
        add_submenu_page( 'edit.php?post_type=site_link_system', __( 'Settings' ), __( 'Settings' ), 'manage_options', $this->token, [ $this, 'zume_content' ] );
    }

    /**
     * Combined tabs preprocessor
     */
    public function zume_content()
    {

        if ( ! current_user_can( 'manage_options' ) ) {
            wp_die( esc_attr__( 'You do not have sufficient permissions to access this page.' ) );
        }

        $title = __( 'DISCIPLE TOOLS - INTEGRATION' );

        $link = 'admin.php?page=' . $this->token . '&tab=';

        $tab_bar = [
            [
                'key' => 'zume_settings',
                'label' => __( 'Settings', 'dt_zume' ),
            ],
            [
                'key' => 'google_keys',
                'label' => __( 'Google Keys', 'dt_zume' ),
            ]
        ];

        // determine active tabs
        $active_tab = 'zume_settings';

        if ( isset( $_GET["tab"] ) ) {
            $active_tab = sanitize_key( wp_unslash( $_GET["tab"] ) );
        }

        $this->tab_loader( $title, $active_tab, $tab_bar, $link );
    }


    /**
     * Tab Loader
     *
     * @param $title
     * @param $active_tab
     * @param $tab_bar
     * @param $link
     */
    public function tab_loader( $title, $active_tab, $tab_bar, $link ) {
        ?>
        <div class="wrap">

            <h2><?php echo esc_attr( $title ) ?></h2>

            <h2 class="nav-tab-wrapper">
                <?php foreach ( $tab_bar as $tab) : ?>
                    <a href="<?php echo esc_attr( $link . $tab['key'] ) ?>"
                       class="nav-tab <?php echo ( $active_tab == $tab['key'] ) ? esc_attr( 'nav-tab-active' ) : ''; ?>">
                        <?php echo esc_attr( $tab['label'] ) ?>
                    </a>
                <?php endforeach; ?>
            </h2>

            <?php
            switch ( $active_tab ) {

                case "zume_settings":
                    $this->tab_zume_settings();
                    break;
                case "google_keys":
                    $object = new Zume_Keys_Tab();
                    $object->content();
                break;
                default:
                    break;
            }
            ?>

        </div><!-- End wrap -->

        <?php
    }

    public function tab_zume_settings() {
        // begin columns template
        $this->template( 'begin' );

        // Runs validation of the database when page is loaded.
        $object = new Zume_Integration();
        $object->verify_foreign_key_installed();
        $object->verify_foreign_key_installed_on_group();
        $object->verify_check_sum_installed();
        zume_get_public_site_links();

//        Zume_Site_Stats::temp_load_hook();

        $this->site_default_metabox();
        $this->session_complete_transfer_metabox();
        $this->check_for_session_limit_transfers();
        $this->check_for_location_data_installed();

        // begin right column template
        $this->template( 'right_column' );
        // end columns template
        $this->template( 'end' );
    }

    public function template( $section, $columns = 2 ) {
        switch ( $columns ) {

            case '1':
                switch ( $section ) {
                    case 'begin':
                        ?>
                        <div class="wrap">
                        <div id="poststuff">
                        <div id="post-body" class="metabox-holder columns-1">
                        <div id="post-body-content">
                        <!-- Main Column -->
                        <?php
                        break;


                    case 'end':
                        ?>
                        </div><!-- postbox-container 1 -->
                        </div><!-- post-body meta box container -->
                        </div><!--poststuff end -->
                        </div><!-- wrap end -->
                        <?php
                        break;
                }
                break;

            case '2':
                switch ( $section ) {
                    case 'begin':
                        ?>
                        <div class="wrap">
                        <div id="poststuff">
                        <div id="post-body" class="metabox-holder columns-2">
                        <div id="post-body-content">
                        <!-- Main Column -->
                        <?php
                        break;
                    case 'right_column':
                        ?>
                        <!-- End Main Column -->
                        </div><!-- end post-body-content -->
                        <div id="postbox-container-1" class="postbox-container">
                        <!-- Right Column -->
                        <?php
                    break;
                    case 'end':
                        ?>
                        </div><!-- postbox-container 1 -->
                        </div><!-- post-body meta box container -->
                        </div><!--poststuff end -->
                        </div><!-- wrap end -->
                        <?php
                        break;
                }
                break;
        }
    }

    public static function site_default_metabox()
    {
        // Check for post
        if ( isset( $_POST['dt_site_default_nonce'] ) && ! empty( $_POST['dt_site_default_nonce'] ) && wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['dt_site_default_nonce'] ) ), 'dt_site_default_'. get_current_user_id() ) ) {
            if ( isset( $_POST['default-site'] ) && ! empty( $_POST['default-site'] ) ) {
                $default_site = sanitize_key( wp_unslash( $_POST['default-site'] ) );
                update_option( 'zume_default_site', $default_site );
            }
        }
        $keys = Site_Link_System::get_site_keys();
        $current_key = get_option( 'zume_default_site' );

        ?>
        <form method="post" action="">
            <?php wp_nonce_field( 'dt_site_default_'. get_current_user_id(), 'dt_site_default_nonce', false, true ) ?>

            <!-- Box -->
            <table class="widefat striped">
                <thead>
                <tr>
                    <td>
                        <?php esc_html_e( 'Set Default Transfer Site' ) ?>
                    </td>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>
                        <select id="default-site" name="default-site">
                            <?php foreach ($keys as $key => $value ) : ?>
                                <option value="<?php echo esc_attr( $key ) ?>" <?php $current_key == $key ? print esc_attr( 'selected' ) : print '';  ?> >
                                    <?php echo esc_html( $value['label'] )?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </td>
                </tr>

                <tr>
                    <td>
                        <button class="button" type="submit"><?php esc_html_e( 'Update' ) ?></button>
                    </td>
                </tr>
                </tbody>
            </table>
            <br>
            <!-- End Box -->
        </form>
        <?php
    }

    public static function session_complete_transfer_metabox()
    {
        // Check for post
        if ( isset( $_POST['zume_session_complete_transfer_nonce'] ) && ! empty( $_POST['zume_session_complete_transfer_nonce'] ) && wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['zume_session_complete_transfer_nonce'] ) ), 'zume_session_complete_transfer_'. get_current_user_id() ) ) {
            if ( isset( $_POST['session-level'] ) && ! empty( $_POST['session-level'] ) ) {
                $session_level = sanitize_key( wp_unslash( $_POST['session-level'] ) );
                update_option( 'zume_session_complete_transfer_level', $session_level );
            }
        }
        $keys = [ 1,2,3,4,5,6,7,8,9,10 ];
        $current_key = get_option( 'zume_session_complete_transfer_level' );

        ?>
        <form method="post" action="">
            <?php wp_nonce_field( 'zume_session_complete_transfer_'. get_current_user_id(), 'zume_session_complete_transfer_nonce', false, true ) ?>

            <!-- Box -->
            <table class="widefat striped">
                <thead>
                <tr>
                    <td>
                        Session Level for Transfer
                    </td>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>
                        <select id="session-level" name="session-level">
                            <?php foreach ($keys as $value ) : ?>
                                <option value="<?php echo esc_attr( $value ) ?>" <?php $current_key == $value ? print esc_attr( 'selected' ) : print '';  ?> >
                                    <?php echo esc_html( $value )?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </td>
                </tr>

                <tr>
                    <td>
                        <button class="button" type="submit">Update</button>
                    </td>
                </tr>
                </tbody>
            </table>
            <br>
            <!-- End Box -->
        </form>
        <?php
    }

    public function check_for_session_limit_transfers()
    {
        $report = [];

        // Check for post
        if ( isset( $_POST['zume_check_for_transfer_nonce'] ) && ! empty( $_POST['zume_check_for_transfer_nonce'] ) && wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['zume_check_for_transfer_nonce'] ) ), 'zume_check_for_transfer_'. get_current_user_id() ) ) {
            if ( isset( $_POST['check-and-transfer'] ) && ! empty( $_POST['check-and-transfer'] ) ) {
                global $wpdb;
                $groups_meta = $wpdb->get_col(
                    $wpdb->prepare( "
                  SELECT meta_value 
                  FROM $wpdb->usermeta 
                  WHERE meta_key LIKE %s LIMIT 10000", // @todo Returning all results, but at some point we should limit this
                        $wpdb->esc_like( 'zume_group' ).'%'
                    )
                );

                $transfer_level = get_option( 'zume_session_complete_transfer_level' );

                foreach ($groups_meta as $v){
                    $fields = Zume_Dashboard::verify_group_array_filter( $v );
                    if ( $fields['next_session'] > $transfer_level ) {
                        try {
                            $send_new_user = new Zume_Integration_Session_Complete_Transfer();
                            $send_new_user->launch(
                                [
                                    'zume_group_key'    => $fields['key'],
                                    'owner_id'          => $fields['owner'],
                                ]
                            );
                            $report[] = 'Transfered: ' . $fields['key'];
                        } catch ( Exception $e ) {
                            dt_write_log( '@' . __METHOD__ );
                            dt_write_log( 'Caught exception: ', $e->getMessage(), "\n" );
                            $report[] = 'Failed Transfer: ' . $fields['key'];
                        }
                    }
                }
            }
        }

        ?>
        <form method="post" action="">
            <?php wp_nonce_field( 'zume_check_for_transfer_'. get_current_user_id(), 'zume_check_for_transfer_nonce', false, true ) ?>

            <!-- Box -->
            <table class="widefat striped">
                <thead>
                <tr>
                    <td>
                        Check and Transfer Qualified Records
                    </td>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>
                        <button class="button" name="check-and-transfer" value="1" type="submit">Check and Transfer</button>
                    </td>
                </tr>

                <!-- Results -->
                <?php if ( ! empty( $report ) ) : ?>
                    <tr>
                        <td>
                            <?php foreach ( $report as $result ) : print esc_html( $result ) . '<br>';
endforeach; ?>
                        </td>
                    </tr>
                <?php endif; ?>
                </tbody>
            </table>
            <br>
            <!-- End Box -->
        </form>
        <?php
    }

    public function check_for_location_data_installed()
    {
        $report = [];

        // Check for post
        if ( isset( $_POST['zume_location_nonce'] ) && ! empty( $_POST['zume_location_nonce'] ) && wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['zume_location_nonce'] ) ), 'zume_location_'. get_current_user_id() ) ) {
            if ( isset( $_POST['check-location'] ) && ! empty( $_POST['check-location'] ) ) {

                // build locations for groups
                global $wpdb;
                $groups_meta = $wpdb->get_col(
                    $wpdb->prepare( "
                  SELECT meta_value 
                  FROM $wpdb->usermeta 
                  WHERE meta_key LIKE %s",
                        $wpdb->esc_like( 'zume_group' ).'%'
                    )
                );

                foreach ($groups_meta as $v){
                    $fields = Zume_Dashboard::verify_group_array_filter( $v );
                    $updated = false;

                    if ( empty( $fields['raw_location'] ) && ! empty( $fields['address'] ) ) {
                        $google_result = Zume_Google_Geolocation::query_google_api( $fields['address'], $type = 'core' ); // get google api info
                        if ( $google_result ) {

                            $fields['lng'] = $google_result['lng'];
                            $fields['lat'] = $google_result['lat'];
                            $fields['address'] = $google_result['formatted_address'];
                            $fields['raw_location'] = $google_result['raw'];
                        }
                        $updated = true;
                        $report[] = 'Updated Group ' . $fields['key'] . ": Location";
                        dt_write_log( 'Updated Group ' . $fields['key'] . ": Location" );
                    }
                    if ( empty( $fields['ip_raw_location'] ) && ! empty( $fields['ip_address'] ) ) {
                        $results = Zume_Google_Geolocation::geocode_ip_address( $fields['ip_address'] );
                        if ( $results ) {
                            $fields['ip_lng'] = $results['lng'];
                            $fields['ip_lat'] = $results['lat'];
                            $fields['ip_raw_location'] = $results;
                        }
                        $updated = true;
                        $report[] = 'Updated Group ' . $fields['key'] . ": IP Location";
                        dt_write_log( 'Updated Group ' . $fields['key'] . ": IP Location" );
                    }

                    if ( $updated ) {

                        $fields['last_modified_date'] = current_time( 'mysql' );

                        update_user_meta( $fields['owner'], $fields['key'], $fields );
                    }
                }

                // build locations for users
                $users_with_addresses = $wpdb->get_results(
                    "SELECT * FROM $wpdb->usermeta WHERE meta_key = 'zume_user_address'", ARRAY_A
                );

                foreach ( $users_with_addresses as $value ) {
                    if ( empty( $value['meta_value'] ) ) {

                        dt_write_log( 'Empty value' );
                        dt_write_log( $value );
                        continue;
                    }
                    $results = Zume_Google_Geolocation::query_google_api( trim( sanitize_text_field( wp_unslash( $value['meta_value'] ) ) ), 'core' );

                    if ( $results ) {
                        update_user_meta( $value['user_id'], 'zume_user_lng', $results['lng'] );
                        update_user_meta( $value['user_id'], 'zume_user_lat', $results['lat'] );
                        update_user_meta( $value['user_id'], 'zume_raw_location', $results['raw'] );
                    }
                    $report[] = 'Updated User ' . $value['user_id'];
                    dt_write_log( 'Updated User ' . $value['user_id'] );
                }
            }
        }

        ?>
        <form method="post" action="">
            <?php wp_nonce_field( 'zume_location_'. get_current_user_id(), 'zume_location_nonce', false, true ) ?>

            <!-- Box -->
            <table class="widefat striped">
                <thead>
                <tr>
                    <td>
                        Check Locations Installed
                    </td>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>
                        <button class="button" name="check-location" value="1" type="submit">Check Location</button>
                    </td>
                </tr>

                <!-- Results -->
                <?php if ( ! empty( $report ) ) : ?>
                    <tr>
                        <td>
                            <?php foreach ( $report as $result ) : print esc_html( $result ) . '<br>';
endforeach; ?>
                        </td>
                    </tr>
                <?php endif; ?>
                </tbody>
            </table>
            <br>
            <!-- End Box -->
        </form>
        <?php
    }
}