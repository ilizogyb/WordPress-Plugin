<?php
/**
 * @package LIA shop
 * @version 1.0
 */
/*
Plugin Name: LIA shop
Description: Shop module for WordPress
Author: Matt LIA240288
Version: 1.0
*/

define('LIA_SHOP_DIR', plugin_dir_path(__FILE__));
define('LIA_SHOP_URL', plugin_dir_url(__FILE__));

function lia_shop_load(){
    if(is_admin()) // require admin files
      require_once(LIA_SHOP_DIR.'includes/admin.php');
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
