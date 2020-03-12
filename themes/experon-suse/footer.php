<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the id="main-core".
 *
 * @package ThinkUpThemes
 */
?>

		</div><!-- #main-core -->
		</div><!-- #main -->
		<?php /* Sidebar */ thinkup_sidebar_html(); ?>
	</div>
	</div><!-- #content -->

	<?php /* Full-width coments */ thinkup_input_allowcomments2(); ?>

	<footer>
  <?php /* Custom Footer Layout */ thinkup_input_footerlayout();
  echo	'<!-- #footer -->';  ?>		
	</footer><!-- footer -->

</div><!-- #body-core -->

<?php wp_footer(); ?>

</body>
</html>