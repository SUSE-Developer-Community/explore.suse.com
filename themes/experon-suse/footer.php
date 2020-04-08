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

    <div class="navi">
      <div class="col-1">
        <img class="logo" src="https://www.suse.com/assets/img/suse-white-logo-green.svg" alt="">
      </div>
      <?php 
        wp_nav_menu(
          array(
            'menu' => 'legal_menu',
            'container_class' => 'col-2',
            'link_before' => '<span>',
            'link_after' => '</span>',
          )
        );
      ?>
      <div class="col-3 rights">
      © <script type="text/javascript">var d = new Date(); document.write(d.getFullYear() + " ");</script> <?php echo __( 'SUSE, All Rights Reserved', 'experon' ); ?>
      </div>
    </div>
  </footer><!-- footer -->

</div><!-- #body-core -->

<?php wp_footer(); ?>

</body>
</html>