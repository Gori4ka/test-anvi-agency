<?php
	get_header(); ?>

    <section id="primary" class="content-area col-sm-12 col-lg-8">
        <main id="main" class="site-main" role="main">

			<?php
				if ( have_posts() ) : ?>

                    <header class="page-header">
						<?php
							if ( is_home() && ! is_front_page() ) { ?>
                                <h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
							<?php } else {
								the_archive_title( '<h1 class="page-title">', '</h1>' );
								the_archive_description( '<div class="archive-description">', '</div>' );
							}
						?>
                    </header><!-- .page-header -->
                    <div class="row justify-content-md-center">
                        <hr class="divider divider-md bg-mantis">
                    </div>
                    <div class="col-md-10 col-lg-8 col-xl-12">
                        <div class="row">
							<?php
								$i              = 0;
								$posts_per_page = get_option( 'posts_per_page' );
								$paged          = get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1;

								while ( have_posts() ) {
									the_post();
									global $post;

									$post_counter = ( $posts_per_page * ( $paged - 1 ) ) + $i;
									$spacer       = $i % 2 ? '<div class="row-spacer offset-top-66 offset-xl-top-30"></div>' : '<div class="row-spacer offset-top-66 d-xl-none"></div>';
									$i ++;
									$title       = get_the_title();
									$link        = get_permalink( get_the_ID() );
									$image_id    = get_post_thumbnail_id();
									$description = text_excerpt( array(
										'maxchar' => 350,
										'text'    => get_the_content()
									) );
									$url         = get_permalink();
									$categories  = get_the_terms( get_the_ID(), 'category' );

									$image       = wp_get_attachment_image( $image_id, array(
										570,
										321
									), null, array(
										'class'  => 'img-fluid',
										'height' => '321',
										'width'  => '570'
									) );
									$placeholder = get_stylesheet_directory_uri() . '/assets/image/placeholder.jpg';
									if ( ! has_post_thumbnail( $post ) ) {
										$image = "<img width=\"570\" height=\"321\" src=\"{$placeholder}\" class=\"img-fluid\" alt=\"\">";
									}
									?>
                                    <div class="col-xl-6 blog-item">
                                        <!-- Post Boxed--><a class="d-block"
                                                             href="<?php echo $link; ?>">
                                            <div class="post post-boxed">
                                                <!-- Post media-->
                                                <header class="post-media"><?php echo $image; ?></header>
                                                <!-- Post content-->
                                                <section class="post-content text-left">

                                                    <div class="post-tags group-xs"><span
                                                                class="label-custom label-lg-custom label-primary"
                                                                style="background:red;"><?php echo $post_counter; ?></span>

														<?php if ( ! empty( $categories ) ) { ?><?php foreach ( $categories as $cat ) { ?>
                                                            <span class="label-custom label-lg-custom label-primary"><?php echo $cat->name ?></span>
														<?php } ?>

														<?php } ?>
                                                    </div>

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
									<?php
									//echo $spacer;
								} ?>
                        </div>
                    </div>
					<?php


					the_posts_navigation();

				else :

					get_template_part( 'template-parts/content', 'none' );

				endif; ?>

        </main><!-- #main -->
    </section><!-- #primary -->

<?php
	get_sidebar();
	get_footer();
