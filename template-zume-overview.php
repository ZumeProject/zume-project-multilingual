<?php
/*
Template Name: Zúme Overview
*/

get_header();

?>

    <div id="content">

        <div id="inner-content" class="row">

            <div id="main" class="large-12 medium-12 columns" role="main">

                <?php
                /**
                 * Zúme Overview Content Loader
                 *
                 * @param 'id' in the url the id and session number is used to call the correct session.
                 */

                $zume_session = 1;
                $zume_language = zume_current_language();
                if ( is_wp_error( $zume_language ) ) {
                    $zume_language = 'en';
                }

                Zume_Overview::load_sessions( $zume_session, $zume_language );

                ?>

            </div> <!-- end #main -->

        </div> <!-- end #inner-content -->

    </div> <!-- end #content -->

<?php get_footer(); ?>
