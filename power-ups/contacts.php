<?php
/**
	* Power-up Name: Contacts Tracking
	* Power-up Class: WPLeadInContacts
	* Power-up Menu Text: Contacts
	* Power-up Menu Link: contacts
	* Power-up Slug: contacts
	* Power-up URI: http://leadin.com/
	* Power-up Description: Get an in-depth history of each contact in your database.
	* Power-up Icon: powerup-icon-leads
	* First Introduced: 0.4.7
	* Power-up Tags: Lead Tracking
	* Auto Activate: Yes
	* Permanently Enabled: Yes
*/

//=============================================
// Define Constants
//=============================================

if ( !defined('LEADIN_CONTACTS_PATH') )
    define('LEADIN_CONTACTS_PATH', LEADIN_PATH . '/power-ups/contacts');

if ( !defined('LEADIN_CONTACTS_PLUGIN_DIR') )
	define('LEADIN_CONTACTS_PLUGIN_DIR', LEADIN_PLUGIN_DIR . '/power-ups/contacts');

if ( !defined('LEADIN_CONTACTS_PLUGIN_SLUG') )
	define('LEADIN_CONTACTS_PLUGIN_SLUG', basename(dirname(__FILE__)));

//=============================================
// Include Needed Files
//=============================================

require_once(LEADIN_CONTACTS_PLUGIN_DIR . '/admin/contacts-admin.php');

//=============================================
// WPLeadIn Class
//=============================================
class WPLeadInContacts extends WPLeadIn {
	
	var $admin;

	/**
	 * Class constructor
	 */
	function __construct ( $activated )
	{
		//=============================================
		// Hooks & Filters
		//=============================================

		if ( ! $activated )
			return false;

		add_action('admin_print_scripts', array(&$this, 'add_leadin_contacts_admin_scripts'));
	}

	public function admin_init ( )
	{
		$admin_class = get_class($this) . 'Admin';
		$this->admin = new $admin_class();
	}

	function power_up_setup_callback ( )
	{
		$this->admin->power_up_setup_callback();
	}

	//=============================================
	// Scripts & Styles
	//=============================================

	/**
     * Adds admin javascript
     */
    function add_leadin_contacts_admin_scripts ()
    {
        global $pagenow;

        if ( $pagenow == 'admin.php' && isset($_GET['page']) && strstr($_GET['page'], "leadin") ) 
        {
        	wp_register_script('leadin-contacts-admin-js', LEADIN_CONTACTS_PATH . '/admin/js/leadin-contacts-admin.js', array ( 'jquery' ), FALSE, TRUE);
            wp_enqueue_script('leadin-contacts-admin-js');
        }
    }
}

//=============================================
// LeadIn Init
//=============================================

global $leadin_contacts;
//$leadin_contacts = new WPLeadInContacts();

?>