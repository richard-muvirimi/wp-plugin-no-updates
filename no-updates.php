<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              http://richard.co.zw
 * @since             1.0.0
 * @package           NoUpdates
 *
 * @wordpress-plugin
 * Plugin Name:       No Updates
 * Plugin URI:        https://github.com/richard-muvirimi/wp-plugin-no-updates
 * Description:       Hide Plugin and Theme Updates with Ease: Say Goodbye to Broken Sites and Hassle-Free Maintenance
 * Version:           1.1.0
 * Author:            Richard Muvirimi
 * Author URI:        http://richard.co.zw
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       no-updates
 * Domain Path:       /languages
 */

use Rich4rdMuvirimi\NoUpdates\NoUpdates;

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
    die;
}

/**
 * The plugin slug, one source of truth for context
 */
const NO_UPDATES_SLUG = 'no-updates';

/**
 * Plugin version number
 */
const NO_UPDATES_VERSION = '1.1.0';

/**
 * Reference to this file, and this file only, (well, plugin entry point)
 */
const NO_UPDATES_FILE = __FILE__;

/**
 * Plugin name as known to WordPress
 */
define( 'NO_UPDATES_NAME', plugin_basename( NO_UPDATES_FILE ) );

/**
 * Load composer
 */
require plugin_dir_path( __FILE__ ) . 'vendor/autoload.php';

/**
 * And away we go
 */
NoUpdates::instance()->run();