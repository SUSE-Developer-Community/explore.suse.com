<?php
/** 
 * UI for non-authenticated (logged out) sessions.
 */
?>
<div class="create_acct">
<?php echo do_shortcode('[account_create_url label="Create a SUSE Account"]'); ?>
</div>
<a href="/wp-login.php">
  <button class="sandbox"><?php echo get_option("cap_sandbox_loggedout_text"); ?></button>
</a>
