<?php

/**
 * Fired during plugin deactivation
 *
 * @link       https://tyganeutronics.com
 * @since      1.0.0
 *
 * @package    No_Updates
 * @subpackage No_Updates/includes
 */

/**
 * Fired during plugin deactivation.
 *
 * This class defines all code necessary to run during the plugin's deactivation.
 *
 * @since      1.0.0
 * @package    No_Updates
 * @subpackage No_Updates/includes
 * @author     Richard Muvirimi <tygalive@gmail.com>
 */
class No_Updates_Deactivator
{

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function deactivate()
	{
		foreach (array("plugins", "themes") as $target) {

			$updates =  get_site_transient('update_' . $target);

			//stall update checking
			$updates->last_checked = time() - DAY_IN_SECONDS;

			//save
			set_site_transient('update_' . $target, $updates);
		}
	}
}