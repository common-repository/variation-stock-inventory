<?php

/**
 *
 * @link              http://sahilbuddhadev.me/
 * @since             1.0.0
 * @package           Woocom_Variation_Stock_Inventory
 *
 * @wordpress-plugin
 * Plugin Name:       Variation Stock Inventory
 * Plugin URI:        http://sahilbuddhadev.me/plugin/woocom-variation-stock-inventory
 * Description:       Manage product variantion stock inventory. If you have any query please email me at <a href="mailto:hello@sahilbuddhadev.me">hello@sahilbuddhadev.me</a>
 * Version:           1.0.0
 * Author:            Sahil Buddhadev
 * Author URI:        http://sahilbuddhadev.me/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       woocom-variation-stock-inventory
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'WOOCOM_VARIATION_STOCK_INVENTORY_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-woocom-variation-stock-inventory-activator.php
 */
function activate_woocom_variation_stock_inventory() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-woocom-variation-stock-inventory-activator.php';
	Woocom_Variation_Stock_Inventory_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-woocom-variation-stock-inventory-deactivator.php
 */
function deactivate_woocom_variation_stock_inventory() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-woocom-variation-stock-inventory-deactivator.php';
	Woocom_Variation_Stock_Inventory_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_woocom_variation_stock_inventory' );
register_deactivation_hook( __FILE__, 'deactivate_woocom_variation_stock_inventory' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-woocom-variation-stock-inventory.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_woocom_variation_stock_inventory() {

	$plugin = new Woocom_Variation_Stock_Inventory();
	$plugin->run();

}
run_woocom_variation_stock_inventory();
