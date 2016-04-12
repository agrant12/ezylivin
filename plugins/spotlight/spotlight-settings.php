<?php

/*
Plugin Name: Spotlight Carousel
Version: 1.0
Plugin URI: http://alvingrant.com
Description: Set carousel
Author: Alvin Grant
Author URI: http://alvingrant.com
*/

class SpotlightCarousel {
	
	const Slides = 4;

	function posts() {
		$args = array(
			'post_type' => 'post'
		);

		$post_data = new WP_Query($args);
		$posts = $post_data->posts;
		wp_reset_postdata();

		return $posts;
	}

	function add_admin_page() {
		add_menu_page('Spotlight Carousel', 'Spotlight Carousel', 'manage_options', 'spotlight-carousel', array($this, 'display_page'));
	}

	function display_page() {
	?>
		<div class="wrap">
			<div id="icon-options-general" class="icon32"><br></div>
			<h2>Spotlight Carousel</h2>

			<form action="options.php" method="post">
				<?php settings_fields('spotlight_carousel'); ?>
				<?php do_settings_sections('spotlight-carousel'); ?>

				<p><input name="Submit" type="submit" value="Save Changes" /></p>
			</form>
		</div>
	<?php
	}

	function admin_init() {
		register_setting('spotlight_carousel', 'spotlight_carousel');

		// LFM section
		add_settings_section('spotlight_slide', 'Carousel Slides', array($this, 'section_spotlight_carousel'), 'spotlight-carousel');

		for ($i = 1; $i <= self::Slides; $i++) { 
			add_settings_field('slide' + $i, 'Slide ' . $i, array($this, 'slide' . $i), 'spotlight-carousel', 'spotlight_slide');
		}

	}

	private function set_defaults($name = '') {
		$defaults = array();

		// if no $name, then this call is to reset all defaults
		if ( ! $name) {
		update_option('spotlight_carousel', $defaults);
			return;
		}


		$options = get_option('spotlight_carousel');

		// if no $options, then no settings have been set; set defaults
		if ( ! $options) {
			self::set_defaults();
		}

		// if item exists in options, return it (though, if this function is being called, then this check should have already been done)
		if (array_key_exists($name, $options)) {
			return $options[$name];
		}

		// if no default exists for $name, return null
		if ( ! array_key_exists($name, $defaults)) {
			return;
		}

		// add new default value and return it
		$options[$name] = $defaults[$name];
		update_option('spotlight_settings', $options);

		return $defaults[$name];
	}


	function section_spotlight_carousel() {}

	function slide1() {
			$posts = $this->posts();
		?>
			<select name="spotlight_carousel[slide1]" value="<?php echo esc_attr(self::get_setting('slide1')); ?>">
				<option value="">-------</option>
				<?php if(!empty($posts)): ?>
					<optgroup label="Posts">
						<?php foreach ($posts as $key => $post): ?>
								<option value="<?php echo esc_attr($post->ID); ?>" <?php echo selected(self::get_setting('slide1'), $post->ID); ?>><?php echo esc_html($post->post_title); ?></option>
						<?php endforeach; ?>
					</optgroup>
				<?php endif; ?>
			</select>
		<?php
	}

	function slide2() {
			$posts = $this->posts();
		?>
			<select name="spotlight_carousel[slide2]" value="<?php echo esc_attr(self::get_setting('slide2')); ?>">
				<option value="">-------</option>
				<?php if(!empty($posts)): ?>
					<optgroup label="Posts">
						<?php foreach ($posts as $key => $post): ?>
								<option value="<?php echo esc_attr($post->ID); ?>" <?php echo selected(self::get_setting('slide2'), $post->ID); ?>><?php echo esc_html($post->post_title); ?></option>
						<?php endforeach; ?>
					</optgroup>
				<?php endif; ?>
			</select>
		<?php
	}

	function slide3() {
			$posts = $this->posts();
		?>
			<select name="spotlight_carousel[slide3]" value="<?php echo esc_attr(self::get_setting('slide3')); ?>">
				<option value="">-------</option>
				<?php if(!empty($posts)): ?>
					<optgroup label="Posts">
						<?php foreach ($posts as $key => $post): ?>
								<option value="<?php echo esc_attr($post->ID); ?>" <?php echo selected(self::get_setting('slide3'), $post->ID); ?>><?php echo esc_html($post->post_title); ?></option>
						<?php endforeach; ?>
					</optgroup>
				<?php endif; ?>
			</select>
		<?php
	}

	function slide4() {
			$posts = $this->posts();
		?>
			<select name="spotlight_carousel[slide4]" value="<?php echo esc_attr(self::get_setting('slide4')); ?>">
				<option value="">-------</option>
				<?php if(!empty($posts)): ?>
					<optgroup label="Posts">
						<?php foreach ($posts as $key => $post): ?>
								<option value="<?php echo esc_attr($post->ID); ?>" <?php echo selected(self::get_setting('slide4'), $post->ID); ?>><?php echo esc_html($post->post_title); ?></option>
						<?php endforeach; ?>
					</optgroup>
				<?php endif; ?>
			</select>
		<?php
	}  

	function get_setting($name = '') {
		if ( ! $name) {
			return;
		}

		$options = get_option('spotlight_carousel');

		if ( ! $options) {
			self::set_defaults();
		}

		if (array_key_exists($name, $options)) {
		    return $options[$name];
		}

		return self::set_defaults($name);
		}
	}

function spotlight_get_carousel_option($key) {
	return SpotlightCarousel::get_setting($key);
}

$spotlight_carousel = new SpotlightCarousel();
add_action('admin_init', array($spotlight_carousel, 'admin_init'));
add_action('admin_menu', array($spotlight_carousel, 'add_admin_page'));
