<?php
   if ( ! defined( 'ABSPATH' ) ) {
   	exit;
   }
   
   ?>
<div class="wrap">
   <div class="wse-container">
      <table><tr><td><a href="https://wordpress.org/plugins/web-stories-enhancer/" target="_blank"><img  class="wse-logo" src=<?php echo WEBSTORIES_ENHANCER_URL . '/assets/images/logo.png' ?> title="<?php _e( 'Web Stories Enhancer', 'web-stories-enhancer' ); ?>"/></a></td><td><h1><?php _e( 'Web Stories Enhancer', 'web-stories-enhancer' ); ?></h1></td></tr></table>
   </div>
   <div class="wse-tab">
      <button class="wse-tablinks" onclick="openTab(event, 'wse-intro')" id="defaultOpen"><?php echo esc_html__('Dashboard', 'web-stories-enhancer') ?></button>
      <button class="wse-tablinks" onclick="openTab(event, 'wse-help')"><?php echo esc_html__('Help &amp; Support', 'web-stories-enhancer') ?></button>  
   </div>
   <div id="wse-intro" class="wse-tabcontent">
   <p><?php printf('<b>Please note that this plugin require <a href="https://wordpress.org/plugins/web-stories/"  target="_blank">Web Stories by Google</a> or  <a href="https://wordpress.org/plugins/makestories-helper/" target="_blank">MakeStories (for Web Stories) by MakeStories</a> installed and activated to work.</b> ', 'web-stories-enhancer')?></p>
      <ul>  <li><?php _e('Shortcode','web-stories-enhancer') ?> : <input type="text" class="wse-input" id="wse-input" value="[web_stories_enhancer]"  size="60" readonly>
      <div class="wse-tooltip">
      <button class="wse-btn" onclick="wse_copy()" onmouseout="wse_out()">
        <span class="wse-tooltiptext" id="wse-tooltip"><?php _e('Copy Shortcode','web-stories-enhancer') ?></span>
        <?php _e('Copy','web-stories-enhancer') ?>
        </button>
      </div></li><ul>
      <p><?php _e('It shows Instagram-style latest stories in the round circle format which outputs with the help of shortcode. It can be literally everywhere. ', 'web-stories-enhancer')?></p>
   
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