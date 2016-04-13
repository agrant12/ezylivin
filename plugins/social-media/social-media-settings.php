<?php

/*
Plugin Name: Social Media Settings
Version: 1.0
Plugin URI: http://alvingrant.com
Description: Social Media Settings
Author: Alvin Grant
Author URI: http://alvingrant.com
*/

class SocialSettings {

	function add_admin_page() {
		add_options_page('Social Settings', 'Social Settings', 'manage_options', 'social-settings', array($this, 'display_page'));
	}

	function display_page() {
		?>
		<div class="wrap">
			<div id="icon-options-general" class="icon32"><br></div>
			<h2>Social Settings</h2>

			<form action="options.php" method="post">
				<?php settings_fields('social_settings'); ?>
				<?php do_settings_sections('social-settings'); ?>

				<p><input name="Submit" type="submit" value="Save Changes" /></p>
			</form>
		</div>
		<?php
	}

	function admin_init() {
		register_setting('social_settings', 'social_settings');

		// LFM section
		add_settings_section('social_social', 'Social Settings', array($this, 'section_social_settings'), 'social-settings');

		add_settings_field('twitter_url', 'Twitter Url', array($this, 'twitter_url'), 'social-settings', 'social_social');
		add_settings_field('facebook_url', 'Facebook Url', array($this, 'facebook_url'), 'social-settings', 'social_social');
		add_settings_field('pinterest_url', 'Pinterest Url', array($this, 'pinterest_url'), 'social-settings', 'social_social');
		add_settings_field('instagram_url', 'Instagram Url', array($this, 'instagram_url'), 'social-settings', 'social_social');
		add_settings_field('linkedin_url', 'LinkedIn Url', array($this, 'linkedin_url'), 'social-settings', 'social_social');
	}

	private function set_defaults($name = '') {
		$defaults = array(
			'twitter_url' => 'http://twitter.com',
			'facebook_url' => 'http://facebook.com',
			'pinterest_url' => 'http://pinterest.com',
			'instagram_url' => 'http://instagram.com',
			'linkedin_url' => 'http://linkedin.com',
		);

		// if no $name, then this call is to reset all defaults
		if ( ! $name) {
			update_option('social_settings', $defaults);
			return;
		}

		$options = get_option('social_settings');

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
		update_option('social_settings', $options);

		return $defaults[$name];
	}
	

	function section_social_settings() {}


	function twitter_url() {
		echo '<input type="text" size="40" value="'.self::get_setting('twitter_url').'" id="twitter_url" name="social_settings[twitter_url]" />';
	}

	function facebook_url() {
		echo '<input type="text" size="40" value="'.self::get_setting('facebook_url').'" id="facebook_url" name="social_settings[facebook_url]" />';
	}

	function pinterest_url(){
		echo '<input type="text" size="40" value="'.self::get_setting('pinterest_url').'" id="pinterest_url" name="social_settings[pinterest_url]" />';
	}

	function instagram_url(){
		echo '<input type="text" size="40" value="'.self::get_setting('instagram_url').'" id="instagram_url" name="social_settings[instagram_url]" />';
	}

	function linkedin_url(){
		echo '<input type="text" size="40" value="'.self::get_setting('linkedin_url').'" id="linkedin_url" name="social_settings[linkedin_url]" />';
	}

	function get_setting($name = '') {
		if ( ! $name) {
			return;
		}

		$options = get_option('social_settings');

		if ( ! $options) {
			self::set_defaults();
		}

		if (array_key_exists($name, $options)) {
			return $options[$name];
		}

		return self::set_defaults($name);
	}
}

function social_get_option($key) {
	return SocialSettings::get_setting($key);
}

$social_settings = new SocialSettings();
add_action('admin_init', array($social_settings, 'admin_init'));
add_action('admin_menu', array($social_settings, 'add_admin_page'));