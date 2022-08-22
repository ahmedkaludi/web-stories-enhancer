<?php


// Admin stuff for Web stories enhancer, Version 1.1

add_action('admin_menu', 'websten_option_menu', 1);
function websten_option_menu() {
	add_options_page(__('Web stories enhancer options', 'web_stories_enhancer'), __('Web stories enhancer', 'web_stories_enhancer'), 'edit_theme_options', 'web-stories-enhancer', 'websten_options_page');
}
function websten_options_page(){
	include WEBSTEN_PATH . '/admin/inc.admin-options-page.php';
    }

add_action( 'admin_footer', 'websten_admin_footer' );
function websten_admin_footer() {
	$current_screen = get_current_screen();
	if ( 'settings_page_web-stories-enhancer' !== $current_screen->id && 'widgets' !== $current_screen->id ) {
		return;
	}
}
?>