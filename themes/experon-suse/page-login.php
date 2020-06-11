<?php
/**
 * The template for the Login page
 *
 */

  $current_user = wp_get_current_user();

  if ($current_user->ID != 0) {
    // redirect to my-account if logged in
    // my account page is defined in the suse-id-helper plugin settings
    $url = (get_option("suse_id_myaccount_page") !== null) ? get_page_link(get_option("suse_id_myaccount_page")) : '/';
    wp_redirect($url);
    exit();   
  }

  get_header(); 

  while ( have_posts() ) : the_post();
?>

<div id="content">
  <h2><?php thinkup_title_select() ?></h2>
  <div id="content-core">
    <div id="main">
      <div id="main-core">

<?php the_content(); ?>

      </div><!-- #main-core -->
    </div><!-- #main -->
    <?php thinkup_sidebar_html(); ?>
  </div>
</div><!-- #content -->

<?php   
  endwhile;

  thinkup_input_allowcomments2(); 

  get_footer(); 
?>