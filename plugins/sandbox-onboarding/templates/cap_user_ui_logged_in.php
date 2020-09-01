<?php
/** 
 * UI for authenticated (logged in) sessions.
 */
?>
<div id="tabs">
  <ul>
    <li><a href="#newacct"><?php echo __('new_sandbox_account', 'sandbox_onboarding'); ?></a></li>
    <li><a href="#accounts"><?php echo __('existing_sandbox_accounts', 'sandbox_onboarding'); ?></a></li>
  </ul>
  <div id="newacct">

    <p class="username">
      <label for="username"><?php echo __('cap_sandbox_username', 'sandbox_onboarding'); ?><span class="required">*</span></label>
      <input id="username" type="text" value="<?php echo $current_user->user_login; ?>" name="userName" required="required" />
    </p>
    <p class="password">
      <label for="password"><?php echo __('cap_sandbox_user_password', 'sandbox_onboarding'); ?><span class="required">*</span></label>
      <input id="password" type="password" value="" autocomplete="current-password" name="password" required="required" />
      <p class="hints"><?php echo __('cap_sandbox_password_hints', 'sandbox_onboarding'); ?></p>
    </p>

    <p class="consent submit">
      <input id="user_consent" name="user_consent" type="checkbox" />
      <label for="user_consent">
      <?php echo sprintf(__('cap_sandbox_user_consent_%s', 'sandbox_onboarding'), $tandc_page_guid); ?>
      </label>
    </p>
    <p class="submit">
      <input id="request_account" disabled="true" type="submit" class="button-primary" value="<?php echo $btn_txt; ?>" />
    </p>

    <div class="response"></div>
  </div>
  <div id="accounts">

    <div class="notice">
      <div class="wait">    
        <?php echo __('please_wait', 'sandbox_onboarding'); ?>
      </div>
      <div class="nodata">    
        <?php echo sprintf(__('no_sandbox_accounts', 'sandbox_onboarding'), $email); ?>
      </div>
    </div>

    <ul class="header">
      <li>
        <div class="account">Account Name</div>
        <div class="lastaccess">Last Access</div> 
        <div class="lastpasschange">Last Password Change</div>
        <div class="actions">Actions</div>
      </li>
    </ul>    
    <ul class="data">
      <li>
        <div class="account">Account Name</div>
        <div class="lastaccess">Last Access</div> 
        <div class="lastpasschange">Last Password Change</div>
        <div class="actions">
          <span class="changepass">Change Password</span>
          <span class="delete">Delete Account</span>
        </div>
      </li>
    </ul>
      
    <div class="changepass">
      <span class="close">X</span>

      <h4 class="title"><?php echo __('cap_sandbox_set_new_password_for', 'sandbox_onboarding'); ?></h4>
      <h5 class="account"></h5>

      <div class="content">
        <label for="password1" class="required"><?php echo __('cap_sandbox_new_password', 'sandbox_onboarding'); ?></label>
        <input type="password" name="password1" id="password1" autocomplete="new-password" minlength="8" required />

        <label for="password2" class="required"><?php echo __('cap_sandbox_new_password_confirmation', 'sandbox_onboarding'); ?></label>
        <input type="password" name="password2" id="password2" autocomplete="new-password" minlength="8" required />
      
        <p class="hints"><?php echo __('cap_sandbox_password_hints', 'sandbox_onboarding'); ?></p>
        <p class="submit">
          <input id="change_password" type="button" class="button-primary" value="<?php echo __('cap_sandbox_change_password', 'sandbox_onboarding'); ?>" disabled="true" />
        </p>  
      </div>

      <div class="response"></div>
    </div>

  </div>
</div>