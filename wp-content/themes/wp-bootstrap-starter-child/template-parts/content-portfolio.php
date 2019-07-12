<?php
	$image_id    = get_post_meta( get_the_ID(), 'image', true );
	$description = get_post_meta( get_the_ID(), 'description', true );
	$year        = get_post_meta( get_the_ID(), 'year', true );
	$url         = get_post_meta( get_the_ID(), 'link_portfolio', true );
	$categories  = get_the_terms( get_the_ID(), 'portfolio_cat' );
	if ( ! empty( $categories ) ) {

		$categories = wp_list_pluck( $categories, 'name' );
		$categories = implode( ', ', $categories );

	}
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php
		$enable_vc = get_post_meta( get_the_ID(), '_wpb_vc_js_status', true );
		if ( ! $enable_vc ) {
			?>
            <header class="entry-header">
				<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
            </header><!-- .entry-header -->
		<?php } ?>

    <div class="entry-content">
        <div class="container">
            <div class="row">
                <div class="col-8"><?php echo wp_get_attachment_image( $image_id, 'full' ); ?></div>
                <div class="col-4">
                    <div>
                        <div class="portfolio-navigation"><?php the_post_navigation( array(
								'next_text' => '',
								'prev_text' => '',
							) ); ?></div>
                        <div class="portfolio-description"><?php echo wpautop( $description ); ?></div>
                        <div class="portfolio-year">
                            <div><strong><?Php _e( 'Year', 'test_theme' ) ?></strong></div>
                            <div><?php echo $year; ?></div>
                        </div>
                        <div class="portfolio-url">
                            <div><strong><?Php _e( 'URL', 'test_theme' ) ?></strong></div>
                            <div><?php echo popuplinks(make_clickable( $url['url'] )); ?></div>
                        </div>
                        <div class="portfolio-categories">
                            <div><strong><?Php _e( 'Categories', 'test_theme' ) ?></strong></div>
                            <div><?php echo $categories; ?></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'wp-bootstrap-starter' ),
				'after'  => '</div>',
			) );
		?>
    </div><!-- .entry-content -->

	<?php if ( get_edit_post_link() && ! $enable_vc ) : ?>
        <footer class="entry-footer">
			<?php
				edit_post_link(
					sprintf(
					/* translators: %s: Name of current post */
						esc_html__( 'Edit %s', 'wp-bootstrap-starter' ),
						the_title( '<span class="screen-reader-text">"', '"</span>', false )
					),
					'<span class="edit-link">',
					'</span>'
				);
			?>
        </footer><!-- .entry-footer -->
	<?php endif; ?>
</article><!-- #post-## -->
