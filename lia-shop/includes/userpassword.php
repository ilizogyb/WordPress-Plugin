<?php
function lia_user_password( $atts ) {
    $lia_user_password = '<div class="user_prof_container">                        
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
                         My password
                       </div>
                   </div>';
                   //wp_set_password( 'my-new-password', $user->ID );
	return  $lia_user_password;
}
add_shortcode( 'user_password', 'lia_user_password' );