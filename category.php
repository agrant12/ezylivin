<?php
/**
 * Template for displaying Category Archive pages
 *
 * @package Bootstrap Canvas WP
 * @since Bootstrap Canvas WP 1.0
 */

get_header(); ?>

<div class="row">
	<h1 class="category-header"><?php printf( __( '%s', 'bootstrapcanvaswp' ), '<span>' . single_cat_title( '', false ) . '</span>' ); ?></h1>
	<div class="col-sm-8 blog-main">
		<!--<hr />-->
		<?php get_template_part( 'loop', 'category' ); ?>
	</div><!-- /.blog-main -->

	<?php get_sidebar(); ?>

</div><!-- /.row -->

<?php get_footer(); ?>