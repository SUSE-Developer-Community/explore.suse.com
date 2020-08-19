<?php
/** 
 * Rendering the UI for authenticated (logged in) sessions.
 * 
 * For new users we request an explicit consent to the terms and conditions.
 */
?>
<form class="sandbox" method="post" type="x-www-form-urlencoded" action="<?php echo $form_url; ?>">
  <p class="username">
    <label for="username"><?php echo __('cap_sandbox_username', 'sandbox_onboarding'); ?><span class="required">*</span></label>
    <input id="username" type="text" value="<?php echo $current_user->user_login; ?>" name="userName" required="required" />
  </p>
  <p class="password">
    <label for="password"><?php echo __('cap_sandbox_user_password', 'sandbox_onboarding'); ?><span class="required">*</span></label>
    <input id="password" type="password" value="" autocomplete="current-password" name="password" required="required" />
  </p>
  <input type="hidden" value="<?php echo $email; ?>" name="email" />
  <input type="hidden" value="<?php echo $current_user->first_name; ?>" name="firstName" />
  <input type="hidden" value="<?php echo $current_user->last_name; ?>" name="lastName" />

  <p class="consent submit">
    <input id="user_consent" name="user_consent" type="checkbox" />
    <label for="user_consent">
    <?php echo sprintf(__('cap_sandbox_user_consent_%s', 'sandbox_onboarding'), $tandc_page_guid); ?>
    </label>
  </p>
  <p class="submit">
    <input id="request_account" disabled="true" type="submit" class="button-primary" value="<?php echo $btn_txt; ?>" />
  </p>
</form>

