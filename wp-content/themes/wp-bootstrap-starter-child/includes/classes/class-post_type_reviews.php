<?php

	if ( ! class_exists( 'Post_Type_Reviews' ) ) {
		class Post_Type_Reviews {
			public function __construct() {
				add_action( 'init', array( &$this, 'register_post_type' ), 0 );
			}

			// Register Custom Post Type
			function register_post_type() {

				$args = array(
					'label'               => __( 'Reviews', 'test_theme' ),
					'labels'              => array(
						'name'           => __( 'Reviews', 'test_theme' ),
						'singular_name'  => __( 'Reviews', 'test_theme' ),
						'menu_name'      => __( 'Reviews', 'test_theme' ),
						'name_admin_bar' => __( 'Reviews', 'test_theme' ),
					),
					'supports'            => array( 'title', 'editor' ),
					'hierarchical'        => false,
					'public'              => false,
					'show_ui'             => true,
					'show_in_menu'        => true,
					'menu_position'       => 5,
					'show_in_admin_bar'   => true,
					'show_in_nav_menus'   => true,
					'can_export'          => true,
					'has_archive'         => true,
					'exclude_from_search' => false,
					'publicly_queryable'  => true,
					'capability_type'     => 'page',
					'show_in_rest'        => false,
				);
				register_post_type( 'review', $args );

			}
		}

		new Post_Type_Reviews();
	}