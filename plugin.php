<?php
/*
	Plugin Name: Sorting WooCommerce Lite Edition
	Plugin URI: http://galalaly.me/
	Description: Change the labels of the dropdown menu
	Version: 1.0
	Author: Galal Aly
	Author URI: http://galalaly.me
*/


/**
 * Check if WooCommerce is active
 **/
if ( ! in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
    // WooCommerce is not active/installed
    function sorting_woocommerce_lite_admin_notice() {
    ?>
	    <div class="updated">
	        <p>WooCommerce is <strong>NOT</strong> active/installed. <strong>Sorting WooCommerce lite is not active.</strong></p>
	    </div>
	    <?php
	}
	add_action( 'admin_notices', 'sorting_woocommerce_lite_admin_notice' );
	return;
}


define( 'sorting_woocommerce_lite_path', plugin_dir_path(__FILE__) ); // path for the plugin's folder
define( 'sorting_woocommerce_lite_url', plugin_dir_url(__FILE__) ); // url for plugin's folder

if( ! class_exists('SortingWooCommerceLite') ) {

	/**
	* Class for the sorting thing
	*/
	class SortingWooCommerceLite
	{
		function __construct()
		{
			if( is_admin() ) {
				add_action( 'admin_init', array( &$this, 'admin_init' ) );
				add_action( 'admin_menu', array( &$this, 'menu' ) );
			}
			add_filter( 'woocommerce_catalog_orderby', array(&$this, 'generate_dropdown') );
			add_filter( 'woocommerce_default_catalog_orderby_options' , array(&$this, 'generate_dropdown') );

			$this->defaults = array(
				'menu_order' => __( 'Default sorting', 'woocommerce' ),
				'popularity' => __( 'Sort by popularity', 'woocommerce' ),
				'rating'     => __( 'Sort by average rating', 'woocommerce' ),
				'date'       => __( 'Sort by newness', 'woocommerce' ),
				'price'      => __( 'Sort by price: low to high', 'woocommerce' ),
				'price-desc' => __( 'Sort by price: high to low', 'woocommerce' )
			);

			$this->labels = $this->get_option( 'sorting-woocommerce-lite-options' );
		}

		function admin_init() {
			# Register settings - although i dun think i will need them
			register_setting( 'sorting-woocommerce-lite-options-group', 'sorting-woocommerce-lite-options', array( &$this, 'update_options' ) );
		}

		function menu() {
			add_submenu_page( 'woocommerce', 'Sorting WooCommerce lite', 'Sorting Attr.', 'create_users', 'sorting-woocommerce-lite/options.php', array( &$this, 'options_page' ) );
		}

		function options_page() {
			require_once( sorting_woocommerce_lite_path . '/options.php' );
		}

		function generate_dropdown( $sortby ) {
			foreach( $this->labels as $key => $data ) {
				if( !empty( $data['hide'] ) ) {
					unset( $sortby[ $key ] );
					continue;
				}
				if( empty( $data['label'] ) ) {
					$data['label'] = $this->defaults[ $key ];
				}
				$sortby[ $key ] = $data['label'];
			}
			return $sortby;
		}

		function get_option( $option ) {
			$return = get_transient( $option );
			if( empty( $return ) ) {
				$return = get_option( $option );
				set_transient( $option, $return, 0 );
			}
			return $return;
		}

		function update_options( $data ) {
			delete_transient( 'sorting-woocommerce-lite-options' );
			return $data;
		}
		
	} // end of class

} // end of class exists


$sorting_woocommerce_lite = new SortingWooCommerceLite;

?>