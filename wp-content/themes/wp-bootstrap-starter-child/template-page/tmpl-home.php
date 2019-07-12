<?php
	/**
	 * Template Name: Home Page
	 */
	$services  = get_post_meta( get_the_ID(), 'services', true );
	$portfolio = get_posts( 'post_type=portfolio&posts_per_page-1' );
	$reviews   = get_posts( 'post_type=review' );

	get_header(); ?>

    <section id="primary" class="content-area col-sm-12">
        <main id="main" class="site-main" role="main">

			<?php
				while ( have_posts() ) {
					the_post(); ?>
					<?php if ( ! empty( $services ) && count( $services ) == 3 ) { ?>
                        <div class="container" id="services">
                            <div class="row">
								<?php foreach ( $services as $service_id ) {
									$service = get_post( $service_id );
									$icon    = get_post_meta( $service_id, 'icon', true );
									?>
                                    <div class="col-md-6 col-lg-4">
                                        <div class="feature-block">
                                            <i class="<?php echo $icon; ?> fa-6x"></i>
                                            <h4><?php echo $service->post_title ?></h4>
                                            <p><?php echo $service->post_excerpt; ?></p>
                                        </div>
                                    </div>
								<?php } ?>
                            </div>
                        </div>
					<?php } ?>
					<?php if ( ! empty( $portfolio ) ) { ?>
                        <div class="container" id="portfolio">
                            <div class="row justify-content-md-center">
                                <div class="col-md-10 col-lg-8 col-xl-12 text-center"><h2>Portfolio</h2>
                                    <hr class="divider divider-md bg-mantis">
                                </div>
                                <div class="col-md-10 col-lg-8 col-xl-12">
                                    <div class="row">
										<?php foreach ( $portfolio as $key => $value ) {
											$spacer      = $key % 2 ? '<div class="row-spacer offset-top-66 offset-xl-top-30"></div>' : '<div class="row-spacer offset-top-66 d-xl-none"></div>';
											$title       = $value->post_title;
											$link        = get_permalink( $value->ID );
											$image_id    = get_post_meta( $value->ID, 'image', true );
											$description = get_post_meta( $value->ID, 'description', true );
											$year        = get_post_meta( $value->ID, 'year', true );
											$url         = get_post_meta( $value->ID, 'link_portfolio', true );
											$categories  = get_the_terms( $value->ID, 'portfolio_cat' );
											if ( ! empty( $categories ) ) {

												$categories = wp_list_pluck( $categories, 'name' );

											}
											$image = wp_get_attachment_image( $image_id, array(
												570,
												321
											), null, array(
												'class'  => 'img-fluid',
												'height' => '321',
												'width'  => '570'
											) );
											?>
                                            <div class="col-xl-6">
                                                <!-- Post Boxed--><a class="d-block"
                                                                     href="<?php echo $link; ?>">
                                                    <div class="post post-boxed">
                                                        <!-- Post media-->
                                                        <header class="post-media"><?php echo $image; ?></header>
                                                        <!-- Post content-->
                                                        <section class="post-content text-left">
															<?php if ( ! empty( $categories ) ) { ?>
                                                                <div class="post-tags group-xs">
																	<?php foreach ( $categories as $cat ) { ?>
                                                                        <span class="label-custom label-lg-custom label-primary"><?php echo $cat ?></span>
																	<?php } ?>
                                                                </div>
															<?php } ?>
                                                            <div class="post-body">
                                                                <!-- Post Title-->
                                                                <div class="post-title">
                                                                    <h3 title="<?php echo $title; ?>"><?php echo $title; ?></h3>
                                                                </div>
                                                                <div class="post-meta small">
                                                                    <p><?php echo text_excerpt( array(
																			'maxchar' => 50,
																			'text'    => $description,
																		) ) ?></p>
                                                                </div>
                                                            </div>
                                                        </section>
                                                    </div>
                                                </a>
                                            </div>
											<?php echo $spacer; ?>
										<?php } ?>
                                    </div>
                                </div>
                            </div>
                        </div>
					<?php } ?>
					<?php if ( ! empty( $reviews ) ) { ?>

                        <section id="reviews" class="section parallax-container bg-gray-darkest"
                                 data-parallax-img="images/backgrounds/background-03-1920x900.jpg">
                            <div class="parallax-content context-dark">
                                <div class="container section-98 section-sm-110 text-center">
                                    <h2><span class="big">What Clients Say?</span></h2>
                                    <hr class="divider divider-md bg-mantis">
                                    <div class="row offset-top-66">
                                        <div class="owl-carousel owl-carousel-default owl-carousel-class-light veil-lg-owl-dots veil-owl-nav reveal-lg-owl-nav inset-left-7p inset-right-7p"
                                             data-mouse-drag="false" data-active="2" data-loop="false" data-dots="true"
                                             data-dots-custom=".owl-custom-pagination" data-nav="true"
                                             data-nav-class="[&quot;owl-prev mdi mdi-chevron-left&quot;, &quot;owl-next mdi mdi-chevron-right&quot;]">
											<?php foreach ( $reviews as $i => $review ) {
												$image_id = get_post_meta( $review->ID, 'image', true );
												$text     = get_post_meta( $review->ID, 'review', true );
												$name     = get_post_meta( $review->ID, 'name', true );
												$position = get_post_meta( $review->ID, 'position', true );
												$image    = wp_get_attachment_image( $image_id, 'thumbnail', null, array(
													'class'  => 'rounded-circle img-bordered-white img-fluid d-block mx-auto ',
													'width'  => 150,
													'height' => 150,
												) );
												$social   = get_field( 'social', $review->ID );
												?>
                                                <div>
                                                    <blockquote
                                                            class="quote quote-custom-image offset-top-0 offset-md-top-24">
														<?php echo $image; ?>
                                                        <p class="quote-body offset-top-34"><?php echo $text; ?></p>
                                                        <div class="offset-top-41">
                                                            <h3 class="font-accent"><?php echo $name; ?></h3>
                                                        </div>
                                                        <p class="text-uppercase font-weight-bold text-spacing-120 offset-top-10">
                                                            <span class="small text-malibu"><?php echo $position; ?></span>
                                                        </p>
                                                        <div class="social">
															<?php foreach ( $social as $soc ) { ?>
                                                                <a href="<?php echo $soc['link'] ?>" target="_blank"><i
                                                                            class="<?php echo $soc['icon'] ?>"></i></a>
															<?php } ?>
                                                        </div>
                                                    </blockquote>
                                                </div>
											<?php } ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
					<?php } ?>
				<?php } ?>
        </main><!-- #main -->
    </section><!-- #primary -->

<?php get_footer();
