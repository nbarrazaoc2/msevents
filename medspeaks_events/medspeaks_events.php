<?php
/*
Plugin Name: MedSpeaks Medical Events Speakers.
Description: Allow Admin post Events and Attend to the Users.
Author: Nancy Barraza
Version: 1.0.0
Author URI: Nancy Barraza -  OC2
Plugin URI: http://dev.oc2clients.com/MedSpeaks/wordpress/
License: MIT 2014
Copyright: 2014 
Text Domain: medspeaks
License: 
Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the “Software”), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in
all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED “AS IS”, WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
THE SOFTWARE.
*/
// Initialize Functions on Plugin
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
/**
 * The Class global object
 * @name $Class
 * @global Class $GLOBALS['Class']
 */

define('MS_PLUGIN_PATH', plugin_dir_path( __FILE__ ));
define('MS_PLUGIN_URL', plugin_dir_url( __FILE__ ));
$GLOBALS['MedSpeaks'] = new MedSpeaks();
register_activation_hook(__FILE__, 'my_plugin_activate');
add_action('admin_init', 'my_plugin_redirect');

function my_plugin_activate() {
    add_option('my_plugin_do_activation_redirect', true);
}
// Solution 1
function my_plugin_redirect() {
    if (get_option('my_plugin_do_activation_redirect', false)) {
        delete_option('my_plugin_do_activation_redirect');
         wp_redirect("admin.php?page=acf-options-settings");
         //wp_redirect() does not exit automatically and should almost always be followed by exit.
         exit;
    }
}

add_filter('acf/settings/show_admin', '__return_false');

class  MedSpeaks {

    /** plugin version number */
    const VERSION = '1.0.0';

    /** plugin text domain */
    const TEXT_DOMAIN = 'medspeaks';
    
    /** @var string the plugin path */
    private $plugin_path;

    /** @var string the plugin url */
    private $plugin_url;





/**
     * Initialize the plugin
     *
     * @since 1.0
     */
     
     public function __construct() {

        global $wpdb;

        global $rep_loc_path;

        $this->puglin_path = plugin_dir_path( __FILE__ );

        $this->plugin_url = plugin_dir_url( __FILE__ ); 
         
         // include required files
        $this->includes();

        $this->install();
        
        

        // Include 3rd Party Scripts
        if(!class_exists('acf')){

            add_filter('acf/settings/dir', array( $this, 'acf_dir' ));

            add_filter('acf/settings/path', array($this, 'acf_path'));

         	require_once( plugin_dir_path( __FILE__ ).'third-party/acf/acf.php');
            



        }

        require_once( plugin_dir_path( __FILE__ ).'third-party/acf-options-page/acf-options-page.php');
        require_once( plugin_dir_path( __FILE__ ).'third-party/acf-repeater/acf-repeater.php');
        require_once( plugin_dir_path( __FILE__ ).'third-party/acf-gallery/acf-gallery.php');
        require_once( plugin_dir_path( __FILE__ ).'third-party/acf-field-date-time-picker/acf-date_time_picker.php');


        $plugin = plugin_basename(__FILE__); 

        add_filter('acf/options_page/settings', array($this, 'my_acf_options_page_settings'));

        add_filter("plugin_action_links_$plugin", array($this,'admin_settings_link') );



     }
     
     /**
     * Include required files
     *
     * @since 1.0
     */
    private function includes() {


        require_once(MS_PLUGIN_PATH.'/includes/classes/class_medspeaks_front.php');

        $front_functions = new MedSpeaks_Front();


        if ( is_admin() ):

            $this->admin_includes();

        endif;
    }
    
    /**
     * Include required admin files
     *
     * @since 1.0
     */
    private function admin_includes() {           


         if( is_admin() ){

            require_once(MS_PLUGIN_PATH.'/includes/classes/class_medspeaks_admin.php');
            $admin = new MedSpeaks_Admin();
         }
           


    }
    


    /** Lifecycle methods ******************************************************/


    /**
     * Run every time.  Used since the activation hook is not executed when updating a plugin
     *
     * @since 1.0
     */
    private function install() {
       

        // get current version to check for upgrade
        $installed_version = get_option( 'medspeaks_version' );

        // install
        if ( ! $installed_version ) {

            require_once(MS_PLUGIN_PATH.'includes/classes/class_medspeaks_install.php');
            $install = new ms_install();
             
        }

        // upgrade if installed version lower than plugin version
        if ( -1 === version_compare( $installed_version, self::VERSION ) )
            $this->upgrade( $installed_version );
    }


    /**
     * Perform any version-related changes
     *
     * @since 1.0
     * @param int $installed_version the currently installed version of the plugin
     */
    private function upgrade( $installed_version ) {

        // upgrade code

        // update the installed version option
        update_option( 'medspeaks_version', self::VERSION );
        
        
    }


    // Add settings link on plugin page
    public function admin_settings_link($links) { 
      $settings_link = '<a href="options-general.php?page=acf-options-settings">Settings</a>'; 
      array_unshift($links, $settings_link); 
      return $links; 
    }
 


    public function acf_dir( $dir ) {

        // update path
         $dir = plugin_dir_path( __FILE__ ) . 'third-party/acf/';
    
    
        // return
        return $dir;
    }

    public function acf_path( $path ) {

        // update path
         $path = plugin_dir_path( __FILE__ ) . 'third-party/acf/';
    
    
        // return
        return $path;
    }

    public function my_acf_options_page_settings( $settings ){
 
		$settings['title'] = __('MedSpeaks','acf');
		$settings['pages'] = array('Settings');

		return $settings;
	
    }

    


}