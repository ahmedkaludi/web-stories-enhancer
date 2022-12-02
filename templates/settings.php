<?php
   if ( ! defined( 'ABSPATH' ) ) {
   	exit;
   }
   $wse_tab="";
   if(isset($_GET['wse_tab'])){$wse_tab=esc_attr($_GET['wse_tab']);}
   ?>
   <script>
      var wse_cur_tab="<?=$wse_tab?>";
   </script>
<div class="wrap">
   <div class="wse-container">
      <table><tr><td><a href="https://wordpress.org/plugins/web-stories-enhancer/" target="_blank"><img  class="wse-logo" src=<?php echo WEBSTORIES_ENHANCER_URL . '/assets/images/logo.png' ?> title="<?php _e( 'Web Stories Enhancer', 'web-stories-enhancer' ); ?>"/></a></td><td><h1><?php _e( 'Web Stories Enhancer', 'web-stories-enhancer' ); ?></h1></td></tr></table>
   </div>
   <div class="wse-tab">
      <button class="wse-tablinks" onclick="openTab(event, 'wse-intro')" id="wse-tab-intro"><?php echo esc_html__('Settings', 'web-stories-enhancer') ?></button>
      <button class="wse-tablinks" onclick="openTab(event, 'wse-help')" id="wse-tab-support"><?php echo esc_html__('Help &amp; Support', 'web-stories-enhancer') ?></button>  
   </div>
   <div id="wse-intro" class="wse-tabcontent">
   <p><?php printf('<b>Please note that this plugin require <a href="https://wordpress.org/plugins/web-stories/"  target="_blank">Web Stories by Google</a> or  <a href="https://wordpress.org/plugins/makestories-helper/" target="_blank">MakeStories (for Web Stories) by MakeStories</a> installed and activated to work.</b> ', 'web-stories-enhancer')?></p>
   <p><b>Select listing type : </b><label><input type="radio" class="wse_shortcode_type" name="wse_shortcode_type" value="circle_carousel" checked>Circle Carousel</label>&nbsp;
   <label><input type="radio" name="wse_shortcode_type" class="wse_shortcode_type" value="box_carousel" >Box Carousel</label>&nbsp;
   <label><input type="radio" name="wse_shortcode_type" class="wse_shortcode_type" value="grid" >Grid</label>&nbsp;
  
      <ul>  <li><b><?php _e('Shortcode','web-stories-enhancer') ?> :</b> <input type="text" class="wse-input" id="wse-input" value='[web_stories_enhancer type="circle_carousel"]'  size="60" readonly>
      <div class="wse-tooltip">
      <button class="wse-btn" onclick="wse_copy()" onmouseout="wse_out()">
        <span class="wse-tooltiptext" id="wse-tooltip"><?php _e('Copy Shortcode','web-stories-enhancer') ?></span>
        <?php _e('Copy','web-stories-enhancer') ?>
        </button>
      </div></li><ul>
         <?php $details=get_webstory_plugin_details();
         $settings=get_option('wse_settings');
         if($details['wse_active_status']=='webstories') { ?>
      <form id="wse-setting-form" action="javascript:void(0);" method="post">
         <p>
         <table class="form-table">
         <tr>
            <th><?php _e( 'Enable CTA AD', 'web-stories-enhancer' ); ?></th>
            <td>
               <input type="checkbox" name="wse_enable_cta_ad" id="wse_enable_cta_ad"  value="1" <?php if(isset( $settings['cta_enable']) && $settings['cta_enable']==true){ echo 'checked';}?> />
               <label ><?php _e( 'Add your CTA banner add in Google Webstories', 'web-stories-enhancer' ); ?></label>
            </td>
         </tr>
        
         <tr class="wse_val_tr" style="display:none">
            <th><?php _e('CTA Banner (640 by 853 px) *', 'web-stories-enhancer'); ?></th>
            <td>
         <input type="text" name="wse_cta_banner" id="wse_cta_banner" class="wse_cta_banner"  value="<?php echo isset( $settings['cta_banner'] ) ? esc_attr( $settings['cta_banner']) : ''; ?>" >
      <button type="button" class="button wse-cta-banner-upload" data-editor="content">
         <span class="dashicons dashicons-format-image" style="margin-top: 4px;"></span> <?php _e( 'Choose Banner', 'web-stories-enhancer' ); ?>
	</button>
   <p class="description">
		<?php _e('Banner should be of 640 by 853 pixels .If you do not upload this AD will not show in Web stories', 'web-stories-enhancer'); ?>
	</p>
         </td> </tr>

         <tr class="wse_val_tr" style="display:none">
            <th><?php _e( 'Add CTA at slide  *', 'web-stories-enhancer' ); ?></th>
            <td>
         <input type="number" name="wse_cta_ad_slide" id="wse_cta_ad_slide"  min="1" value="<?php if(isset($settings['cta_banner_slide'])){ echo esc_attr($settings['cta_banner_slide']);}?>" />
         </td>
         </tr>
         <tr class="wse_val_tr" style="display:none">
            <th><?php _e( 'CTA button text * ', 'web-stories-enhancer' ); ?></th>
            <td>
         <input type="text" name="wse_cta_btn_text" id="wse_cta_btn_text"  value="<?php if(isset($settings['cta_btn_text'])){echo esc_attr($settings['cta_btn_text']);}?>"  />
         </td>
         </tr>
         <tr class="wse_val_tr" style="display:none">
            <th><?php _e( 'CTA button link * ', 'web-stories-enhancer' ); ?></th>
            <td>
         <input type="url" name="wse_cta_btn_link" id="wse_cta_btn_link"  value="<?php if(isset($settings['cta_btn_link'])){ echo esc_url($settings['cta_btn_link']);}?>"  />
         </td>
         </tr>

         </table>
         </p>

<p class="submit">
  <input type="submit" name="save_wse_settings" id="submit" class="button button-primary" value="<?php _e( 'Save Changes', 'web-stories-enhancer' ); ?>" />
</p>

</form>	
   <?php } ?>
      
   </div>
   <div id="wse-help" class="wse-tabcontent">
      <div class="wse-flex-container">
         <div class="wse-left-side">
            <p><?php echo esc_html__('We are dedicated to provide Technical support &amp; Help to our users. Use the below form for sending your questions. ', 'web-stories-enhancer') ?></p>
            <div class="wse_support_div_form" id="technical-form">
               <ul>
                  <li>
                     <label class="wse-support-label"><?php echo esc_html__('Email', 'web-stories-enhancer') ?><span class="wse-star-mark">*</span></label>
                     <div class="support-input">
                        <input type="text" id="wse_query_email" name="wse_query_email" size="47" placeholder="Enter your Email" required="">
                     </div>
                  </li>
                  <li>
                     <label class="wse-support-label"><?php echo esc_html__('Query', 'web-stories-enhancer') ?><span class="wse-star-mark">*</span></label>                    
                     <div class="support-input"><textarea rows="5" cols="50" id="wse_query_message" name="wse_query_message" placeholder="Write your query"></textarea>
                     </div>
                  </li>
                  <li><button class="button button-primary wse-send-query"><?php echo esc_html__('Send Support Request', 'web-stories-enhancer') ?></button></li>
               </ul>
               <div class="clear"> </div>
               <span class="wse-query-success wse-result wse-hide"><?php echo esc_html__('Message sent successfully, Please wait we will get back to you shortly', 'web-stories-enhancer') ?></span>
               <span class="wse-query-error wse-result wse-hide"><?php echo esc_html__('Message not sent. please check your network connection', 'web-stories-enhancer') ?></span>
            </div>
         </div>
         <div class="wse-right-side">
           
         </div>
      </div>
   </div>
</div>