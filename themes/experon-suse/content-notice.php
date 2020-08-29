<?php 
/* Notice content template part */
?>
<?php
  /* display the last 'notice' post, if any */
  $the_slug = 'notice';
  $args = array(
    'name'          => $the_slug,
    'category_name' => 'notice',
    'post_type'     => 'post',
    'post_status'   => 'publish',
    'numberposts'   => 1
  );
  $notices = get_posts($args);
  if($notices && $notices[0]->post_content != '') {
?>
<div class="notice">
  <h2><?php echo $notices[0]->post_title; ?></h2>
  <div class="content"><?php echo $notices[0]->post_content; ?></div>
</div>
<?php 
  }
?>
