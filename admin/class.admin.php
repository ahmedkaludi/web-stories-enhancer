<?php

if (!defined('ABSPATH')) exit;

if (!class_exists('websten_admin')) {
	

	final class websten_admin {

		 function __construct() {

			$this->hooks();
			//$this->registerMetaboxes();
		}

		function hooks(){
			add_action( 'admin_enqueue_scripts', array( $this, 'load_scripts' ) );
			add_action('wp_ajax_websten_send_query_message', array( $this, 'websten_send_query_message'));
		}

		function load_scripts(){

			  wp_enqueue_script( 'websten-admin-js', WEBSTEN_PLUGIN_URI . 'assets/js/web-stories-enhancer.js',array('jquery'),true );

				 $data = array(     
					'ajax_url'      		       => admin_url( 'admin-ajax.php' ),
					'websten_security_nonce'         => wp_create_nonce('websten_ajax_check_nonce'),  
				);							

				$data = apply_filters('websten_localize_filter',$data,'websten_admin_data');

				wp_localize_script( 'websten-admin-js', 'websten_admin_data', $data );
		}


		function websten_send_query_message(){   
		    
		        if ( ! isset( $_POST['websten_security_nonce'] ) ){
		           return; 
		        }
		        if ( !wp_verify_nonce( $_POST['websten_security_nonce'], 'websten_ajax_check_nonce' ) ){
		           return;  
		        }   
		        $message        = $this->websten_sanitize_textarea_field($_POST['message']); 
		        $email          = $this->websten_sanitize_textarea_field($_POST['email']);   
		                                
		        if(function_exists('wp_get_current_user')){

		            $user           = wp_get_current_user();

		         
		            $message = '<p>'.$message.'</p><br><br>'.'Query from Web stories enhancer plugin support tab';
		            
		            $user_data  = $user->data;        
		            $user_email = $user_data->user_email;     
		            
		            if($email){
		                $user_email = $email;
		            }            
		            //php mailer variables        
		            $sendto    = 'team@magazine3.in';
		            $subject   = "Web stories enhancer Query";
		            
		            $headers[] = 'Content-Type: text/html; charset=UTF-8';
		            $headers[] = 'From: '. esc_attr($user_email);            
		            $headers[] = 'Reply-To: ' . esc_attr($user_email);
		            // Load WP components, no themes.   

		            $sent = wp_mail($sendto, $subject, $message, $headers); 

		            if($sent){

		                 echo json_encode(array('status'=>'t'));  

		            }else{

		                echo json_encode(array('status'=>'f'));            

		            }
		            
		        }
		                        
		        wp_die();           
		}

	}
	new websten_admin();
}

?>