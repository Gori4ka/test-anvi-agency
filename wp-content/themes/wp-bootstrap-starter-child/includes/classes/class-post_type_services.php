<?php

	if ( ! class_exists( 'Post_Type_Services' ) ) {
		class Post_Type_Services {
			public function __construct() {
				add_action( 'init', array( &$this, 'register_post_type' ), 0 );
			}

			// Register Custom Post Type
			function register_post_type() {

				$args = array(
					'label'               => __( 'Services', 'test_theme' ),
					'labels'              => array(
						'name'           => __( 'Services', 'test_theme' ),
						'singular_name'  => __( 'Services', 'test_theme' ),
						'menu_name'      => __( 'Services', 'test_theme' ),
						'name_admin_bar' => __( 'Services', 'test_theme' ),
					),
					'supports'            => array( 'title', 'editor','excerpt' ),
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
				register_post_type( 'service', $args );

			}
		}

		new Post_Type_Services();
	}