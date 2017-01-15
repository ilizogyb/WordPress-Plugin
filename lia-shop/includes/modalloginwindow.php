<?php
add_action('init', 'checking_user_status');

/** Display modal window*/
function lia_shop_login_modal() {
    
    echo ' <!-- The Modal -->
        <div id="myModal" class="modal">
              <!-- Modal content -->
              <div class="modal-content">
                <div class="modal-header">
                  <span class="close">&times;</span>
                </div>
                <div class="modal-body">
                    <form name="loginform" id="loginform" action="wp-login.php" method="post">
                     <label for="user_login"><img style="padding-top:0px;" src="' . LIA_SHOP_URL . 'assets/img/user.png" alt="login_user_pict">Your login</label>
                      <p><input size="20" type="text" name="log" id="user_login" value="" placeholder="User login"  required></p>
                      
                      <label for="user_pass"><img style="padding-top:0px;" src="' . LIA_SHOP_URL . 'assets/img/userpassword.png" alt="login_user_pict">Your password</label>
                      <p><input size="20" type="password" name="pwd" id="user_pass" value="" placeholder="User password"  required></p>
                      
                      <p class="forgetmenot"><label for="rememberme"><input name="rememberme" id="rememberme" value="forever" type="checkbox"> Remember me</label></p>
                      
                      <button class="modal-user-login-submit" type="submit">Login</button>
	
                    </form>
                </div>
                <div class="modal-footer">
                  <p><a href="wp-login.php?action=register">Registration</a><a href="wp-login.php?action=lostpassword">Forgot Password</a></p>
                </div>
              </div>
        </div>'; 
}
