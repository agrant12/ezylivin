<?php 

/*
Plugin Name: Spotlight Carousel
Version: 1.0
Plugin URI: http://alvingrant.com
Description: Set spotlight carousel
Author: Alvin Grant
Author URI: http://alvingrant.com
*/

include_once 'spotlight-settings.php';

function flexslider_script() {
	wp_enqueue_script( 'flexslider', get_template_directory_uri() . '/plugins/spotlight/js/jquery.flexslider-min.js', array(), '1.0.0', true );
}
add_action( 'wp_enqueue_scripts', 'flexslider_script' );

function carousel() {

	$slides = array();

	$slide1 = SpotlightCarousel::get_setting('slide1');
	$slide2 = SpotlightCarousel::get_setting('slide2');
	$slide3 = SpotlightCarousel::get_setting('slide3');
	$slide4 = SpotlightCarousel::get_setting('slide4');

	if ($slide1 != '') {
		$slides[] = $slide1;
	}
	if ($slide2 != '') {
		$slides[] = $slide2;
	}
	if ($slide3 != '') {
		$slides[] = $slide3;
	}
	if ($slide4 != '') {
		$slides[] = $slide4;
	}
	?>

		<div class="flexslider">
			<ul class="slides">
				<?php foreach ($slides as $key => $slide): ?>
					<?php $post = get_post($slide); ?>
					<li>
						<div class="slide_content">
							<div class="slide_info">
								<p class="slide_title"><?php echo esc_html($post->post_title); ?></p>
								<div class="read-more"><a href="<?php echo the_permalink($slide); ?>">Read More</a></div>
							</div>
							<a href="<?php the_permalink($slide); ?>"><img src="<?php echo wp_get_attachment_url( get_the_post_thumbnail_id($slide)); ?>" /></a>
						</div>
					</li>
				<?php endforeach; ?>
			</ul>
		</div>
		<script type="text/javascript">
			jQuery(document).ready(function($){
				$('.flexslider').flexslider({
					animation: "fade",
					animationLoop: true,
					animationSpeed: 500,
					easing: 'swing',
					slideshowSpeed: 6000,
					pauseOnHover: true, 
					maxItems: 4
				});
			});
		</script>

	<?php 
	}
?>