<?php
/**
 * The template for displaying call to sales pages
 *
 */

get_header(); ?>

<?php while ( have_posts() ) : the_post(); ?>

<div id="content">
  <h2><?php thinkup_title_select() ?></h2>
  <div id="content-core">
    <div id="main">
      <div id="main-core">

<?php 
  the_content();
  dynamic_sidebar('tts');
?>

      </div><!-- #main-core -->
    </div><!-- #main -->
  </div>
</div><!-- #content -->

<?php endwhile; ?>

<?php get_footer(); ?>