<div id='websten' class='wrap'>
    <div><a href="#" target="_blank" >
  <img src="<?php echo plugins_url( 'assets/logo.png', dirname(__FILE__) ) ?>" alt="webstories" srcset="<?php echo plugins_url( 'assets/logo.png', dirname(__FILE__) ) ?> 1x, <?php echo plugins_url( 'assets/logo.png', dirname(__FILE__) ) ?> 2x" >
  </a>
    <div class="websten-tab-panel">
    	  <a id="websten-default" class="websten-tablinks" data-href="no" href="#general-settings" onclick="tabToggle(event, 'general')">Display</a>
    	   <a class="websten-tablinks" id="websten-technical" href="#technical-support" onclick="tabToggle(event, 'technical')" data-href="no">Help & Support</a>
    </div><!-- /.Tab panel -->
   <div  class="websten-tabcontent" id="general">
		<p><?php echo esc_html__('This is the Web Stories Enhancer Plugin for showing the web stories to the website with the help of shortcode [web_stories_enhancer]','web-stories-enhancer') ?> </p>
    </div><!-- /.General Settings ended -->

   <div class="websten_support_div websten-tabcontent" id="technical">
        <div class="websten-form-page-ui">
            <div class="websten-left-side">
                <p><?php echo esc_html__('We are dedicated to provide Technical support & Help to our users. Use the below form for sending your questions.','web-stories-enhancer') ?> </p>
                <p><?php echo  esc_html__('You can also contact us from ','web-stories-enhancer') ?><a href="https://wordpress.org/support/plugin/web-stories-enhancer/">Web stories enhancer support</a>.</p>
   
                <div class="websten_support_div_form" id="technical-form">
                    <ul>
                        <li>
                          <label class="support-label">Email<span class="star-mark">*</span></label>
                           <div class="support-input">
                           		<input type="text" id="websten_query_email" name="websten_query_email" placeholder="Enter your Email" required>
                           </div>
                        </li>
                        <li>
                            <label class="support-label">Query<span class="star-mark">*</span></label>
                             <div class="support-input"><textarea rows="5" cols="50" id="websten_query_message" name="websten_query_message" placeholder="Write your query"></textarea>
                            </div>                          
                        </li>            
                    </ul>            
                <li><button class="button button-primary websten-send-query"><?php echo esc_html__('Send Support Request','web-stories-enhancer'); ?></button></li>
            </ul> 
            <div class="clear"> </div>
                    <span class="websten-query-success websten-result websten_hide"><?php echo esc_html__('Message sent successfully, Please wait we will get back to you shortly','web-stories-enhancer'); ?></span>
                    <span class="websten-query-error websten-result websten_hide"><?php echo esc_html__('Message not sent. please check your network connection','web-stories-enhancer'); ?></span>
            </div> 
       </div>
    <div class="websten-right-side">
           <div class="websten-bio-box" id="wse_Bio">
                <h1>Vision & Mission</h1>
                <p class="websten-p">We strive to provide the best Web stories in the world.</p>
                <section class="websten_dev-bio"> 
                    <div class="websten-bio-wrap">
                    <img width="50px" height="50px" src="<?php echo plugins_url( 'assets/ahmed-kaludi.jpg', dirname(__FILE__) ) ?>">
                        <p>Lead Dev</p>
                    </div>
                    <div class="websten-bio-wrap">
                    <img width="50px" height="50px" src="<?php echo plugins_url( 'assets/Mohammed-kaludi.jpeg', dirname(__FILE__) ) ?>">
                        <p>Developer</p>
                    </div>
                </section>
              <p class="websten_boxdesk"> Delivering a good user experience means a lot to us, so we try our best to reply each and every question.</p>
           </div>
        </div>   </div>   </div>        <!-- /.Technical support div ended -->
</div>
