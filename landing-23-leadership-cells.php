<?php
/*
Template Name: 23 - Leadership Cells
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
                        <section>
                            <!-- Step Title -->
                            <div class="grid-x grid-margin-x grid-margin-y">
                                <div class="step-title cell">
                                    <?php esc_html_e( 'Watch and Discuss (15min)', 'zume' ) ?>
                                </div> <!-- step-title cell -->
                            </div> <!-- grid-x -->

                            <!-- Activity Block  -->
                            <div class="grid-x grid-margin-x grid-margin-y">
                                <div class="large-3 cell activity-title"><?php esc_html_e( 'WATCH', 'zume' ) ?></div>
                                <div class="large-9 cell activity-description">
                                    <p>
                                        <?php esc_html_e( "Jesus said, “Whoever wishes to become great among you shall be your servant.”", 'zume' ) ?>
                                    </p>
                                    <p>
                                        <?php esc_html_e( "Jesus radically reversed our understanding of leadership by teaching us that if we feel called to lead, then we are being called to serve. A Leadership Cell is a way someone who feels called to lead can develop their leadership by practicing serving.", 'zume' ) ?>
                                    </p>
                                </div>
                            </div> <!-- grid-x -->

                            <!-- Inset Block -->
                            <div class="grid-x grid-margin-x grid-margin-y single">
                                <div class="cell auto"></div>
                                <div class="large-9 cell activity-description well">
                                    <div class="grid-x grid-padding-x grid-padding-y center" >
                                        <div class="cell session-boxes">
                                            <?php esc_html_e( "Find the \"Leadership Cells\" section in your Zúme Guidebook. When you're ready, watch and discuss this video.", 'zume' ) ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="cell auto"></div>
                            </div> <!-- grid-x -->

                            <!-- Video block -->
                            <div class="grid-x grid-margin-x grid-margin-y">
                                <div class="small-12 small-centered cell video-section">

                                    <!-- 23 -->
                                    <?php if ( $alt_video ) : ?>
                                        <video width="960" height="540" style="border: 1px solid lightgrey;margin: 0 15%;" controls>
                                            <source src="<?php echo esc_url( Zume_Course::get_alt_video_by_key( 'alt_23' ) ) ?>" type="video/mp4">
                                            Your browser does not support the video tag.
                                        </video>
                                    <?php else : ?>
                                        <iframe style="border: 1px solid lightgrey;"  src="<?php echo esc_url( Zume_Course::get_video_by_key( '23' ) ) ?>" width="560" height="315"
                                                frameborder="1"
                                                webkitallowfullscreen mozallowfullscreen allowfullscreen>
                                        </iframe>
                                    <?php endif; ?>

                                    <p class="center hide-for-small-only"><a
                                            href="<?php echo esc_url( Zume_Course::get_download_by_key( '55' ) ) ?>"
                                            target="_blank" rel="noopener noreferrer nofollow"><img
                                                src="<?php echo esc_url( zume_images_uri( 'course' ) ) ?>download-icon-150x150.png"
                                                alt=""
                                                width="35" height="35" class="alignnone size-thumbnail wp-image-3274"
                                                style="vertical-align: text-bottom"/> <?php esc_html_e( "Zúme Video Scripts: Leadership Cells", 'zume' ) ?></a></p>
                                </div>
                            </div> <!-- grid-x -->
                            <!-- Activity Block  -->
                            <div class="grid-x grid-margin-x grid-margin-y">
                                <div class="large-3 cell activity-title"><?php esc_html_e( 'DISCUSS', 'zume' ) ?></div>
                                <div class="large-9 cell activity-description">
                                    <ol>
                                        <li>
                                            <?php esc_html_e( "Is there a group of followers of Jesus you know that are already meeting or would be willing to meet and form a Leadership Cell to learn Zúme Training?", 'zume' ) ?>
                                        </li>
                                        <li> <?php esc_html_e( "What would it take to bring them together?", 'zume' ) ?></li>
                                    </ol>
                                </div>
                            </div> <!-- grid-x -->
                        </section>
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