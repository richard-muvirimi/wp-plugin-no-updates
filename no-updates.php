<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://tyganeutronics.com
 * @since             1.0.0
 * @package           No_Updates
 *
 * @wordpress-plugin
 * Plugin Name:       No updates
 * Plugin URI:        https://tyganeutronics.com/no-updates
 * Description:       Suppress all plugin and theme updates
 * Version:           1.0.0
 * Author:            Tyganeutronics
 * Author URI:        https://tyganeutronics.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       no-updates
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if (!defined('WPINC')) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define('NO_UPDATES_VERSION', '1.0.0');

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-no-updates-activator.php
 */
function activate_no_updates()
{
	require_once plugin_dir_path(__FILE__) . 'includes/class-no-updates-activator.php';
	No_Updates_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-no-updates-deactivator.php
 */
function deactivate_no_updates()
{
	require_once plugin_dir_path(__FILE__) . 'includes/class-no-updates-deactivator.php';
	No_Updates_Deactivator::deactivate();
}

register_activation_hook(__FILE__, 'activate_no_updates');
register_deactivation_hook(__FILE__, 'deactivate_no_updates');

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path(__FILE__) . 'includes/class-no-updates.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_no_updates()
{

	$plugin = new No_Updates();
	$plugin->run();
}
run_no_updates();