<?php
	/*
	Plugin Name: Smart Accordion
	Plugin URI: https://pickelements.com/smart-accordion
	Description: Smart Accordion is an stylish and customizable tool to shape and display on your website a list of the most frequent customer questions with answers.
	Version: 1.6
	Author: Pickelements
	Author URI: https://pickelements.com
	TextDomain: smart-accordion
	License: GPLv2
	*/


	if ( ! defined( 'ABSPATH' ) )
	die( "Can't load this file directly" );

	define('SAF_VERSION_PLUGIN_PATH', WP_PLUGIN_URL . '/' . plugin_basename( dirname(__FILE__) ) . '/' );
	define('saf_version_wp_plugin_dir', plugin_dir_path( __FILE__ ) );
	add_filter('widget_text', 'do_shortcode');

	# Smart Accordion enqueue scripts
	function saf_ac_wordpress_post_script(){
		wp_enqueue_style('saf-accordion-font', plugins_url( '/public/css/font-awesome.css' , __FILE__ ) );
		wp_enqueue_style('saf-accordion-public-css', plugins_url( '/public/css/smart-accordion-public.css' , __FILE__ ) );
		wp_enqueue_script('jquery');
		wp_enqueue_script('saf-accordion-js', plugins_url('public/js/accordion.js', __FILE__), array('jquery'), '2.1.1', true);
		wp_enqueue_script('saf-accordion-public-js', plugins_url('public/js/smart-accordion-public.js', __FILE__), array('jquery'), '1.0.0', true);
	}
	add_action('wp_enqueue_scripts', 'saf_ac_wordpress_post_script');

	# Smart Accordion wordpress Load Translation
	function saf_ac_load_textdomain(){
		load_plugin_textdomain('smart-accordion', false, dirname( plugin_basename( __FILE__ ) ) .'/languages/' );
	}
	add_action('plugins_loaded', 'saf_ac_load_textdomain');

	# Smart Accordion Admin enqueue scripts
	function saf_ac_admin_enqueue_scripts(){
		wp_enqueue_style('saf-accordion-font-admin', plugins_url( '/admin/css/font-awesome.css' , __FILE__ ) );
		wp_enqueue_style('saf-ftw-iconpicker-css', plugins_url( '/admin/css/ftw-iconpicker.min.css' , __FILE__ ) );
		wp_enqueue_style('saf-accordion-admin-css', plugins_url( '/admin/css/smart-accordion-admin.css' , __FILE__ ) );
		wp_enqueue_script( 'jquery' );
		wp_enqueue_script( 'saf-ftw-iconpicker-admin-js', plugins_url( '/admin/js/ftw-iconpicker.min.js' , __FILE__ ) , array( 'jquery' ), '1.0.0', true  );
		wp_enqueue_script( 'saf-accordion-admin-js', plugins_url( '/admin/js/smart-accordion-admin.js' , __FILE__ ) , array( 'jquery' ), '1.0.0', true  );
		wp_enqueue_style('wp-color-picker');
		wp_enqueue_script( 'saf_accordion_color_picker', plugins_url('admin/js/color-picker.js', __FILE__ ), array( 'wp-color-picker' ), false, true );
	}
	add_action('admin_enqueue_scripts', 'saf_ac_admin_enqueue_scripts');

	# Post Type
	require_once( 'libs/post-types/smart-accordion-post-type.php' );

	# Metaboxes
	require_once( 'libs/meta-boxes/smart-accordion-post-metaboxes.php' );

	# Shortcode
	require_once( 'libs/shortcode/smart-accordion-shortcode.php' );