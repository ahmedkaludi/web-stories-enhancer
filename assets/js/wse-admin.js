
  function openTab(evt, tabName) {
    var i, tabcontent, tablinks;
    tabcontent = document.getElementsByClassName("wse-tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
      tabcontent[i].style.display = "none";
    }
    tablinks = document.getElementsByClassName("wse-tablinks");
    for (i = 0; i < tablinks.length; i++) {
      tablinks[i].className = tablinks[i].className.replace(" active", "");
    }
    document.getElementById(tabName).style.display = "block";
    evt.currentTarget.className += " active";
  }
  
  // Get the element with id="wse-tab-intro" and click on it
  document.getElementById('wse-tab-intro').click();
  jQuery(document).ready(function($) {
  if(wse_cur_tab=='support')
  {
    document.getElementById('wse-tab-support').click();
  }
  $(".wse-send-query").on("click", function(e){
    e.preventDefault();   
    var message     = $("#wse_query_message").val();  
    var email       = $("#wse_query_email").val();  
    
    if($.trim(message) !='' && $.trim(email) !='' && wseIsEmail(email) == true){
     $.ajax({
                    type: "POST",    
                    url:ajaxurl,                    
                    dataType: "json",
                    data:{action:"wse_send_query_message",message:message,email:email,wse_security_nonce:wse_script_vars.nonce},
                    success:function(response){                       
                      if(response['status'] =='t'){
                        $(".wse-query-success").show();
                        $(".wse-query-error").hide();
                      }else{                                  
                        $(".wse-query-success").hide();  
                        $(".wse-query-error").show();
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
        if(wseIsEmail(email) == false){
            alert('Please enter a valid email');
        }
            
        }
        
    }                        

});
  });

  function wseIsEmail(email) {
    var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    return regex.test(email);
}

function wse_copy() {
  var copyText = document.getElementById("wse-input");
  copyText.select();
  copyText.setSelectionRange(0, 99999);
  navigator.clipboard.writeText(copyText.value);
  var tooltip = document.getElementById("wse-tooltip");
  tooltip.innerHTML = "Shortcode Copied";
}

function wse_out() {
  var tooltip = document.getElementById("wse-tooltip");
  tooltip.innerHTML = "Copy Shortcode";
}
