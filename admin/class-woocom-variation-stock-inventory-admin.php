<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       http://sahilbuddhadev.me/
 * @since      1.0.0
 *
 * @package    Woocom_Variation_Stock_Inventory
 * @subpackage Woocom_Variation_Stock_Inventory/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Woocom_Variation_Stock_Inventory
 * @subpackage Woocom_Variation_Stock_Inventory/admin
 * @author     Sahil Buddhadev <hello@sahilbuddhadev.me>
 */
class Woocom_Variation_Stock_Inventory_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Woocom_Variation_Stock_Inventory_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Woocom_Variation_Stock_Inventory_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/woocom-variation-stock-inventory-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Woocom_Variation_Stock_Inventory_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Woocom_Variation_Stock_Inventory_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/woocom-variation-stock-inventory-admin.js', array( 'jquery' ), $this->version, false );

	}

	/**
	 * Simple product setting.
	 */
	function sjb_add_stock_inventory_multiplier_setting() {
		?><div class='options_group'><?php

			woocommerce_wp_text_input( array(
				'id'				=> '_stock_multiplier',
				'label'				=> __( 'Inventory reduction per quantity sold', 'woocommerce' ),
				'desc_tip'			=> 'true',
				'description'		=> __( 'Enter the quantity multiplier used for reducing stock levels when purchased.', 'woocommerce' ),
				'type' 				=> 'number',
				'custom_attributes'	=> array(
					'min'	=> '1',
					'step'	=> '1',
				),
			) );

		?></div><?php
	}

	/**
	 * Add variable setting.
	 *
	 * @param $loop
	 * @param $variation_data
	 * @param $variation
	 */
	function sjb_add_variation_stock_inventory_multiplier_setting( $loop, $variation_data, $variation ) {
		$variation = wc_get_product( $variation );
		woocommerce_wp_text_input( array(
			'id'				=> "stock_multiplier{$loop}",
			'name'				=> "stock_multiplier[{$loop}]",
			'value'				=> $variation->get_meta( '_stock_multiplier' ),
			'label'				=> __( 'Inventory reduction per quantity sold', 'woocommerce' ),
			'desc_tip'			=> 'true',
			'description'		=> __( 'Enter the quantity multiplier used for reducing stock levels when purchased.', 'woocommerce' ),
			'type' 				=> 'number',
			'custom_attributes'	=> array(
				'min'	=> '1',
				'step'	=> '1',
			),
		) );
	}

	/**
	 * Save the custom fields.
	 *
	 * @param WC_Product $product
	 */
	function sjb_save_custom_stock_reduction_setting( $product ) {

		if ( ! empty( $_POST['_stock_multiplier'] ) ) {
			$product->update_meta_data( '_stock_multiplier', absint( $_POST['_stock_multiplier'] ) );
		}
	}

	/**
	 * Save custom variable fields.
	 *
	 * @param int $variation_id
	 * @param $i
	 */
	function sjb_save_variable_custom_stock_reduction_setting( $variation_id, $i ) {
	    $variation = wc_get_product( $variation_id );
		if ( ! empty( $_POST['stock_multiplier'] ) && ! empty( $_POST['stock_multiplier'][ $i ] ) ) {
			$variation->update_meta_data( '_stock_multiplier', absint( $_POST['stock_multiplier'][ $i ] ) );
			$variation->save();
		}
	}

	/**
	 * Reduce with custom stock quantity based on the settings.
	 *
	 * @param $quantity
	 * @param $order
	 * @param $item
	 * @return mixed
	 */
	function sjb_custom_stock_reduction( $quantity, $order, $item ) {

		/** @var WC_Order_Item_Product $product */
		$multiplier = $item->get_product()->get_meta( '_stock_multiplier' );

		if ( empty( $multiplier ) && $item->get_product()->is_type( 'variation' ) ) {
			$product = wc_get_product( $item->get_product()->get_parent_id() );
			$multiplier = $product->get_meta( '_stock_multiplier' );
		}

		if ( ! empty( $multiplier ) ) {
			$quantity = $multiplier * $quantity;
		}

		return $quantity;
	}
}
