<?php
	global $Test_Custom_Menu;

	class Test_Custom_Menu {
		public function __construct() {
			add_filter( 'wp_setup_nav_menu_item', array( &$this, 'add_fields' ) );
			add_action( 'wp_update_nav_menu_item', array( &$this, 'update_fields' ), 10, 3 );
			add_filter( 'wp_edit_nav_menu_walker', array( &$this, 'edit_walker' ), 10, 2 );
		}

		function add_fields( $menu_item ) {

			$menu_item->icon = get_post_meta( $menu_item->ID, '_menu_item_icon', true );

			return $menu_item;

		}

		function update_fields( $menu_id, $menu_item_db_id, $args ) {

			// Check if element is properly sent
			if ( is_array( $_REQUEST['menu-item-icon'] ) ) {
				$icon_value = $_REQUEST['menu-item-icon'][ $menu_item_db_id ];
				update_post_meta( $menu_item_db_id, '_menu_item_icon', $icon_value );
			}

		}

		function edit_walker( $walker, $menu_id ) {
			return 'Walker_Nav_Menu_Edit';
		}
	}

	$Test_Custom_Menu = new Test_Custom_Menu();