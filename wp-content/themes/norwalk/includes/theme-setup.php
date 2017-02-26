<?php
	
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * @since Norwalk 1.0
	 */

	/** Tell WordPress to run norwalk_setup() when the 'after_setup_theme' hook is run. */
	add_action( 'after_setup_theme', 'norwalk_setup' );

	if ( ! function_exists( 'norwalk_setup' ) ):
	
	function norwalk_setup() {

		// Post Format support. You can also use the legacy "gallery" or "asides" (note the plural) categories.
		//add_theme_support( 'post-formats', array( 'aside', 'gallery' ) );

		// This theme uses post thumbnails
		add_theme_support( 'post-thumbnails' );

		// Add default posts and comments RSS feed links to head
		add_theme_support( 'automatic-feed-links' );

		// Make theme available for translation
		// Translations can be filed in the /languages/ directory
		load_theme_textdomain( 'norwalk', TEMPLATEPATH . '/languages' );

		$locale = get_locale();
		$locale_file = TEMPLATEPATH . "/languages/$locale.php";
		if ( is_readable( $locale_file ) )
			require_once( $locale_file );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'main-nav' => __( 'Main Navigation', 'norwalk' ),
		) );
		register_nav_menus( array(
			'foot-nav' => __('Footer Navigation', 'norwalk'),
		));
		
		add_image_size( 'story_thumb', 1000, 750, true ); 
		add_image_size( 'search_thumb', 250, 250, true);

		//allow short codes in widgets 
		add_filter('widget_text', 'do_shortcode');
	}
	endif;
