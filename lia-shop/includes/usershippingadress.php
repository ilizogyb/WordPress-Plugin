<?php
///test zone
function lia_shiping_addr_func( $atts ) {
    //enqueue ajax script for load countries
    wp_enqueue_script( 'user-country-ajax', plugins_url( "lia-shop/assets/js/userform_countries_script.js", LIA_SHOP_DIR), array(), '1.0.0', true );
    
    wp_enqueue_script( 'user-shippingaddr-form-ajax', plugins_url( "lia-shop/assets/js/ajax_usershipping-form_script.js", LIA_SHOP_DIR), array(), '1.0.0', true );
    
    //Gettin user data from database
    global $wpdb;
    $user_data = get_user_info();
    
    $lia_shipping_addr = '<div class="user_prof_container">                        
                       <div class="user_prof_avatar">
                           <img src="http://placehold.it/200x200" />
                       </div>
                       <div class="user_prof_menu">
                       <ul>
                           <li><a href="/user-account">Account</a></li>
                           <li><a href="/user-account-password">Change password</a></li>
                           <li><a href="/client-profiles">Billing address</a></li>
                           <li><a href="/shipping-address">Shipping address</a></li>
                           <li><a href="/user-orders">My orders</a></li>
                           <li><a href="/user-privacy-setting">Privacy</a></li>
                           <li><a href="/user-removing-account">Delete account</a></li>
                       </ul>
                       </div>
                       <div class="user_prof_form">
                          <form id="user_info_form" onsubmit="send_userinfo(); return false;">
                          <div class="user_prof-form-group">
                              <label for="country_input">Country </label>
                              <select name="user_country" id="country_input">
                                <option> ' . $user_data->user_country . '</option>
                                <option> United Kingdom</option>
                              </select>
                           </div>
                           <div class="user_prof-form-group">
                               <label for="firstname_input">First name </label>
                                <input type="text" name="firstname" value="' .  $user_data->user_firstname . '" id="firstname_input" placeholder="First name" required="required" >
                           </div>
                           <div class="user_prof-form-group">
                                <label for="lastname">Last name </label>
                                <input type="text" name="lastname" value="' . $user_data->user_lastname . '" id="lastname" placeholder="Last name" required="required">
                            </div>
                            <div class="user_prof-form-group">
                                <label for="company_input">Company name </label>
                                <input type="text" name="company_name" value="' . $user_data->user_company . '" id="company_input" placeholder="Company name">
                            </div> 
                            <div class="user_prof-form-group">
                                <label for="address_input">Address </label>
                                <input type="text" name="user_address" value="' .  $user_data->user_address . '" id="address_input" placeholder="Address" required="required">
                            </div>  
                            <div class="user_prof-form-group">
                                <label for="apartment_input">Apartment, suite, unit, etc.(optional) </label>
                                <input type="text" name="user_apartment" value="' .  $user_data->user_apartment . '" id="apartment_input" placeholder="Apartment, suite, unit, etc.(optional)">
                            </div> 
                            <div class="user_prof-form-group">
                                <label for="zip_input">Zip Code </label>
                                <input type="text" name="user_zip" value="' .  $user_data->user_zip . '" id="zip_input" placeholder="Zip Code" required="required">
                            </div>
                            <div class="user_prof-form-group">
                                <label for="town_input">Town/City </label>
                                <input type="text" name="user_town" value="' .  $user_data->user_town . '" id="town_input" placeholder="Town/City" required="required">
                            </div>
                            <div class="user_prof-form-group">
                                <label for="user_state">State</label>
                                <input type="text" name="user_state" value="' .  $user_data->user_state . '" id="user_state" placeholder="State" required="required">
                            </div>
                            <div class="user_prof-form-group">
                                <label for="user_phone">Phone</label>
                                <input type="text" name="user_phone" value="' .  $user_data->user_phone . '" id="user_phone" placeholder="Phone" required="required">
                            </div>   
                            <div class="user_prof-form-group">
                                <label for="user_email">Email</label>
                                <input type="text" name="user_email" value="' .  $user_data->user_email . '" id="user_email" placeholder="Email" required="required">
                            </div>                             
                            <div>
                                <button type="submit" class="right_form_submit"><span class="glyphicon glyphicon-save" aria-hidden="true"></span> Save/Edit</button>                            
                            </div>   
                          </form>
                       </div>
                   </div>';
	return $lia_shipping_addr;
}

add_shortcode( 'lia_shiping_addr', 'lia_shiping_addr_func' );