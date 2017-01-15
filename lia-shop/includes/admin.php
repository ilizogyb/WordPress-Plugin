<?php

///Admin Menu
/** adding plugin main menu in the admin panel*/
add_action( 'admin_menu', 'my_plugin_menu' );

/** Account info menu and submenu items */
function my_plugin_menu() {
	add_menu_page( 'Account Info', 'Account info', 'manage_options', 'my-account-info-identifier', 'my_plugin_options','dashicons-admin-users');
}

/** Account info menu page */
function my_plugin_options() {
	if ( !current_user_can( 'manage_options' ) )  {
		wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
	}
	// content
	echo '<div class="wrap">';
	echo '<h2><span class="glyphicon glyphicon-user"></span> Account information</h2>';
    echo '<p class="text-info bg-info">Your profile information</p>';
}

    


