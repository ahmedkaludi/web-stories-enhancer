<?php
/*
Plugin Name:  Web Stories Enhancer
Plugin URI:   https://wordpress.org/plugins/web-stories-enhancer/
Description:  A short little description of the plugin. 
Version:      1.0
Author:       Magazine3 
Author URI:   https://magazine3.company/
License:      GPL2
License URI:  https://www.gnu.org/licenses/gpl-2.0.html
Text Domain:  magazine3
Domain Path:  /magazine3
*/

// Exit if accessed directly.

define('WEBSTEN_DIR_NAME', dirname( __FILE__ ));
define('WEBSTEN_PLUGIN_URI', plugin_dir_url(__FILE__));
define('WEBSTEN_PATH', dirname( __FILE__ ) );

use Google\Web_Stories_Dependencies\AmpProject\Validator\Spec\Tag\Tr;

if (!defined('ABSPATH')) exit;

add_action('wp_print_scripts', 'websten_settings_js');
function websten_settings_js(){
   wp_enqueue_script('web_sten_admin_script',  WEBSTEN_PLUGIN_URI . 'assets/js/web-stories-enhancer.js', array('jquery'));
}

add_action( 'admin_enqueue_scripts', 'websten_settings_css' );
function websten_settings_css(  ) {
    wp_enqueue_style( 'web_sten_admin_styles', WEBSTEN_PLUGIN_URI . 'assets/css/web-stories-enhancer.css' );   
}

 
// if (!class_exists('Web_Stories_Enhancer_Shortcode')) {
  /**
   * Class contain form wise data serve
   */
  class Web_Stories_Enhancer_Shortcode
  {
    // public $wse_active_status=array();

    public function __construct()
    {
      add_shortcode('web_stories_enhancer', array($this, 'webstoriesenhancer_webstories_story_shortcode'));
      add_filter('plugin_action_links_' . basename(dirname(__FILE__)) . '/' . basename(__FILE__),
      array('Web_Stories_Enhancer_Shortcode', 'plugin_action_links'));

    }
    static function get_plugin_version() {
      $plugin_data = get_file_data(__FILE__, array('version' => 'Version'), 'plugin');
        Web_Stories_Enhancer_Shortcode::$version = $plugin_data['version'];

       return $plugin_data['version'];
    } // get_plugin_version

    // check if plugin's admin page is shown
    static function is_plugin_admin_page($page = 'settings') {
      $current_screen = get_current_screen();
        if ($page == 'settings' && $current_screen->id == 'settings_page_web-stories-enhancer') {
          return true;
        }
      return false;
    } // is_plugin_admin_page
  // add settings link to plugins page
      static function plugin_action_links($links) {
        $settings_link = '<a href="' . esc_url(admin_url('options-general.php?page=web-stories-enhancer')) . '" title="Settings for Web stories enhancer">'.esc_html__( 'Settings' , 'web-stories-enhancer').'</a>';
        array_unshift($links, $settings_link);

        return $links;
      } // plugin_action_links


    public function webstoriesenhancer_webstories_story_shortcode()
    {

      $wse_content =  '';

      if ( in_array( 'makestories-helper/makestories.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
        // do stuff only if makestories-helper is installed and active
        $wse_active_status = 'makestories';
        $wse_post_type ='makestories_story';
      }else if ( in_array( 'web-stories/web-stories.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
        // do stuff only if web-stories is installed and active
        $wse_active_status = 'webstories';
        $wse_post_type ='web-story';
      }else{
        // do nothing
        $wse_active_status = '';
        $wse_post_type ='';
      }

      if($wse_active_status !='' && $wse_post_type !=''){
          $wse_content .= '<style>.web_stories_enhancer_main{width: 100%;margin: 0 auto;margin: 10px auto;position: relative;clear: both;display: block;overflow: hidden;background: #fff;border-radius: 5px;}';
          $wse_content .= '.web_stories_enhancer_main_inner{border-radius: 8px;margin: 10px 0;}';
          $wse_content .= '.web_stories_enhancer_main_column{outline: none;overflow-y: hidden;}';
          $wse_content .= '#text-2{display:none;}';
          $wse_content .= '.web_stories_enhancer_main_column ul {list-style: none; display: flex;    margin: 0;}';
          $wse_content .= '.web_stories_enhancer_main_column ul li{    list-style-type: none;text-align: center;}';
          $wse_content .= '.web_stories_article_thumbnail{padding: 0;text-align: center;margin: 0 auto;line-height: 0;border: solid 1px #f00;border-radius: 50px;padding: 1px;}';
          $wse_content .= '.web_stories_article_thumbnail img{border-radius:50%; width:66px; height:66px;}';
          $wse_content .= '.web_stories_enhancer_main_column .web_stories_article{width: 76px;padding: 0 4px;-webkit-tap-highlight-color: rgba(0, 0, 0, 0);-webkit-tap-highlight-color: transparent;}';
          $wse_content .= '.web_stories_enhancer_main_column .web_stories_article .web_stories_article_title{font-size: 13px;display: block;overflow: hidden;text-align: center;text-overflow: ellipsis;white-space: nowrap;}</style>';

          $wse_content .= '<div class="web_stories_enhancer_main">';
          $wse_content .= '<div class="web_stories_enhancer_main_inner">';
          $wse_content .= '<div class="web_stories_enhancer_main_column"><ul>';



          $wse_args = array(
            'post_type' => $wse_post_type,
            'post_status' => 'publish',
            // 'posts_per_page' => -1, 
            'orderby' => 'title',
            'order' => 'ASC',
          );

          $wse_loop = new WP_Query($wse_args);

          if ($wse_loop->have_posts()) :
            while ($wse_loop->have_posts()) : $wse_loop->the_post();

              $wse_content .= '<li><a href="' . esc_url( get_permalink()) . '"><div class="web_stories_article"><div class="web_stories_article_thumbnail">';
              
              if($wse_active_status == 'makestories'):
                $wse_postMeta = get_post_meta(get_the_ID());
                $wse_posterImage = "https://ss.makestories.io/get?story=" . $wse_postMeta['story_id'][0];
                if($wse_posterImage !=''){
                $wse_content .= '<img class="makestories" src="' . esc_url($wse_posterImage) . '" alt="' . esc_attr( get_the_title() ) . '"  />';
                }
              endif;
              if($wse_active_status == 'webstories'):
                if (has_post_thumbnail()) {
                $wse_content .= '<img class="webstories" src="' . esc_url(get_the_post_thumbnail_url(get_the_ID(), array(66, 66))) . '" alt="' . esc_attr( get_the_title() ) . '"  />';
                }
              endif;
              
              $wse_content .= '</div><div class="web_stories_article_title">' .esc_html( get_the_title()) . '</div></div></a></li>';

            endwhile;
          endif;
          wp_reset_postdata(); 

          $wse_content .= '</ul></div></div></div>';

        }

      // Return the wse_content
      return $wse_content;
    }
  
  }

if ( is_admin() ) {
  require(WEBSTEN_DIR_NAME.'/admin/web-stories-enhancer-admin.php');
  require(WEBSTEN_DIR_NAME. "/includes/helper-function.php" );
  require(WEBSTEN_DIR_NAME. "/admin/class.admin.php" );
  require(WEBSTEN_DIR_NAME . '/includes/newsletter.php' );

}  

register_activation_hook(__FILE__, 'web_sten_activate');
add_action('admin_init', 'web_sten_redirect');

function web_sten_activate() {
    add_option('web_sten_do_activation_redirect', true);
}

function web_sten_redirect() {
    if (get_option('web_sten_do_activation_redirect', false)) {
        delete_option('web_sten_do_activation_redirect');
        if(!isset($_GET['activate-multi']))
        {
            wp_redirect("options-general.php?page=web-stories-enhancer#general-settings");
        }
    }
}

$Web_Stories_Enhancer_Shortcode = new Web_Stories_Enhancer_Shortcode();
