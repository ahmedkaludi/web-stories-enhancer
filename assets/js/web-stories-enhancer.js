function tabToggle(evt, idname) {
 var i, tabcontent, tablinks;tabcontent = document.getElementsByClassName("websten-tabcontent");
  for (i = 0; i < tabcontent.length; i++) { 
    tabcontent[i].style.display = "none"; 
  } 
  tablinks = document.getElementsByClassName("websten-tablinks"); 
  for (i = 0; i < tablinks.length; i++) { 
    tablinks[i].className = tablinks[i].className.replace(" active", "");
     } 
  document.getElementById(idname).style.display = "block"; 

  evt.target.className += " active";
}

function webstenIsEmail(email) {
        var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        return regex.test(email);
}
  

  //query form send starts here
jQuery(document).ready(function($) {

  var url = window.location.href; 
    if(url.indexOf('#technical-support') > -1){
        $("#websten-technical").click();
    }else if(url.indexOf('#freevspro-support') > -1){
            $("#websten-freevspro").click();
        }
        else if(url.indexOf('#welcome') > -1){
            $("#websten-welcome").click();
        }
        else{ 
       $("#websten-default").click();
    }

    $(".websten-send-query").on("click", function(e){
            e.preventDefault();   
            var message     = $("#websten_query_message").val();  
            var email       = $("#websten_query_email").val();  
            // var premium_cus = $("#saswp_query_premium_cus").val(); 
            
            if($.trim(message) !='' && $.trim(email) !='' && webstenIsEmail(email) == true){
             $.ajax({
                            type: "POST",    
                            url:ajaxurl,                    
                            dataType: "json",
                            data:{action:"websten_send_query_message",message:message,email:email, websten_security_nonce:websten_admin_data.websten_security_nonce},
                            success:function(response){                       
                              if(response['status'] =='t'){
                                $(".websten-query-success").show();
                                $(".websten-query-error").hide();
                              }else{                                  
                                $(".websten-query-success").hide();  
                                $(".websten-query-error").show();
                              }
                            },
                            error: function(response){                    
                            console.log(response);
                            }
                            });   
            }else{
                
                if($.trim(message) =='' && $.trim(email) ==''){
                    alert('Please enter the message, email and select customer type');
                }else{
                
                if($.trim(message) == ''){
                    alert('Please enter the message');
                }
                if($.trim(email) == ''){
                    alert('Please enter the email');
                }
                if(webstenIsEmail(email) == false){
                    alert('Please enter a valid email');
                }
                    
                }
                
            }                        

        });

    $("#subscribe-newsletter-form").on('submit',function(e){
        e.preventDefault();
        var $form = $("#subscribe-newsletter-form");
        var name = $form.find('input[name="name"]').val();
        var email = $form.find('input[name="email"]').val();
        var website = $form.find('input[name="company"]').val();
        $.post(ajaxurl, {action:'eztoc_subscribe_newsletter',name:name, email:email,website:website},
          function(data) {}
        );
    });
    }); 