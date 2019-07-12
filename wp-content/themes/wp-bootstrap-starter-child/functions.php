<?php

	// Include php files
	include get_theme_file_path( 'includes/classes/class-post_type_portfolio.php' );
	include get_theme_file_path( 'includes/classes/class-post_type_reviews.php' );
	include get_theme_file_path( 'includes/classes/class-post_type_services.php' );
	include get_theme_file_path( 'includes/classes/class-walker_nav_menu_edit_custom.php' );
	include get_theme_file_path( 'includes/classes/class-test_custom_walker.php' );
	include get_theme_file_path( 'includes/classes/class-test_custom_menu.php' );
	include get_theme_file_path( 'includes/acf.php' );

	// Enqueue needed scripts
	add_action( 'wp_enqueue_scripts', 'needed_styles_and_scripts_enqueue' );
	function needed_styles_and_scripts_enqueue() {

		// Add-ons


		// Custom script
		wp_enqueue_script( 'owl.carousel.min.js', get_stylesheet_directory_uri() . '/assets/javascript/owl.carousel.min.js', array( 'jquery' ) );
		wp_enqueue_script( 'wpbs-custom-script', get_stylesheet_directory_uri() . '/assets/javascript/script.js', array( 'jquery' ) );

		// enqueue style
		wp_enqueue_style( 'owl.carousel.min.css', get_stylesheet_directory_uri() . '/assets/css/owl.carousel.min.css' );
		wp_enqueue_style( 'owl.theme.default.min.css', get_stylesheet_directory_uri() . '/assets/css/owl.theme.default.min.css' );
		wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
		wp_enqueue_style( 'custom-style', get_stylesheet_directory_uri() . '/assets/css/style.css' );

	}

	add_filter( 'widget_text', 'do_shortcode' );

	//Dynamic Year
	function site_year() {
		ob_start();
		echo date( 'Y' );
		$output = ob_get_clean();

		return $output;
	}

	add_shortcode( 'site_year', 'site_year' );

	add_image_size( 'portfolio-size', 570, 321, true );


	add_action( 'widgets_init', 'test_theme_unregister_sidebar', 11 );
	function test_theme_unregister_sidebar() {
		unregister_sidebar( 'footer-1' );
		unregister_sidebar( 'footer-2' );
		unregister_sidebar( 'footer-3' );
	}

	add_action( 'widgets_init', 'test_theme_register_sidebar', 12 );
	function test_theme_register_sidebar() {
		$widget_column = get_option( 'options_widget_column' );
		if ( $widget_column ) {
			foreach ( range( 1, $widget_column ) as $value ) {
				register_sidebar( array(
					'name'          => esc_html__( "Footer {$value}" ),
					'id'            => "footer-{$value}",
					'description'   => esc_html__( 'Add widgets here.' ),
					'before_widget' => '<section id="%1$s" class="widget %2$s">',
					'after_widget'  => '</section>',
					'before_title'  => '<h3 class="widget-title">',
					'after_title'   => '</h3>',
				) );
			}
		}

	}

	add_action( 'after_setup_theme', 'after_setup_theme_child' );
	function after_setup_theme_child() {
		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'footer' => esc_html__( 'Footer' ),
		) );

	}

	if ( ! function_exists( 'text_excerpt' ) ) {
		function text_excerpt( $args = '' ) {
			global $post;

			if ( is_string( $args ) ) {
				parse_str( $args, $args );
			}

			$rg = (object) array_merge( array(
				'maxchar'   => 350,
				'text'      => '',
				'autop'     => false,
				'save_tags' => '',
				'more_text' => '...',
			), $args );


			if ( ! $rg->text ) {
				$rg->text = $post->post_excerpt ? : $post->post_content;
			}

			$text = $rg->text;
			$text = preg_replace( '~\[([a-z0-9_-]+)[^\]]*\](?!\().*?\[/\1\]~is', '', $text );
			$text = preg_replace( '~\[/?[^\]]*\](?!\()~', '', $text );
			$text = trim( $text );

			// <!--more-->
			if ( strpos( $text, '<!--more-->' ) ) {
				preg_match( '/(.*)<!--more-->/s', $text, $mm );

				$text = trim( $mm[1] );

				$text_append = ' <a href="' . get_permalink( $post ) . '#more-' . $post->ID . '">' . $rg->more_text . '</a>';
			} // text, excerpt, content
			else {
				$text = trim( strip_tags( $text, $rg->save_tags ) );

				if ( mb_strlen( $text ) > $rg->maxchar ) {
					$text = mb_substr( $text, 0, $rg->maxchar );
					$text = preg_replace( '~(.*)\s[^\s]*$~s', '\\1 ...', $text ); // убираем последнее слово, оно 99% неполное
				}
			}

			// Сохраняем переносы строк. Упрощенный аналог wpautop()
			if ( $rg->autop ) {
				$text = preg_replace(
					array( "/\r/", "/\n{2,}/", "/\n/", '~</p><br ?/?>~' ),
					array( '', '</p><p>', '<br />', '</p>' ),
					$text
				);
			}

			if ( isset( $text_append ) ) {
				$text .= $text_append;
			}

			return ( $rg->autop && $text ) ? "<p>$text</p>" : $text;
		}
	}