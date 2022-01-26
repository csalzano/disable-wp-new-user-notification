<?php
defined( 'ABSPATH' ) or exit;

/**
 * Plugin Name: Disable New User Notification
 * Plugin URI: https://github.com/csalzano/disable-wp-new-user-notification
 * Description: Disables the email sent to the administrator when a new user creates an account.
 * Author: Corey Salzano
 * Author URI: https://breakfastco.xyz
 * Version: 1.0.0
 * License: GPLv2
 */

add_filter( 'wp_new_user_notification_email_admin', 'breakfast_disable_wp_mail', 10, 3 );
function breakfast_disable_wp_mail( $wp_new_user_notification_email_admin, $user, $blogname )
{
	//Stop wp_mail() from working
	add_filter( 'pre_wp_mail', '__return_false' );

	//Return an unchanged value from this filter
	return $wp_new_user_notification_email_admin;
}

add_filter( 'wp_new_user_notification_email', 'breakfast_enable_wp_mail', 10, 3 );
function breakfast_enable_wp_mail( $wp_new_user_notification_email, $user, $blogname )
{
	//Have we disabled wp_mail()?
	if( has_filter( 'pre_wp_mail', '__return_false' ) )
	{
		//Yes, remove the filter that disables wp_mail()
		remove_filter( 'pre_wp_mail', '__return_false' );
	}

	//Return an unchanged value from this filter
	return $wp_new_user_notification_email;
}
