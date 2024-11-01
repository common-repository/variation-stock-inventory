<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       http://sahilbuddhadev.me/
 * @since      1.0.0
 *
 * @package    Woocom_Variation_Stock_Inventory
 * @subpackage Woocom_Variation_Stock_Inventory/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Woocom_Variation_Stock_Inventory
 * @subpackage Woocom_Variation_Stock_Inventory/includes
 * @author     Sahil Buddhadev <hello@sahilbuddhadev.me>
 */
class Woocom_Variation_Stock_Inventory_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'woocom-variation-stock-inventory',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
