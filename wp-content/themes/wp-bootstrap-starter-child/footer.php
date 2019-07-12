<?php
	/**
	 * The template for displaying the footer
	 *
	 * Contains the closing of the #content div and all content after.
	 *
	 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
	 *
	 * @package WP_Bootstrap_Starter
	 */

?>
<?php if ( ! is_page_template( 'blank-page.php' ) && ! is_page_template( 'blank-page-with-container.php' ) ): ?>
    </div><!-- .row -->
    </div><!-- .container -->
    </div><!-- #content -->
	<?php get_template_part( 'footer-widget' ); ?>
    <footer id="colophon" class="site-footer <?php echo wp_bootstrap_starter_bg_class(); ?>" role="contentinfo">
        <div class="container">
            <div class="row">
                <div class="site-info col-12 col-md-6">    <?php echo do_shortcode( get_option( 'options_copyright' ) ); ?></div>
                <!-- close .site-info -->
                <div class="col-12 col-md-6">
                    <nav class="navbar navbar-expand-xl p-0">
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#footer-nav"
                                aria-controls="" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>

						<?php
							wp_nav_menu( array(
								'theme_location'  => 'footer',
								'container'       => 'div',
								'container_id'    => 'footer-nav',
								'container_class' => 'collapse navbar-collapse justify-content-end',
								'menu_id'         => false,
								'menu_class'      => 'navbar-nav',
								'depth'           => 1,
								'fallback_cb'     => 'wp_bootstrap_navwalker::fallback',
								'walker'          => new Test_Custom_Walker()
							) );
						?>

                    </nav>
                </div>
            </div>
    </footer><!-- #colophon -->
<?php endif; ?>
</div><!-- #page -->

<?php wp_footer(); ?>
</body>
</html>