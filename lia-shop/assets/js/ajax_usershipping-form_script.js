/** Ajax script for saving user form data */
function send_userinfo() {
    jQuery.ajax({
        type: "POST",
        url: myajax.url,
        data: {
            action: "save_shipping_data",
            user_country: jQuery("select[name=\'user_country\']").val(),
            firstname: jQuery("input[name=\'firstname\']").val(),
            lastname: jQuery("input[name=\'lastname\']").val(),
            company_name: jQuery("input[name=\'company_name\']").val(),
            user_address: jQuery("input[name=\'user_address\']").val(),
            user_apartment: jQuery("input[name=\'user_apartment\']").val(),
            user_town: jQuery("input[name=\'user_town\']").val(),
            user_zip: jQuery("input[name=\'user_zip\']").val(),
            user_state: jQuery("input[name=\'user_state\']").val(),
            user_phone: jQuery("input[name=\'user_phone\']").val(),
            user_email: jQuery("input[name=\'user_email\']").val(),
            },
        success: function() {
            alert("Your data has been successfully saved !");
        },
        error:  function(xhr, str){
            alert("Sorry! Some errors while saving the data! : " + xhr.responseCode);
          }
        });
}