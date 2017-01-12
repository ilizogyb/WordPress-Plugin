<?php

/* display page content */
function lia_shop_admin_page_screen() {
    global $submenu;
 
    // access page settings
    $page_data = array();
 
    foreach ($submenu['options-general.php'] as $i => $menu_item) {
        if ($submenu['options-general.php'][$i][2] == 'lia_shop') {
            $page_data = $submenu['options-general.php'][$i];
        }
    }
    //content
    ?> 

    <div class="wrap">
        <?php screen_icon(); ?>
        <h2><?php echo $page_data[3]; ?></h2>
        <form id="lia_shop_options" action="options.php" method="post">
            <?php
            settings_fields('lia_shop_options');
            do_settings_sections('lia_shop');
            submit_button('Save options', 'primary', 'lia_shop_options_submit');
            ?>
        </form>
    </div>
    <?php
}
 
/* Settings link in plugin management screen */

function lia_shop_settings_link($actions, $file) {
    if (false !== strpos($file, 'lia-shop')) {
        $actions['settings'] = '<a href="options-general.php?page=lia_shop">Settings</a>';
    }
 
    return $actions;
}

add_filter('plugin_action_links', 'lia_shop_settings_link', 2, 2);


///Admin Menu
/** adding plugin main menu in the admin panel*/
add_action( 'admin_menu', 'my_plugin_menu' );

/** Account info menu and submenu items */
function my_plugin_menu() {
	add_menu_page( 'Account Info', 'Account info', 'manage_options', 'my-account-info-identifier', 'my_plugin_options','dashicons-admin-users');
    
    add_submenu_page( 'my-account-info-identifier', "User Info", "User Info", 'manage_options', 'my_user_info_submenu_page',  'my_user_info_submenu_page_callback');
    
    add_submenu_page( 'my-account-info-identifier', "Virtual account", "Virtual account", 'manage_options', 'my_virtual_acount_submenu_page',  'my_virtual_acount_submenu_page_callback');
    
    add_submenu_page( 'my-account-info-identifier', "Pending purchases", "Pending purchases", 'manage_options', 'my_pending_purchases_submenu_page', 'my_pending_purchases_submenu_page_callback');
    
    ///
    add_menu_page( 'Referal center', 'Referal center', 'manage_options', 'my-referal-menu-identifer', 'my_referal_center_options', 'dashicons-chart-line' );
    
    add_submenu_page( 'my-referal-menu-identifer', "Sponsored users", "Sponsored users", 'manage_options', 'my_sponsored users_submenu_page', 'my_sponsored_users_submenu_page_callback');
}

/** Account info menu page */
function my_plugin_options() {
	if ( !current_user_can( 'manage_options' ) )  {
		wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
	}
	// content
	echo '<div class="wrap">';
	echo '<h2><span class="dashicons dashicons-admin-users"></span> Account information</h2>';
    
    $curent_user = wp_get_current_user();
    
    //display avatar
    echo get_avatar($curent_user->ID, 96, '', $curent_user->display_name, '' );
    
    //display short info about user
    echo "<p>Name: <span style='font-weight: bold'>$curent_user->display_name</span></p>";
    echo "<p>Email: <span style='font-weight: bold'>$curent_user->user_email</span></p>";
    echo "<p>Registered: <span style='font-weight: bold'>$curent_user->user_registered</span></p>";
	echo '</div>';
}

/** User info submenu page */
function my_user_info_submenu_page_callback() {
    if ( !current_user_can( 'manage_options' ) )  {
		wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
	}
	// content
	echo '<div class="wrap">';
	echo '<h2><span class="dashicons dashicons-clipboard"></span> User information</h2>';
    //user informations form
    echo '<form action="action_page.php">
            Country:<br>
            <select>
              <option>United Kingdom</option>
              <option>Ukraine</option>
              <option>Russian</option>
              <option>Poland</option>
            </select>
            <br>
            
            First name:<br>
            <input type="text" name="firstname" value=' . wp_get_current_user()->user_firstname . '>
            <br>
            Last name:<br>
            <input type="text" name="lastname" value=' . wp_get_current_user()->user_lastname . '>
            <br>
            Company name:<br>
            <input type="text" name="company_name" value=' . wp_get_current_user()->user_lastname . '>
            <br>
            Address:<br>
            <input type="text" name="company_name" value="">
            <br>
            
            Apartment:<br>
            <input type="text" name="company_name" value="12 abs Street">
            <br>
            
            Town / City:<br>
            <input type="text" name="company_name" value="London">
            <br>
            
            <br><br>
            <input type="submit" value="Save">
          </form>'; 
    
	echo '</div>';
}

/** User acount submenu page */
function my_virtual_acount_submenu_page_callback() {
    if ( !current_user_can( 'manage_options' ) )  {
		wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
	}
	// content
	echo '<div class="wrap">';
	echo '<h2><span class="dashicons dashicons-nametag"></span> Virtual account</h2>';
    echo '<div style="width: 30em; height: 10em; float: left; margin: 2em; background-color: #FFDAB9; text-align: center;"><p style="text-align: center;">Available Balance<p>
    <div style="width: 30em; height: 4.5em;  background-color: #FFFFFF; padding-top: 3em;">$0</div></div>';
    
	echo '<div style="width: 30em; height: 10em; float: left; margin:
    2em; background-color: #F0FFF0; text-align: center;"><p style="text-align: center;">Withdrawals Made<p><div style="width: 30em; height: 4.5em;  background-color: #FFFFFF; padding-top: 3em;">$0</div></div>';
   
    echo '<div style="width: 30em; height: 10em; float: left; margin: 2em;background-color: #F0F8FF; text-align: center;"><p style="text-align: center;">Pending Withdrawals<p><div style="width: 30em; height: 4.5em;  background-color: #FFFFFF; padding-top: 3em;">$0</div></div>';
    
    echo '</div>';

}

/** Pending purchases submenu page */
function my_pending_purchases_submenu_page_callback() {
    if ( !current_user_can( 'manage_options' ) )  {
		wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
	}
    // content
	echo '<div class="wrap">';
	echo '<h2><span class="dashicons dashicons-cart"></span> Pending purchases</h2>';
    
    echo '<table style="width: 50%; text-align:center; border: 1px solid #dddddd; margin-top: 2em;">
            <tr>
                <th>Number</th>
                <th>Product</th>
                <th>Price</th>
            </tr>
            <tr>
                <td>1</td>
                <td>TV-box Android</td>
                <td>249$</td>
            </tr>
        <table>';
    
	echo '</div>';
}



/** Referal center menu page */
function my_referal_center_options() {
	if ( !current_user_can( 'manage_options' ) )  {
		wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
	}
	// content
	echo '<div class="wrap">';
	echo '<h2><span class="dashicons dashicons-chart-line"></span> Referal center</h2>';
	echo '</div>';
}

/** Referal center menu page */
function my_sponsored_users_submenu_page_callback() {
    if ( !current_user_can( 'manage_options' ) )  {
		wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
	}
	// content
	echo '<div class="wrap">';
	echo '<h2><span class="dashicons dashicons-groups"></span> Sponsored users</h2>';
	echo '</div>';
}


