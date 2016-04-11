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
	<div class="read-more"><a href="<?php echo the_permalink(); ?>">Read More</a></div>
</div>
		