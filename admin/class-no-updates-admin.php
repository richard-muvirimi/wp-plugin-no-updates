<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://tyganeutronics.com
 * @since      1.0.0
 *
 * @package    No_Updates
 * @subpackage No_Updates/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    No_Updates
 * @subpackage No_Updates/admin
 * @author     Richard Muvirimi <tygalive@gmail.com>
 */
class No_Updates_Admin
{

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
	 * @return void
	 */
	public function __construct($plugin_name, $version)
	{

		$this->plugin_name = $plugin_name;
		$this->version = $version;
	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 * @return void
	 */
	public function enqueue_styles()
	{
		wp_register_style($this->plugin_name, plugin_dir_url(__FILE__) . 'css/no-updates-admin.css', array(), $this->version, 'all');
	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 * @return void
	 */
	public function enqueue_scripts()
	{
		wp_register_script($this->plugin_name, plugin_dir_url(__FILE__) . 'js/no-updates-admin.js', array('jquery'), $this->version, false);
		wp_localize_script($this->plugin_name, "no_updates", array(
			"ajax_url" => admin_url('admin-ajax.php'),
			"name" => $this->plugin_name
		));
	}

	/**
	 * Force an update on requested item
	 *
	 * @since 1.0.0
	 * @version 1.0.1
	 * @param string $target
	 * @return void
	 */
	public function suppressUpdates($target)
	{
		/**
		 * Modify Site transient
		 */
		foreach (array("plugins", "themes") as $target) {

			$updates =  get_site_transient('update_' . $target);

			//clear updates
			$updates->response = array();

			//stall update checking
			$updates->last_checked = time();

			//save
			set_site_transient('update_' . $target, $updates);
		}
	}

	/**
	 * Show rating request
	 *
	 * @since 1.0.0
	 * @version 1.0.1
	 * @return void
	 */
	public function show_rating()
	{
		/**
		 * Request Rating
		 */
		if (boolval(get_transient($this->plugin_name . "-rate")) === false) {
			wp_enqueue_script($this->plugin_name);
			wp_enqueue_style($this->plugin_name);

			include plugin_dir_path(__FILE__) . "partials/no-updates-admin-rating.php";
		}
	}
}