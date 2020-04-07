<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the id="main-core".
 *
 * @package ThinkUpThemes
 */
?>

  <footer>
    <?php /* Custom Footer Layout */ thinkup_input_footerlayout();
    echo	'<!-- #footer -->';  ?>		

    <div class="copy">
      <img class="logo" src="https://www.suse.com/assets/img/suse-white-logo-green.svg" alt="">
      <span class="rights">
      © <script type="text/javascript">var d = new Date(); document.write(d.getFullYear() + " ");</script> SUSE, All Rights Reserved
      </span>
    </div>
  </footer><!-- footer -->

</div><!-- #body-core -->

<?php wp_footer(); ?>

</body>
</html>