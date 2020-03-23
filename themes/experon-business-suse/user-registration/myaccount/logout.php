<?php
/*
 * Custom logout confirmation page, chance to hook up additional actions here.
 */
?>

<div class="logout">
  <h2 class="label"><?php echo __('Are you sure you want to log out?', 'experon');?></h2>
  <a class="themebutton" href="<?php echo ur_logout_url(); ?>"><?php echo __('yes, log out', 'experon');?></a>
</div>
