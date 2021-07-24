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
		//wp_enqueue_style($this->plugin_name, plugin_dir_url(__FILE__) . 'css/no-updates-admin.css', array(), $this->version, 'all');
	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 * @return void
	 */
	public function enqueue_scripts()
	{
		//wp_enqueue_script($this->plugin_name, plugin_dir_url(__FILE__) . 'js/no-updates-themes.js', array('jquery'), $this->version, false);

	}

	/**
	 * Handle requested action
	 * 
	 * @since 1.0.0
	 * @version 1.0.1
	 * @return void
	 */
	function handle_action()
	{

		if (wp_verify_nonce(filter_input(INPUT_GET, $this->plugin_name . "-nonce"), $this->plugin_name)) {

			switch (filter_input(INPUT_GET, $this->plugin_name . "-target")) {
				case "rate":
					//remind again in three months
					set_transient($this->plugin_name . "-rate", true, defined("MONTH_IN_SECONDS") ? MONTH_IN_SECONDS * 3 : YEAR_IN_SECONDS / 4);

					wp_redirect("https://wordpress.org/support/plugin/no-updates/reviews/");
					exit;
					break;
				case "later":
					//remind after a week
					set_transient($this->plugin_name . "-rate", true, WEEK_IN_SECONDS * 7);

					wp_redirect(remove_query_arg(array("action", $this->plugin_name . "-nonce", $this->plugin_name, $this->plugin_name . "-target"), $_SERVER['REQUEST_URI']));
					exit;
					break;
				case "never":
					set_transient($this->plugin_name . "-rate", true, YEAR_IN_SECONDS);

					wp_redirect(remove_query_arg(array("action", $this->plugin_name . "-nonce", $this->plugin_name, $this->plugin_name . "-target"), $_SERVER['REQUEST_URI']));
					exit;
					break;
				default:
			}
		}
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
			include plugin_dir_path(__FILE__) . "partials/no-updates-admin-rating.php";
		}
	}
}