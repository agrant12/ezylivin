<?php

include_once 'social-media-settings.php';

function icon_script() {
	wp_enqueue_style( 'icon_style', get_template_directory_uri() . '/plugins/social-media/css/icons.css');
	wp_enqueue_style( 'custom_icon_style', get_template_directory_uri() . '/plugins/social-media/css/style.css');
}
add_action( 'wp_enqueue_scripts', 'icon_script' );

function social_media_widget($args=array()){
	$args = array_merge(array(
		'facebook_url' => esc_url(SocialSettings::get_setting('facebook_url')),
		'twitter_url' => esc_url(SocialSettings::get_setting('twitter_url')),
		'pinterest_url' => esc_url(SocialSettings::get_setting('pinterest_url')),
		'linkedin_url' => esc_url(SocialSettings::get_setting('linkedin_url')),
		'instagram_url' => esc_url(SocialSettings::get_setting('instagram_url')),
	), $args);

	$facebook_url = $args['facebook_url'];
	$twitter_url = $args['twitter_url'];
	$pinterest_url = $args['pinterest_url'];
	$linkedin_url = $args['linkedin_url'];
	$instagram_url = $args['instagram_url'];

if(!$facebook_url && !$twitter_url && !$pinterest_url && !$instagram_url) return false;
?>
<div class="social">
	<ul>
		<?php if(is_valid_url($facebook_url)): ?>
			<li>
				<a class="socicon-facebook" href="<?php echo esc_url($facebook_url); ?>" target="_blank"></a>
			</li>
		<?php endif; ?>
		<?php if(is_valid_url($twitter_url)): ?>
			<li>
				<a class="socicon-twitter" href="<?php echo esc_url($twitter_url); ?>" target="_blank"></a>
			</li>
		<?php endif; ?>
		<?php if(is_valid_url($instagram_url)): ?>
			<li>
				<a class="socicon-instagram" href="<?php echo esc_url($instagram_url); ?>" target="_blank"></a>
			</li>
		<?php endif; ?>
		<?php if(is_valid_url($pinterest_url)): ?>
			<li>
				<a class="socicon-pinterest" href="<?php echo esc_url($pinterest_url); ?>" target="_blank"></a>
			</li>
		<?php endif; ?>
		<?php if(is_valid_url($linkedin_url)): ?>
			<li>
				<a class="socicon-linkedin" href="<?php echo esc_url($linkedin_url); ?>" target="_blank"></a>
			</li>
		<?php endif; ?>
	</ul>
</div><?php
}