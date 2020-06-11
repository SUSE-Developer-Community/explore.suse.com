<?php
  $i18n_domain = 'suse_id_helper';
?>
<div class="wrap settings">
  <h2><?php _e('suse_id_settings', $i18n_domain); ?></h2>

  <form method="post" action="">
    <table class="form-table">
      <tr>
        <th>
          <label for="suse_id_plugin_settings_login_page"><?php _e('login_page', $i18n_domain); ?>:</label>
        </th>
        <td>
          <?php echo $settings['login_page']; ?>
          <p class="description"><?php _e('suse_id_login_page_description', $i18n_domain); ?></p>
        </td>
      </tr>

      <tr>
        <th>
          <label for="suse_id_plugin_settings_myaccount_page"><?php _e('myaccount_page', $i18n_domain); ?>:</label>
        </th>
        <td>
          <?php echo $settings['myaccount_page']; ?>
          <p class="description"><?php _e('suse_id_myaccount_page_description', $i18n_domain); ?></p>
        </td>
      </tr>

      <tr>
        <th>
          <label for="suse_id_plugin_settings_sso_login_url"><?php _e('sso_login_url', $i18n_domain); ?>:</label>
        </th>
        <td>
          <input class="url" type="text" id="suse_id_plugin_settings_sso_login_url" name="suse_id_plugin_settings[sso_login_url]" value="<?php
            echo (isset ($settings['sso_login_url']) ? htmlspecialchars($settings['sso_login_url']) : '');
          ?>" />
          <p class="description"><?php _e('suse_id_sso_login_url_description', $i18n_domain); ?></p>

          <p class="shortcode">
            <h4><?php _e('shortcode', $i18n_domain); ?></h4>
            <blockquote>[sso_login_shortcode label="Login"]</blockquote>
          </p>
        </td>
      </tr>

      <tr>
        <th>
          <label for="suse_id_plugin_settings_login_label"><?php _e('login_label', $i18n_domain); ?>:</label>
        </th>
        <td>
          <input class="url" type="text" id="suse_id_plugin_settings_login_label" name="suse_id_plugin_settings[login_label]" value="<?php
            echo (isset ($settings['login_label']) ? htmlspecialchars($settings['login_label']) : '');
          ?>" />
          <p class="description"><?php _e('suse_id_login_label_description', $i18n_domain); ?></p>
        </td>
      </tr>

      <tr>
        <th>
          <label for="suse_id_plugin_settings_account_create_url"><?php _e('account_create_url', $i18n_domain); ?>:</label>
        </th>
        <td>
          <input class="url" type="text" id="suse_id_plugin_settings_account_create_url" name="suse_id_plugin_settings[account_create_url]" value="<?php
            echo (isset ($settings['account_create_url']) ? htmlspecialchars($settings['account_create_url']) : '');
          ?>" />
          <p class="description"><?php _e('suse_id_account_create_url_description', $i18n_domain); ?></p>

          <p class="shortcode">
            <h4><?php _e('shortcode', $i18n_domain); ?></h4>
            <blockquote>[account_create_url label="Create SUSE Account"]</blockquote>
          </p>
        </td>
      </tr>

      <tr>
        <th>
          <label for="suse_id_plugin_settings_account_update_url"><?php _e('account_update_url', $i18n_domain); ?>:</label>
        </th>
        <td>
          <input class="url" type="text" id="suse_id_plugin_settings_account_update_url" name="suse_id_plugin_settings[account_update_url]" value="<?php
            echo (isset ($settings['account_update_url']) ? htmlspecialchars($settings['account_update_url']) : '');
          ?>" />
          <p class="description"><?php _e('suse_id_account_update_url_description', $i18n_domain); ?></p>

          <p class="shortcode">
            <h4><?php _e('shortcode', $i18n_domain); ?></h4>
            <blockquote>[account_update_url label="Update Account"]</blockquote>
          </p>
        </td>
      </tr>

      <tr>
        <th>
          <label for="suse_id_plugin_settings_password_reset_url"><?php _e('password_reset_url', $i18n_domain); ?>:</label>
        </th>
        <td>
          <input class="url" type="text" id="suse_id_plugin_settings_password_reset_url" name="suse_id_plugin_settings[password_reset_url]" value="<?php
            echo (isset ($settings['password_reset_url']) ? htmlspecialchars($settings['password_reset_url']) : '');
          ?>" />
          <p class="description"><?php _e('suse_id_password_reset_url_description', $i18n_domain); ?></p>

          <p class="shortcode">
            <h4><?php _e('shortcode', $i18n_domain); ?></h4>
            <blockquote>[password_reset_url label="Reset Password"]</blockquote>
          </p>
        </td>
      </tr>
    </table>

    <p class="submit">
      <input type="submit" class="button-primary" value="<?php _e('save_changes', $i18n_domain) ?>" />
    </p>
  </form>
</div>