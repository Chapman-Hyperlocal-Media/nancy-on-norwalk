<?php 

/** Register sidebars by running norwalk_widgets_init() on the widgets_init hook. */
add_action( 'widgets_init', 'norwalk_widgets_init' );

if ( ! function_exists( 'norwalk_widgets_init' ) ):
	function norwalk_widgets_init() {
		// Default, located in the default sidebar.
		register_sidebar( array(
			'name' => __( 'Main sidebar', 'norwalk' ),
			'id' => 'default-sidebar',
			'description' => __( 'Displays on home page and is used as the default for all pages', 'norwalk' ),
			'before_widget' => '<li class="widget">',
			'after_widget' => '</li>',
			'before_title' => '<h3 class="title">',
			'after_title' => '</h3>',
		) );
		register_sidebar( array(
			'name' => __( 'Full Story sidebar', 'norwalk' ),
			'id' => 'single-story-sidebar',
			'description' => __( 'Displays only on full-story pages.', 'norwalk' ),
			'before_widget' => '<li class="widget">',
			'after_widget' => '</li>',
			'before_title' => '<h3 class="title">',
			'after_title' => '</h3>',
		) );	
		register_sidebar( array(
			'name' => __( 'Category archive sidebar', 'norwalk' ),
			'id' => 'category-sidebar',
			'description' => __( 'Displays on category pages', 'norwalk' ),
			'before_widget' => '<li class="widget">',
			'after_widget' => '</li>',
			'before_title' => '<h3 class="title">',
			'after_title' => '</h3>',
		) );
		register_sidebar( array(
			'name' => __( 'Tag page sidebar', 'norwalk' ),
			'id' => 'tag-sidebar',
			'description' => __( 'Displays on tag pages', 'norwalk' ),
			'before_widget' => '<li class="widget">',
			'after_widget' => '</li>',
			'before_title' => '<h3 class="title">',
			'after_title' => '</h3>',
		) );
		register_sidebar( array(
			'name' => __( 'Chronological archive sidebar', 'norwalk' ),
			'id' => 'chrono-archive-sidebar',
			'description' => __( 'Displays on monthly, daily and annual archive pages', 'norwalk' ),
			'before_widget' => '<li class="widget">',
			'after_widget' => '</li>',
			'before_title' => '<h3 class="title">',
			'after_title' => '</h3>',
		) );
		register_sidebar( array(
			'name' => __( 'Media display sidebar', 'norwalk' ),
			'id' => 'attachment-sidebar',
			'description' => __( 'Displays on the single-display pages for attached media (photos, video, etc)', 'norwalk' ),
			'before_widget' => '<li class="widget">',
			'after_widget' => '</li>',
			'before_title' => '<h3 class="title">',
			'after_title' => '</h3>',
		) );
		register_sidebar( array(
			'name' => __( 'Search sidebar', 'norwalk' ),
			'id' => 'search-sidebar',
			'description' => __( 'Displays on search & 404 error pages', 'norwalk' ),
			'before_widget' => '<li class="widget">',
			'after_widget' => '</li>',
			'before_title' => '<h3 class="title">',
			'after_title' => '</h3>',
		) );
		register_sidebar( array(
			'name' => __( 'Top sidebar ad slot', 'norwalk' ),
			'id' => 'top-sidebar-ad',
			'description' => __( 'Displays at top of sidebar on almost every page', 'norwalk' ),
			'before_widget' => '<li class="widget ad top">',
			'after_widget' => '</li>',
			'before_title' => '<h3 class="title">',
			'after_title' => '</h3>',
		) );
		register_sidebar( array(
			'name' => __( 'Bottom sidebar ad slot', 'norwalk' ),
			'id' => 'bottom-sidebar-ad',
			'description' => __( 'Displays at bottom of sidebar on almost every page', 'norwalk' ),
			'before_widget' => '<li class="widget ad bottom">',
			'after_widget' => '</li>',
			'before_title' => '<h3 class="title">',
			'after_title' => '</h3>',
		) );
		register_sidebar( array(
			'name' => __( 'Advertise page', 'norwalk' ),
			'id' => 'advertise',
			'description' => __( 'Displays only on the \'advertise with us\' page', 'norwalk' ),
			'before_widget' => '<li class="widget ad">',
			'after_widget' => '</li>',
			'before_title' => '<h3 class="title">',
			'after_title' => '</h3>', 
		) );
		/*	register_sidebar( array(
			'name' => __( 'Mobile ads 1', 'norwalk' ),
			'id' => 'mobile-ads-1',
			'description' => __( 'Displays between posts on the homepage and category pages, and only on mobile devices', 'norwalk' ),
			'before_widget' => '<li class="widget ad">',
			'after_widget' => '</li>',
			'before_title' => '<h3 class="title">',
			'after_title' => '</h3>',
			) );
		register_sidebar( array(
			'name' => __( 'Mobile ads 2', 'norwalk' ),
			'id' => 'mobile-ads-2',
			'description' => __( 'Displays between posts on the homepage and category pages, and only on mobile devices', 'norwalk' ),
			'before_widget' => '<li class="widget ad">',
			'after_widget' => '</li>',
			'before_title' => '<h3 class="title">',
			'after_title' => '</h3>',
		) );
		register_sidebar( array(
			'name' => __( 'Mobile ads 3', 'norwalk' ),
			'id' => 'mobile-ads-3',
			'description' => __( 'Displays between posts on the homepage and category pages, and only on mobile devices', 'norwalk' ),
			'before_widget' => '<li class="widget ad">',
			'after_widget' => '</li>',
			'before_title' => '<h3 class="title">',
			'after_title' => '</h3>',
		) );
		register_sidebar( array(
			'name' => __( 'Mobile ads 4', 'norwalk' ),
			'id' => 'mobile-ads-4',
			'description' => __( 'Displays between posts on the homepage and category pages, and only on mobile devices', 'norwalk' ),
			'before_widget' => '<li class="widget ad">',
			'after_widget' => '</li>',
			'before_title' => '<h3 class="title">',
			'after_title' => '</h3>',
		) );*/
	}

endif;
