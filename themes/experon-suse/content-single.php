<?php
/**
 * The Single Post content template file.
 *
 * @package ThinkUpThemes
 */
?>

    <h2><?php thinkup_title_select() ?></h2>

		<?php thinkup_input_postmedia(); ?>
		<?php thinkup_input_postmeta(); ?>

		<div class="entry-content">
			<?php the_content(); ?>
		</div><!-- .entry-content -->

		<div class="clearboth"></div>