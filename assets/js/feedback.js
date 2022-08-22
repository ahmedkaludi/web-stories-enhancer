var strict;

jQuery(document).ready(function ($) {
    /**
     * DEACTIVATION FEEDBACK FORM
     */
    // show overlay when clicked on "deactivate"
    websten_deactivate_link = $('.wp-admin.plugins-php tr[data-slug="web-stories-enhancer"] .row-actions .deactivate a');
    websten_deactivate_link_url = websten_deactivate_link.attr('href');

    websten_deactivate_link.click(function (e) {
        e.preventDefault();

        // only show feedback form once per 30 days
            var c_value = websten_admin_get_cookie("websten_hide_deactivate_feedback");


        if (c_value === undefined) {
            $('#websten-reloaded-feedback-overlay').show();
        } else {
            // click on the link
            window.location.href = websten_deactivate_link_url;
        }
    });
    // show text fields
    $('#websten-reloaded-feedback-content input[type="radio"]').click(function () {
        // show text field if there is one
        $(this).parents('li').next('li').children('input[type="text"], textarea').show();
    });
    // send form or close it
    $('#websten-reloaded-feedback-content .button').click(function (e) {
        e.preventDefault();
        // set cookie for 30 days
        var exdate = new Date();
        exdate.setSeconds(exdate.getSeconds() + 2592000);
        document.cookie = "websten_hide_deactivate_feedback=1; expires=" + exdate.toUTCString() + "; path=/";

        $('#websten-reloaded-feedback-overlay').hide();
        if ('websten-reloaded-feedback-submit' === this.id) {
            // Send form data
            $.ajax({
                type: 'POST',
                url: ajaxurl,
                dataType: 'json',
                data: {
                    action: 'websten_send_feedback',
                    data: $('#websten-reloaded-feedback-content form').serialize()
                },
                complete: function (MLHttpRequest, textStatus, errorThrown) {
                    // deactivate the plugin and close the popup
                    $('#websten-reloaded-feedback-overlay').remove();
                    window.location.href = websten_deactivate_link_url;

                }
            });
        } else {
            $('#websten-reloaded-feedback-overlay').remove();
            window.location.href = websten_deactivate_link_url;
        }
    });
    // close form without doing anything
    $('.websten-feedback-not-deactivate').click(function (e) {
        $('#websten-reloaded-feedback-overlay').hide();
    });

    function websten_admin_get_cookie (name) {
	var i, x, y, websten_cookies = document.cookie.split( ";" );
	for (i = 0; i < websten_cookies.length; i++)
	{
		x = websten_cookies[i].substr( 0, websten_cookies[i].indexOf( "=" ) );
		y = websten_cookies[i].substr( websten_cookies[i].indexOf( "=" ) + 1 );
		x = x.replace( /^\s+|\s+$/g, "" );
		if (x === name)
		{
			return unescape( y );
		}
	}
}

}); // document ready 