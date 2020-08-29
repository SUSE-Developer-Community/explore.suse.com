<div class="wrap settings">
  <h2><?php _e('cap_sandbox_settings', 'sandbox_onboarding'); ?></h2>

  <form method="post" action="">
    <table class="form-table">
      <tr>
        <th>
          <label for="sandbox_onboarding_plugin_settings_onboarding_api_endpoint"><?php _e('cap_sandbox_onboarding_api_endpoint', 'sandbox_onboarding'); ?>:</label>
        </th>
        <td>
          <input class="url" type="text" id="sandbox_onboarding_plugin_settings_onboarding_api_endpoint" name="sandbox_onboarding_plugin_settings[cap_sandbox_onboarding_api_endpoint]" value="<?php
            echo (isset ($settings['cap_sandbox_onboarding_api_endpoint']) ? htmlspecialchars($settings['cap_sandbox_onboarding_api_endpoint']) : '');
          ?>" />
          <p class="description"><?php _e('cap_sandbox_onboarding_api_endpoint_description', 'sandbox_onboarding'); ?></p>
        </td>
      </tr>
      <tr>
        <th>
          <label for="sandbox_onboarding_plugin_settings_onboarding_api_username"><?php _e('cap_sandbox_onboarding_api_username', 'sandbox_onboarding'); ?>:</label>
        </th>
        <td>
          <input class="username" type="text" id="sandbox_onboarding_plugin_settings_onboarding_api_username" name="sandbox_onboarding_plugin_settings[cap_sandbox_onboarding_api_username]" value="<?php
            echo (isset ($settings['cap_sandbox_onboarding_api_username']) ? htmlspecialchars($settings['cap_sandbox_onboarding_api_username']) : '');
          ?>" />
          <p class="description"><?php _e('cap_sandbox_onboarding_api_username_description', 'sandbox_onboarding'); ?></p>
        </td>
      </tr>
      <tr>
        <th>
          <label for="sandbox_onboarding_plugin_settings_onboarding_api_password"><?php _e('cap_sandbox_onboarding_api_password', 'sandbox_onboarding'); ?>:</label>
        </th>
        <td>
          <input class="password" type="password" id="sandbox_onboarding_plugin_settings_onboarding_api_password" name="sandbox_onboarding_plugin_settings[cap_sandbox_onboarding_api_password]" value="<?php
            echo (isset ($settings['cap_sandbox_onboarding_api_password']) ? htmlspecialchars($settings['cap_sandbox_onboarding_api_password']) : '');
          ?>" 
            autocomplete="current-password" />
          <p class="description"><?php _e('cap_sandbox_onboarding_api_password_description', 'sandbox_onboarding'); ?></p>
        </td>
      </tr>
      <tr>
        <th>
          <label for="sandbox_onboarding_plugin_settings_show_passive_accounts"><?php _e('cap_sandbox_show_passive_accounts', 'sandbox_onboarding'); ?>:</label>
        </th>
        <td>
          <input class="cb" type="checkbox" id="sandbox_onboarding_plugin_settings_show_passive_accounts" name="sandbox_onboarding_plugin_settings[cap_sandbox_show_passive_accounts]" 
            <?php echo (isset ($settings['cap_sandbox_show_passive_accounts']) && $settings['cap_sandbox_show_passive_accounts'] == 1) ? 'checked' : ''; ?>/>
          <p class="description"><?php _e('cap_sandbox_onboarding_show_passive_accounts', 'sandbox_onboarding'); ?></p>
        </td>
      </tr>
      <tr>
        <th></th>
        <td><hr/></td>
      </tr>
      <tr>
        <th>
          <label for="sandbox_onboarding_plugin_settings_tandc_page"><?php _e('cap_sandbox_tandc_page', 'sandbox_onboarding'); ?>:</label>
        </th>
        <td>
          <?php echo $settings['cap_sandbox_tandc_page']; ?>
          <p class="description"><?php _e('cap_sandbox_tandc_page_description', 'sandbox_onboarding'); ?></p>
        </td>
      </tr>
      <tr>
        <th>
          <label for="sandbox_onboarding_plugin_settings_success_page"><?php _e('cap_sandbox_success_page', 'sandbox_onboarding'); ?>:</label>
        </th>
        <td>
          <?php echo $settings['cap_sandbox_success_page']; ?>
          <p class="description"><?php _e('cap_sandbox_success_page_description', 'sandbox_onboarding'); ?></p>
        </td>
      </tr>
      <tr>
        <th>
          <label for="sandbox_onboarding_plugin_settings_fail_page"><?php _e('cap_sandbox_fail_page', 'sandbox_onboarding'); ?>:</label>
        </th>
        <td>
          <?php echo $settings['cap_sandbox_fail_page']; ?>
          <p class="description"><?php _e('cap_sandbox_fail_page_description', 'sandbox_onboarding'); ?></p>
        </td>
      </tr>
      <tr>
        <th>
          <label for="sandbox_onboarding_plugin_settings_exists_page"><?php _e('cap_sandbox_exists_page', 'sandbox_onboarding'); ?>:</label>
        </th>
        <td>
          <?php echo $settings['cap_sandbox_exists_page']; ?>
          <p class="description"><?php _e('cap_sandbox_exists_page_description', 'sandbox_onboarding'); ?></p>
        </td>
      </tr>
      <tr>
        <th>
          <label for="sandbox_onboarding_plugin_settings_button_text"><?php _e('cap_sandbox_button_text', 'sandbox_onboarding'); ?>:</label>
        </th>
        <td>
          <input type="text" id="sandbox_onboarding_plugin_settings_button_text" name="sandbox_onboarding_plugin_settings[cap_sandbox_button_text]" size="25" value="<?php
            echo (isset ($settings['cap_sandbox_button_text']) ? htmlspecialchars($settings['cap_sandbox_button_text']) : '');
          ?>" />
          <p class="description"><?php _e('cap_sandbox_button_text_description', 'sandbox_onboarding'); ?></p>
        </td>
      </tr>
      <tr>
        <th>
          <label for="sandbox_onboarding_plugin_settings_loggedout_text"><?php _e('cap_sandbox_loggedout_text', 'sandbox_onboarding'); ?>:</label>
        </th>
        <td>
          <input type="text" id="sandbox_onboarding_plugin_settings_loggedout_text" name="sandbox_onboarding_plugin_settings[cap_sandbox_loggedout_text]" size="25" value="<?php
            echo (isset ($settings['cap_sandbox_loggedout_text']) ? htmlspecialchars($settings['cap_sandbox_loggedout_text']) : '');
          ?>" />
          <p class="description"><?php _e('cap_sandbox_loggedout_text_description', 'sandbox_onboarding'); ?></p>
        </td>
      </tr>
    </table>

    <p class="submit">
      <input type="submit" class="button-primary" value="<?php _e('save_changes', 'sandbox_onboarding') ?>" />
    </p>
  </form>
</div>