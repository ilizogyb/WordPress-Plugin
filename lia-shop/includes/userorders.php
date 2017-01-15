<?php
function lia_user_orders_func( $atts ) {
    $lia_user_orders = '<div class="user_prof_container">                        
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
                         User orders page 
                       </div>
                   </div>';
	return  $lia_user_orders;
}
add_shortcode( 'lia_user_orders', 'lia_user_orders_func' );