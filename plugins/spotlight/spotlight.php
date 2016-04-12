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
	wp_enqueue_style( 'flexslider_style', get_template_directory_uri() . '/plugins/spotlight/css/flexslider.css');
	wp_enqueue_style( 'custom_flexslider_style', get_template_directory_uri() . '/plugins/spotlight/css/custom-flexslider.css');
	wp_enqueue_script( 'flexslider', get_template_directory_uri() . '/plugins/spotlight/js/jquery.flexslider-min.js', array('jquery'), '1.0.0', true );
}
add_action( 'wp_enqueue_scripts', 'flexslider_script' );

function carousel() {

	$slides = array();
	$spotlight = new SpotlightCarousel;

	$slide1 = $spotlight->get_setting('slide1');
	$slide2 = $spotlight->get_setting('slide2');
	$slide3 = $spotlight->get_setting('slide3');
	$slide4 = $spotlight->get_setting('slide4');

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
	<?php if (!empty($slides)): ?>
		<div class="flexslider">
			<ul class="slides">
				<?php foreach ($slides as $key => $slide): ?>
					<?php 
						$post = get_post($slide); 
						$image = wp_get_attachment_image_src( get_post_thumbnail_id( $slide ), 'full' );
					?>
					<li>
						<div class="slide_content">
							<div class="slide_info">
								<a class="title_slide" href="<?php the_permalink($slide); ?>"><p class="slide_title"><?php echo esc_html($post->post_title); ?></p></a>
								<div class="read-more"><a href="<?php echo the_permalink($slide); ?>">Read More</a></div>
							</div>
							<div class="overlay"><a href="<?php the_permalink($slide); ?>"></a></div>
							<a href="<?php the_permalink($slide); ?>"><img src="<?php echo esc_url($image[0]); ?>" /></a>
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
					animationSpeed: 300,
					easing: 'swing',
					slideshowSpeed: 6000,
					pauseOnHover: true, 
					maxItems: 4
				});
			});
		</script>
	<?php endif; ?>
	<?php 
	}
?>