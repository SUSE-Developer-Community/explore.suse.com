<?php
/**
 * The template for the Cap Sandbox Thank You page
 */
  $filepath = get_template_directory_uri() . '/lib/scripts/campaign_1.js';
  wp_enqueue_script('campaign_1', $filepath, false);

  get_header(); 
?>

<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-56N7R73" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>

<?php
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