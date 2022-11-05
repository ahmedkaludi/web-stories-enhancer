<?php
/*
Plugin Name:  Web Stories Enhancer
Plugin URI:   https://wordpress.org/plugins/web-stories-enhancer/
Description:  Show Google Web Stories anywhere with the help of shortcode.
Version:      1.0
Author:       Magazine3 
Author URI:   https://magazine3.company/
License:      GPL2
License URI:  https://www.gnu.org/licenses/gpl-2.0.html
Text Domain:  web-stories-enhancer
Domain Path:  /magazine3
*/

// Exit if accessed directly.

use Google\Web_Stories_Dependencies\AmpProject\Validator\Spec\Tag\Tr;

if (!defined('ABSPATH')) exit;

 if (!class_exists('Web_Stories_Enhancer')) {

  class Web_Stories_Enhancer
  {

    public function __construct()
    {
        $this->defineConstants();
        $this->addHooks();
        $this->addShortcode();
        $this->addAdminNotice();
        $this->addAjaxSupportForm();

    } 
    private function defineConstants() {
      define( 'WEBSTORIES_ENHANCER_VERSION', '1.0' );
      define( 'WEBSTORIES_ENHANCER_PATH', plugin_dir_path( __FILE__ ) );
      define( 'WEBSTORIES_ENHANCER_URL', plugins_url( '', __FILE__) );
      define( 'WEBSTORIES_ENHANCER_PLUGIN_FILE', __FILE__ );
      
		}
    private function addHooks() {
      add_action( 'admin_menu', array( $this, 'registerMenus' ) );
      add_filter( 'plugin_action_links_' . plugin_basename( WEBSTORIES_ENHANCER_PLUGIN_FILE ), array( $this, 'addSettingsPluginAction' ), 10, 4 );
      add_action( 'admin_enqueue_scripts', array( $this,'loadAdminStyles'));
      register_activation_hook(__FILE__, array( $this,'wseActivate'));
      add_action('admin_init',array( $this, 'wseRedirect'));
		}

    public function registerMenus() {
      add_options_page(
        __( 'Web Stories Enhancer', 'web-stories-enhancer' ),
        __( 'Web Stories Enhancer', 'web-stories-enhancer' ),
        'manage_options',
        'web-stories-enhancer',
        array( $this, 'displaySettingsPage' )
      );
    }


    public function addSettingsPluginAction( $actions, $plugin_file, $plugin_data, $context ) {
      $plugin_actions['settings'] = sprintf(
        '<a href="%s">' . _x( 'Settings', 'Web Stories Enhancer settings link', 'web-stories-enhancer' ) . '</a>',
        admin_url( 'options-general.php?page=web-stories-enhancer' )
      );
      return array_merge($actions,$plugin_actions );
    }

    public function displaySettingsPage() {
      include WEBSTORIES_ENHANCER_PATH . 'templates/settings.php';
    }

    public function addShortcode() {
      // add shortcode only if Web stories / Make story plugin is installed and activated
      if ($this->checkDependablePlugins()) {
      require_once( WEBSTORIES_ENHANCER_PATH . '/includes/shortcode.php' );
      $Web_Stories_Enhancer_Shortcode = new Web_Stories_Enhancer_Shortcode();
      }
		}

    public function addAjaxSupportForm() {

      require_once( WEBSTORIES_ENHANCER_PATH . '/includes/support-form.php' );
      $Web_Stories_Enhancer_Support = new Web_Stories_Enhancer_Support();
    
		}

    public function loadAdminStyles($hook_suffix ) {
      if($hook_suffix=="settings_page_web-stories-enhancer")
      {
        wp_enqueue_style('wse-admin-styles', WEBSTORIES_ENHANCER_URL .'/assets/css/wse-admin.css', array(),WEBSTORIES_ENHANCER_VERSION);
        wp_enqueue_script('wse-admin-script', WEBSTORIES_ENHANCER_URL . '/assets/js/wse-admin.js', array('jquery'), WEBSTORIES_ENHANCER_VERSION, 'true' );
        wp_localize_script('wse-admin-script', 'wse_script_vars', array(
          'nonce' => wp_create_nonce( 'wse-admin-nonce' ),
        )
        );
      }
    }

    public function addAdminNotice() {
      // Show notice if Web stories / Make story plugin is not active
      if (!$this->checkDependablePlugins()) {
        echo '<div class="notice notice-warning is-dismissible">
                    <p>'.__(sprintf('<b>Web Stories Enhancer</b> will not work until <a href="%s" target="_blank">Web Stories by Google</a> or <a href="%s" target="_blank">MakeStories (for Web Stories) by MakeStories </a> is installed/activated.',"https://wordpress.org/plugins/web-stories/","https://wordpress.org/plugins/makestories-helper/"),'web-stories-enhancer').'</p>
                 </div>';
      } 
         
		}

    private function checkDependablePlugins()
    {
      include_once ABSPATH . 'wp-admin/includes/plugin.php';
      if (is_plugin_active( 'web-stories/web-stories.php' ) || is_plugin_active( 'makestories-helper/makestories.php' ) ) {
       return true; 
      }
      return false;
    }

    public function wseActivate() {
        add_option('wse_activation_redirect', true);
    }

    public function wseRedirect() {
        if (get_option('wse_activation_redirect', false)) {
            delete_option('wse_activation_redirect');
            if(!isset($_GET['activate-multi']))
            {
                wp_redirect("options-general.php?page=web-stories-enhancer");
            }
        }
    }
}

$Web_Stories_Enhancer = new Web_Stories_Enhancer();
 }

