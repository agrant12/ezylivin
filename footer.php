<?php
/**
 * Template for displaying the footer
 *
 * Contains the closing of the id=main div and all content
 * after. Calls sidebar-footer.php for bottom widgets.
 *
 * @package Bootstrap Canvas WP
 * @since Bootstrap Canvas WP 1.0
 */
?>
	</div><!-- /.container -->
	<div class="container"><?php dynamic_sidebar( 'above-footer-widget' ); ?></div>
	<div class="blog-footer">
	
	  <?php get_sidebar( 'footer' ); ?>
	  
	  <?php 
	  $copyright_text = get_theme_mod( 'copyrighttext', '' ); ?>
	  <?php if ( $copyright_text !== '' ) : ?>
	  <p class="copyright"><?php echo $copyright_text; ?></p>
	  <?php else: ?>
	  <p class="copyright"><?php _e( 'Blog template built for <a href="' . esc_url( 'http://getbootstrap.com', 'bootstrapcanvaswp' ) . '">Bootstrap</a> by <a href="' . esc_url( 'https://twitter.com/mdo', 'bootstrapcanvaswp' ) . '">@mdo</a>' ); ?></p>
	  <?php endif; ?>
	  <?php social_media_widget(); ?>
	  <p>
		<a href="#"><?php _e( 'Back to top', 'bootstrapcanvaswp' ); ?></a>
	  </p>
	</div>
	<div class="subscribe-box">
		<div class="subscribe-box-content">
			<button class="close"><a href="#">Close x</a></button>
			<?php if ( ! dynamic_sidebar( 'lightbox-widget-area' ) ) : ?>
			<?php endif; ?>
		</div>
	</div>

	<?php 
	  /*
	   * Always have wp_footer() just before the closing </body>
	   * tag of your theme, or you will break many plugins, which
	   * generally use this hook to reference JavaScript files.
	   */
	  wp_footer(); 
	?>
  </body>
</html>