<?php
/**
 * @package LIA shop
 * @version 1.0
 */
/*
Plugin Name: LIA shop
Description: Shop module for WordPress
Author: LIA240288
Version: 1.0
*/


define('LIA_SHOP_DIR', plugin_dir_path(__FILE__));
define('LIA_SHOP_URL', plugin_dir_url(__FILE__));

/** Install plugin actions*/
function install_lia_shop() {
    //Creating shop_user table
    global $wpdb;
    $table_name = 'shop_users';
    
    if($wpdb->get_var("SHOW TABLES LIKE '" . $table_name . "'") != $table_name) {
        
        $sql = "CREATE TABLE " . $table_name . " (
              `user_id` bigint(20) unsigned NOT NULL,
              `user_country` varchar(45) NOT NULL,
              `user_firstname` varchar(45) NOT NULL,
              `user_lastname` varchar(45) NOT NULL,
              `user_company` varchar(45) DEFAULT NULL,
              `user_address` varchar(45) DEFAULT NULL,
              `user_apartment` varchar(45) DEFAULT NULL,
              `user_town` varchar(45) DEFAULT NULL,
              `user_zip` varchar(45) DEFAULT NULL,
              `user_state` varchar(45) DEFAULT NULL,
              `user_phone` varchar(20) DEFAULT NULL,
              PRIMARY KEY (`user_id`),
              CONSTRAINT `FK_user_id` FOREIGN KEY (`user_id`) REFERENCES `wp_users` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8;";
                
        require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
        dbDelta($sql);
    }
    
    //creating user info page
    $lia_user_password = array(
     'post_title' => 'User Account Password',
     'post_content' => '[user_password]',
     'post_status' => 'publish',
     'post_name'     => 'User Account Password',
     'post_type'    => 'page',
     'post_author' => get_current_user_id(),
     'post_category' => array(8,39),
     );
     
     //creating user info page
    $lia_user_info = array(
     'post_title' => 'User Account',
     'post_content' => '[user_account]',
     'post_status' => 'publish',
     'post_name'     => 'User Account',
     'post_type'    => 'page',
     'post_author' => get_current_user_id(),
     'post_category' => array(8,39),
     );

    //creating billing info page
    $lia_user_billing = array(
     'post_title' => 'Client-Profile',
     'post_content' => '[lia_billing]',
     'post_status' => 'publish',
     'post_name'     => 'Client Profiles',
     'post_type'    => 'page',
     'post_author' => get_current_user_id(),
     'post_category' => array(8,39),
     );
     
     //creating shipping address page
    $lia_user_shipping = array(
     'post_title' => 'Shipping-Address',
     'post_content' => '[lia_shiping_addr]',
     'post_status' => 'publish',
     'post_name'     => 'Shipping-Address',
     'post_type'    => 'page',
     'post_author' => get_current_user_id(),
     'post_category' => array(8,39),
     );
     
    //creating user orders page
    $lia_user_orders = array(
     'post_title' => 'User-Orders',
     'post_content' => '[lia_user_orders]',
     'post_status' => 'publish',
     'post_name'     => 'User-Orders',
     'post_type'    => 'page',
     'post_author' => get_current_user_id(),
     'post_category' => array(8,39),
  );
  
   //creating user privacy settings page
    $lia_user_privacy = array(
     'post_title' => 'User-Privacy-Setting',
     'post_content' => '[user_privacy]',
     'post_status' => 'publish',
     'post_name'     => 'User-Privacy-Setting',
     'post_type'    => 'page',
     'post_author' => get_current_user_id(),
     'post_category' => array(8,39),
  );
  
  //creating user privacy settings page
    $lia_remove_account = array(
     'post_title' => 'User-Removing-Account',
     'post_content' => '[lia_remove_account]',
     'post_status' => 'publish',
     'post_name'     => 'User-Removing-Account',
     'post_type'    => 'page',
     'post_author' => get_current_user_id(),
     'post_category' => array(8,39),
  );
  
  
  wp_insert_post( $lia_user_info );
  wp_insert_post( $lia_user_password );
  wp_insert_post( $lia_user_billing );
  wp_insert_post( $lia_user_shipping );
  wp_insert_post( $lia_user_orders );
  wp_insert_post( $lia_user_privacy );
  wp_insert_post( $lia_remove_account );
}

// register plugin instalation function
register_activation_hook(__FILE__,'install_lia_shop');




function lia_shop_load(){
    //if(is_admin()) // require admin files
      require_once(LIA_SHOP_DIR.'includes/admin.php');
      require_once(LIA_SHOP_DIR.'includes/modalloginwindow.php');
      require_once(LIA_SHOP_DIR.'includes/userinfo.php');
      require_once(LIA_SHOP_DIR.'includes/userpassword.php');
      require_once(LIA_SHOP_DIR.'includes/userinfoaction.php');
      require_once(LIA_SHOP_DIR.'includes/userbilling.php');
      require_once(LIA_SHOP_DIR.'includes/usershippingadress.php');
      require_once(LIA_SHOP_DIR.'includes/userorders.php');
      require_once(LIA_SHOP_DIR.'includes/userprivacyset.php');
      require_once(LIA_SHOP_DIR.'includes/userdelacc.php');
      

  }
lia_shop_load();

register_activation_hook(__FILE__, 'lia_shop_activation');
register_deactivation_hook(__FILE__, 'lia_shop_deactivation');
 
function lia_shop_activation() {
 
    // activation actions
}
 
function lia_shop_deactivation() {
    // deactivation actions
}


/** Including pluggin css */
wp_enqueue_style( 'lia_shop_load', plugins_url('lia-shop/assets/css/stylesheet.css', LIA_SHOP_DIR) );
wp_enqueue_script( 'user-login-form-ajax', plugins_url( "lia-shop/assets/js/ajax_login_form_script.js", LIA_SHOP_DIR), array(), '1.0.0', true );

/** localaize ajaxurl in the front end form */
add_action( 'wp_enqueue_scripts', 'myajax_data', 99 );
function myajax_data(){
   wp_localize_script('user-login-form-ajax', 'myajax', 
       array(
           'url' => admin_url('admin-ajax.php')
       )
    ); 
}


/** Cheking user status and show modal window if user is not logined */
function checking_user_status() {
    if (!is_user_logged_in() ) {
        add_action( 'wp_footer', 'lia_shop_login_modal' ); 
    }
}

/** Redirect to main page after loqout*/
function logout_redirect(){
    wp_redirect( '/' );
    exit();
}
add_action('wp_logout','logout_redirect');

/** Redirect to main page after loqin*/
function login_redirect() {
    return '/user-account';
}
add_filter('login_redirect', 'login_redirect');

///test zone

/**Page privacy functionality*/
// Add headers to keep browser from caching the pages when user not logged in
// Resolves a problem where users see the login form after logging in and need 
// to refresh to see content

function pr_no_cache_headers () {
	if ( !is_user_logged_in() )
		nocache_headers();
}

//add_action( 'send_headers' , 'pr_no_cache_headers' );



add_filter ( 'the_content' , 'pr_page_show');
function pr_page_show ( $pr_page_content ) {
    if ( !is_user_logged_in()) {
        //return "<script>window.location.replace('/');</script>";
        return '<strong>Forbidden - Sorry, you do not have sufficient rights to view this page. Login please!</strong>';
    } else {
        return $pr_page_content;
    }
}
