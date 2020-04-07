<?php
/**
 * The template for the About Us page
 *
 */

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