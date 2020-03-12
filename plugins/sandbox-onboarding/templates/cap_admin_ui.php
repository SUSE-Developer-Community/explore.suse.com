<div class="wrap settings">
  <h2><?php _e('cap_sandbox_settings', 'sandbox_onboarding'); ?></h2>

  <form method="post" action="">
    <table class="form-table">
      <tr>
        <th>
          <label for="sandbox_onboarding_plugin_settings_cap_onboarding_url"><?php _e('cap_sandbox_cap_onboarding_url', 'sandbox_onboarding'); ?>:</label>
        </th>
        <td>
          <input class="url" type="text" id="sandbox_onboarding_plugin__settings_cap_onboarding_url" name="sandbox_onboarding_plugin_settings[cap_sandbox_cap_onboarding_url]" value="<?php
            echo (isset ($settings['cap_sandbox_cap_onboarding_url']) ? htmlspecialchars($settings['cap_sandbox_cap_onboarding_url']) : '');
          ?>" />
          <p class="description"><?php _e('cap_sandbox_cap_onboarding_url_description', 'sandbox_onboarding'); ?></p>
        </td>
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