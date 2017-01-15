<?php
/** Update user information in the DataBase*/
add_action('wp_ajax_save_billing_data', 'my_save_billing_callback');
add_action('wp_ajax_save_shipping_data', 'my_save_shipping_callback');

function my_save_billing_callback() {

    if(!empty($_POST)) {
        global $wpdb;
        
        // To do: improove mechanizm for save or input data 
        
        $id_results = $wpdb->get_col("SELECT `user_id` FROM `shop_users`");
        
        //checking user data availability in the database
        if (!in_array(get_current_user_id(), $id_results)) {
            //if user does not exists in the database execute 
            $wpdb->insert( 'shop_users',
                array(
                    "user_id" => get_current_user_id(),
                    "user_country" => $_POST['user_country'],
                    "user_firstname" => $_POST['firstname'], 
                    "user_lastname" => $_POST['lastname'],
                    "user_company" => $_POST['company_name'], 
                    "user_address" => $_POST['user_address'], 
                    "user_apartment" => $_POST['user_apartment'], 
                    "user_town" => $_POST['user_town']), 
                array( '%d', '%s', '%s', '%s', '%s', '%s', '%s', '%s') );
        } else {
            //if user exists in the database execute update query
            $wpdb->update( 'shop_users',
                array("user_country" => $_POST['user_country'],
                    "user_firstname" => $_POST['firstname'], 
                    "user_lastname" => $_POST['lastname'],
                    "user_company" => $_POST['company_name'], 
                    "user_address" => $_POST['user_address'], 
                    "user_apartment" => $_POST['user_apartment'], 
                    "user_town" => $_POST['user_town']),
                array("user_id" => get_current_user_id()), array( '%s', '%s', '%s', '%s', '%s', '%s', '%s') );
        }
    }
}

function my_save_shipping_callback() {
    if(!empty($_POST)) {
        global $wpdb;
        
        // To do: improove mechanizm for save or input data 
        
        $id_results = $wpdb->get_col("SELECT `user_id` FROM `shop_users`");
        
        //checking user data availability in the database
        if (!in_array(get_current_user_id(), $id_results)) {
            //if user does not exists in the database execute 
            $wpdb->insert( 'shop_users',
                array(
                    "user_id" => get_current_user_id(),
                    "user_country" => $_POST['user_country'],
                    "user_firstname" => $_POST['firstname'], 
                    "user_lastname" => $_POST['lastname'],
                    "user_company" => $_POST['company_name'], 
                    "user_address" => $_POST['user_address'], 
                    "user_apartment" => $_POST['user_apartment'], 
                    "user_town" => $_POST['user_town'], 
                    "user_zip" => $_POST['user_zip'],
                    "user_state" => $_POST['user_state'],
                    "user_phone" => $_POST['user_phone']),
                array( '%d', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s') );
        } else {
            //if user exists in the database execute update query
            $wpdb->update( 'shop_users',
                array("user_country" => $_POST['user_country'],
                    "user_firstname" => $_POST['firstname'], 
                    "user_lastname" => $_POST['lastname'],
                    "user_company" => $_POST['company_name'], 
                    "user_address" => $_POST['user_address'], 
                    "user_apartment" => $_POST['user_apartment'], 
                    "user_town" => $_POST['user_town'],
                    "user_zip" => $_POST['user_zip'],                    
                    "user_state" => $_POST['user_state'],
                    "user_phone" => $_POST['user_phone']),
                array("user_id" => get_current_user_id()), array( '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s') );
        }
        
        //update user email
        if(isset($_POST['user_email'])) {
            $wpdb->update( 'wp_users', array(
                "user_email" => $_POST['user_email']),
                array("ID" => get_current_user_id()), array('%s'));
                
        }
    }    
    
}

