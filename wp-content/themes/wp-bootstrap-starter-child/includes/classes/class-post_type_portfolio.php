<?php

	if ( ! class_exists( 'Post_Type_Portfolio' ) ) {
		class Post_Type_Portfolio {
			public function __construct() {
				add_action( 'init', array( &$this, 'register_post_type' ), 0 );
				add_action( 'init', array( &$this, 'register_taxonomy' ), 0 );
			}

			// Register Custom Post Type
			function register_post_type() {

				$args = array(
					'label'               => __( 'Portfolio', 'test_theme' ),
					'labels'              => array(
						'name'           => __( 'Portfolio', 'test_theme' ),
						'singular_name'  => __( 'Portfolio', 'test_theme' ),
						'menu_name'      => __( 'Portfolio', 'test_theme' ),
						'name_admin_bar' => __( 'Portfolio', 'test_theme' ),
					),
					'supports'            => array( 'title' ),
					'hierarchical'        => false,
					'public'              => true,
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
				register_post_type( 'portfolio', $args );

			}

			function register_taxonomy() {
				register_taxonomy( 'portfolio_cat', array( 'portfolio' ), array(
					'hierarchical' => true,
					'labels'       => array(
						'name'          => __( 'Category', 'test_theme' ),
						'singular_name' => __( 'Category', 'test_theme' ),
						'menu_name'     => __( 'Category' ),
					),
					'show_ui'      => true,
					'query_var'    => true,
				) );

			}
		}

		new Post_Type_Portfolio();
	}