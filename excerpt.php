<?php
/**
 * The default template for displaying excerpt
 *
 * @package Bootstrap Canvas WP
 * @since Bootstrap Canvas WP 1.0
 */
?>
<div class="entry clearfix">
	<?php the_excerpt(); ?>
	<div class="continue-reading"><a href="<?php the_permalink(); ?>">Continue Reading</a></div>
	<span class="comment-home"> <?php comments_popup_link( __( 'No Comments', 'bootstrapcanvaswp' ), __( '1 Comment', 'bootstrapcanvaswp' ), __( '% Comments', 'bootstrapcanvaswp' ) ); ?></span>
</div>
		