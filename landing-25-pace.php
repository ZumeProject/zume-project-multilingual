<?php
/*
Template Name: 25 - Pace
*/
get_header();
if (have_posts()) :
    while (have_posts()) : the_post();
        ?>

        <!-- Wrappers -->
        <div id="content" class="grid-x grid-padding-x"><div  id="inner-content" class="cell">

                <!------------------------------------------------------------------------------------------------>
                <!-- Title section -->
                <!------------------------------------------------------------------------------------------------>
                <div class="grid-x grid-margin-x grid-margin-y vertical-padding">
                    <div class="medium-2 small-1 cell"></div><!-- Side spacer -->

                    <!-- Center column -->
                    <div class="medium-8 small-10 cell center">

                        <img src="<?php echo get_theme_file_uri() ?>/assets/images/zume_images/V5.1/1Waving1Not.svg" width="200px" />

                        <h1>
                            <strong><?php the_title(); ?></strong>
                        </h1>
                        <p>
                            <a href="/dashboard"><?php echo esc_html__( 'This concept comes from the Zúme Training Course', 'zume' ) ?> - <?php echo esc_html__('Session', 'zume' ) ?> 5</a>.
                        </p>
                    </div>

                    <div class="medium-2 small-1 cell"></div><!-- Side spacer -->
                </div>


                <!------------------------------------------------------------------------------------------------>
                <!-- Unique page content section -->
                <!------------------------------------------------------------------------------------------------>
                <div class="grid-x ">
                    <div class="large-2 cell"></div><!-- Side spacer -->

                    <!-- Center column -->
                    <div class="large-8 small-12 cell" id="training-content">
                        <section><!-- Step Title -->
                            <div class="grid-x grid-margin-x grid-margin-y">
                                <div class="step-title cell"><?php esc_html_e( 'Watch and Discuss (15min)', 'zume' ) ?></div>
                                <!-- step-title cell -->

                            </div>
                            <!-- grid-x -->

                            <!-- Activity Block -->
                            <div class="grid-x grid-margin-x grid-margin-y">
                                <div class="large-3 cell activity-title"><?php esc_html_e( 'WATCH', 'zume' ) ?></div>
                                <div class="large-9 cell activity-description">
                                    <?php esc_html_e( "Multiplying matters and multiplying quickly matters even more. Pace matters because where we all spend our eternity — an existence that outlasts time — is determined in the very short time we call “life.“", 'zume' ) ?>
                                </div>
                            </div>
                            <!-- grid-x -->

                            <!-- Video block -->
                            <div class="grid-x grid-margin-x grid-margin-y vertical-padding">
                                <div class="small-12 small-centered cell video-section">

                                    <!-- 25 -->
                                    <?php if ( $alt_video ) : ?>
                                        <video width="960" height="540" style="border: 1px solid lightgrey;margin: 0 15%;" controls>
                                            <source src="<?php echo esc_url( Zume_Course::get_alt_video_by_key( 'alt_25' ) ) ?>" type="video/mp4">
                                            Your browser does not support the video tag.
                                        </video>
                                    <?php else : ?>
                                        <iframe style="border: 1px solid lightgrey;"  src="<?php echo esc_url( Zume_Course::get_video_by_key( '25' ) ) ?>" width="560" height="315"
                                                frameborder="1"
                                                webkitallowfullscreen mozallowfullscreen allowfullscreen>
                                        </iframe>
                                    <?php endif; ?>

                                    <p class="center hide-for-small-only">
                                        <a  href="<?php echo esc_url( Zume_Course::get_download_by_key( '57' ) ) ?>"
                                            target="_blank" rel="noopener noreferrer nofollow" ><img
                                                class="alignnone size-thumbnail wp-image-3274"
                                                style="vertical-align: text-bottom;"
                                                src="<?php echo esc_url( zume_images_uri( 'course' ) ) ?>download-icon-150x150.png"
                                                alt="" width="35" height="35"/>
                                            <?php esc_html_e( "Zúme Video Scripts: Pace", 'zume' ) ?>
                                        </a>
                                    </p>
                                </div>
                            </div>
                            <!-- grid-x -->
                            <!-- Activity Block -->
                            <div class="grid-x grid-margin-x grid-margin-y">
                                <div class="large-3 cell activity-title"><?php esc_html_e( 'DISCUSS', 'zume' ) ?></div>
                                <div class="large-9 cell activity-description">
                                    <ol>
                                        <li><?php esc_html_e( "Why is pace important?", 'zume' ) ?></li>
                                        <li>
                                            <?php esc_html_e( "What do you need to change in your thinking, your actions, or your attitude to be better aligned with God's priority for pace?", 'zume' ) ?>
                                        </li>
                                        <li><?php esc_html_e( "What is one thing you can do starting this week that will make a difference?", 'zume' ) ?></li>
                                    </ol>
                                </div>
                            </div>
                            <!-- grid-x -->

                        </section><!-- Step -->
                    </div>

                    <div class="large-2 cell"></div><!-- Side spacer -->
                </div> <!-- grid-x -->


                <!------------------------------------------------------------------------------------------------>
                <!-- Share section -->
                <!------------------------------------------------------------------------------------------------>
                <div class="grid-x ">
                    <div class="large-2 cell"></div><!-- Side spacer -->

                    <!-- Center column -->
                    <div class="large-8 small-12 cell">

                        <?php get_template_part( 'parts/p', 'share' ); ?>

                    </div>
                    <div class="large-2 cell"></div><!-- Side spacer -->
                </div> <!-- grid-x -->


                <!------------------------------------------------------------------------------------------------>
                <!-- Transcription section -->
                <!------------------------------------------------------------------------------------------------>
                <div class="grid-x">
                    <div class="large-2 cell"></div><!-- Side spacer -->

                    <!-- Center column -->
                    <div class="large-8 small-12 cell">
                        <hr>
                        <div class="grid-x grid-margin-x grid-margin-y">
                            <div class="large-12 cell activity-description-no-border center">
                                <h3 class="center"><?php echo esc_html__('Video Transcript', 'zume' ) ?></h3>
                            </div>
                            <div class="large-12 cell activity-description-no-border">

                                <?php the_content(); ?>

                            </div>
                        </div>

                    </div>


                    <div class="large-2 cell"></div><!-- Side spacer -->
                </div> <!-- grid-x -->

            </div> <!-- end #inner-content --></div> <!-- end #content -->

    <?php
    endwhile;
endif;
get_footer();