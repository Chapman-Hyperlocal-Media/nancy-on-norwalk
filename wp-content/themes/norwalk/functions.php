<?php
/**
  * Norwalk functions and definitions
  *	@package WordPress
  * @subpackage Norwalk
  * @since Norwalk 1.0
  *
  */

$component_dirs = glob(get_template_directory() . '/components/*', GLOB_ONLYDIR);
foreach($component_dirs as $dir) {
    $component_files = glob($dir . '/*.php');
    foreach($component_files as $component) {
        require $component;
    }
}

/** Tell WordPress to run norwalk_setup() when the 'after_setup_theme' hook is run. */
add_action( 'after_setup_theme', 'norwalk_setup' );

if ( ! function_exists( 'norwalk_setup' ) ):
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * @since Norwalk 1.0
 */
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
/** Register sidebars by running norwalk_widgets_init() on the widgets_init hook. */
add_action( 'widgets_init', 'norwalk_widgets_init' );

function norwalk_sidebar_fallback(){?>
		
			<li class="widget">
				<!-- Nancy_on_Norwalk_top_sidebar_large_rectangle_ad -->
                <div id='div-gpt-ad-1357460250405-0'>
                <script type='text/javascript'>
                googletag.cmd.push(function() { googletag.display('div-gpt-ad-1357460250405-0'); });
                </script>
                </div>
			</li>

            <li class="widget">
            	<h3 class="title">Popular Stories</h3>
                <?php
				
				$args = array(
					'theme_location'  => '',
					'menu'            => 'popular-stories',
					'container'       => 'div',
					'container_class' => 'menu-popular-stories-container',
					'container_id'    => '',
					'menu_class'      => 'menu',
					'menu_id'         => 'menu-popular-stories',
					'echo'            => true,
					'fallback_cb'     => 'wp_page_menu',
					'before'          => '',
					'after'           => '',
					'link_before'     => '',
					'link_after'      => '',
					'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
					'depth'           => 0,
					'walker'          => ''
				);
				
				wp_nav_menu( $args );
				
				?>
<!--                <div class="menu-popular-stories-container">
                    <ul id="menu-popular-stories" class="menu">
                        <li id="menu-item-581" class="menu-item menu-item-type-post_type menu-item-object-post menu-item-581"><a href="http://192.168.1.20/norwalknancy/2012/11/norwalk-voters-celebrate-scary-romneys-loss/">Norwalk voters celebrate Obama’s defeat of ‘scary’ Romney</a></li>
                        <li id="menu-item-582" class="menu-item menu-item-type-post_type menu-item-object-post menu-item-582"><a href="http://192.168.1.20/norwalknancy/2012/11/norwalk-reporter-confesses-the-reasons-i-resigned-from-the-norwalk-daily-voice/">Reporter: Why I Resigned From The Norwalk Daily Voice</a></li>
                        <li id="menu-item-583" class="menu-item menu-item-type-post_type menu-item-object-post menu-item-583"><a href="http://192.168.1.20/norwalknancy/2012/11/man-injured-in-fall-under-norwalks-stroffolino-bridge/">Man Injured In Fall Under Norwalk’s Stroffolino Bridge</a></li>
                    </ul>
                </div>-->
            </li>

			<li class="widget">
                <!-- Nancy_on_Norwalk_bottom_sidebar_large_rectangle_ad -->
                <div id='div-gpt-ad-1357504601556-0' >
                <script type='text/javascript'>
                googletag.cmd.push(function() { googletag.display('div-gpt-ad-1357504601556-0'); });
                </script>
                </div>
			</li>
<?php }

if ( !function_exists('norwalk_exclude_categories')) {
    function norwalk_exclude_categories($cat_ids = array()) {
        $categories = get_terms(
            array('category', 'nav_menu'),
            array('exclude' => $cat_ids)
        );
        $category_ids = array();
        $paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;
        foreach ($categories as $category) {
            array_push($category_ids, $category->term_id);
        }
        $new_query = new WP_Query( array('category__in' => $category_ids, 'paged' => $paged) );
        // Wordpress will think this query is an Archive because we specified categories.
        $new_query->is_archive = false;
        return $new_query;
    }
}

if ( ! function_exists( 'norwalk_posted_on' ) ) :
/**
 * Prints HTML with information for the current post—date/time.
 *
 * @since Starkers HTML5 3.0
 */
function norwalk_posted_on($tag = 'span') {
	
	printf( __( '<' . $tag . ' class="date">%2$s</' . $tag . '>', 'norwalk' ),
		'meta-prep meta-prep-author',
		sprintf( '<a href="%1$s" title="%2$s" rel="bookmark"><time datetime="%3$s" pubdate><span class="time">%4$s</span> <span class="month">%5$s</span> <span class="day">%6$s</span> <span class="year">%7$s</span></time></a>',
			get_permalink(),
			esc_attr( get_the_time() ),
			get_the_date('Y-m-d'),
			get_the_time('g : i a T'),
			get_the_date('F'),
			get_the_date('j'),
			get_the_date('Y')
		)
	);
}
endif;

if( !function_exists('norwalk_meta') ):

		function norwalk_meta($class, $loc = 'side'){
			echo '<ul class="' . $class .'">';
				if ($loc == 'side' && count( get_the_category() )):
					   printf( __( '<li>%2$s</li>', 'norwalk' ), 'entry-utility-prep entry-utility-prep-cat-links', get_the_category_list() ); 
				endif;
				
			echo '<li class="byline"><span class="tagline">By </span>' . norwalk_display_byline() . '</li>';
				
				norwalk_posted_on('li');
						
				$tags_list = get_the_tag_list( '<ul><li>','</li><li>','</li></ul>');
				
				// if ( is_single() && $loc == 'side' && $tags_list ):
				// 	printf( __( '<li class="tags"><span class="tagline">Tags </span>%2$s</li>', 'norwalk' ), 'entry-utility-prep entry-utility-prep-tag-links', $tags_list );  
				// endif; 
				echo '<li class="comments">';
				comments_popup_link( __( 'Leave a comment', 'norwalk' ), __( '1 Comment', 'norwalk' ), __( '% Comments', 'norwalk' ) );
			echo '</li>';
            	edit_post_link( __( 'Edit', 'norwalk' ), '<li class="edit-link">', '</li>' );
			echo '</ul>';

		}

endif;

// Override standard caption output, for image flexibility. Works with wp_flexible_images plugin.
// 		add_filter( $tag, $function_to_add, $priority, $accepted_args );
add_filter('img_caption_shortcode', 'norwalk_flex_caption', 10, 3 );
function norwalk_flex_caption($wtf, $attr, $content){
	
	extract(shortcode_atts(array(
		'id'	=> '',
		'align'	=> 'alignnone',
		'width'	=> '',
		'caption' => ''
	), $attr));

	if ( 1 > (int) $width || empty($caption) )
		return '' . $content . '';

	if ( $id ) $id = 'id="' . esc_attr($id) . '" ';

	return '<div ' . $id . ' class="wp-caption ' . esc_attr($align) . '">'
	. do_shortcode( $content ) . '<div class="wp-caption-text"><p>' . $caption . '</p></div></div>';
}

if( !function_exists('norwalk_default_nav') ):
	function norwalk_default_nav($args){
		
	}
endif;

/*add_filter( 'wp_nav_menu_items', 'your_custom_menu_item', 10, 2 );
	function your_custom_menu_item ( $items, $args ) {
   // if (is_single() && $args->theme_location == 'primary') {
        $items .= '<li>Show whatever</li>';
  //  }
    return $items;
}*/

if ( ! function_exists( 'norwalk_comment' ) ) :
/**
 * Template for comments and pingbacks.
 *
 * @since Starkers HTML5 3.0
 */
function norwalk_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case '' :
	?>
	<article <?php comment_class(); ?> id="comment-<?php comment_ID() ?>">
    	<header class="meta">
			<p><?php //echo get_avatar( $comment, 40 ); ?>
            <span class="user">
  				<?php printf( __( '%s', 'norwalk' ), sprintf( '%s', get_comment_author_link() ) ); ?>
           </span><span class="time">
            <a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>">
                <?php
                    /* translators: 1: date, 2: time */
                    printf( __( '%1$s at %2$s', 'norwalk' ), get_comment_date(),  get_comment_time() ); ?></a><?php edit_comment_link( __( '(Edit)', 'norwalk' ), ' ' );
                ?></span></p>
        </header>
        <div class="text">
		<?php if ( $comment->comment_approved == '0' ) : ?>
			<?php _e( '<em>Your comment is awaiting moderation.</em>', 'norwalk' ); ?>
			<br />
		<?php endif; ?>

		<?php comment_text(); ?>
		</div><footer class="reply">
			<?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?></footer>
	<?php
			break;
		case 'pingback'  :
		case 'trackback' :
	?>
	<article <?php comment_class(); ?> id="comment-<?php comment_ID() ?>">
		<p><?php _e( 'Pingback:', 'norwalk' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __('(Edit)', 'norwalk'), ' ' ); ?></p>
	<?php
			break;
	endswitch;
}
endif;

/**
 * Adjusts the comment_form() input types for HTML5.
 *
 * @since Norwalk HTML5 1.0
 */
function norwalk_fields($fields) {
$commenter = wp_get_current_commenter();
$req = get_option( 'require_name_email' );
$aria_req = ( $req ? " aria-required='true'" : '' );
$fields =  array(
	'author' => '<p><label for="author"' . ( $req ? 'class="required"' : '' ) . '>' . __( 'Name' ) . '</label> <input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30"' . $aria_req . ' /><span class="required">*</span></p>',
	'email'  => '<p><label for="email"' . ( $req ? 'class="required"' : '' ) . '>' . __( 'Email' ) . '</label> <input id="email" name="email" type="email" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30"' . $aria_req . ' /><span class="required">*</span></p>',
	'url'    => '<p><label for="url">' . __( 'Website' ) . '</label>' .
	'<input id="url" name="url" type="url" value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" /></p>',
);
return $fields;
}
add_filter('comment_form_default_fields','norwalk_fields');

if(!function_exists('norwalk_archive_query')){
	function norwalk_archive_query( $query ) {
		if ( $query->is_archive() && $query->is_main_query() ) {
			$query->set( 'posts_per_page', 30 );
		}
	}
}
add_action( 'pre_get_posts', 'norwalk_archive_query' );

if (!function_exists('norwalk_get_date_range')){
	function norwalk_get_date_range($format = 'n/j/Y'){
		// loop through posts to get the date of the first and last posts, for archive pages
		$i = 0;
		if (have_posts()) :  while ( have_posts() ) : the_post();
			if ($i == 0) $first_date = get_the_date($format);
			$i++;
			$last_date = get_the_date($format); //will get over-written every time until the loop ends, leaving the final date;
			endwhile;
		endif;
		rewind_posts();
		if ($first_date && $last_date) $date_range = array($first_date, $last_date);
		if ($date_range) return $date_range;
	}
}

/*
 *		Custom bylines
 *		Added Norwalk 1.2.1
 *		Creates meta box for custom byline field, and pre-fills it with the name of the story-creator
 */

add_action('admin_menu', 'norwalk_create_custom_byline');
add_action('save_post', 'norwalk_save_byline');

if (!function_exists('norwalk_create_custom_byline')){
	function norwalk_create_custom_byline(){
		add_meta_box('norwalk-custom-byline', 'Custom Byline', 'norwalk_custom_byline_box', 'post', 'side');
	}
}

if (!function_exists('norwalk_custom_byline_box')){
	function norwalk_custom_byline_box(){
		global $post;
		$id = $post->ID; ?>
    	<p>	<label for="custom-byline">Use this name:</label>
        	<input type="text" value="<?php	echo esc_html( get_post_meta( $id, 'custom-byline', true )); ?>" name="custom-byline" id="custom-byline" size="25">
            <?php wp_nonce_field('custom-byline-field','verify-that-shit'); ?>
        </p>
    <?php
	}
}

if (!function_exists('norwalk_save_byline')){
	function norwalk_save_byline(){
		global $post;
        if (!is_object($post)) {
            return;
        }
        if ($post->type == 'page') {
            return;
        }
        if (empty($_POST['custom-byline'])) {
            return;
        }
		$id = $post->ID;
		
	/*	if ( !wp_verify_nonce( $_POST['verify-that-shit'], 'custom-byline-field' ) ) return $post_id;

		if ( !current_user_can( 'edit_post', $post_id ) ) return $post_id;*/
		
		$custom_byline = get_post_meta( $id, 'custom-byline', true );
		$new_byline = stripslashes( $_POST['custom-byline'] );
		
		if ( $new_byline && $custom_byline == ''){
			add_post_meta( $id, 'custom-byline', $new_byline, true );
		}
		elseif ( $new_byline != $custom_byline && $new_byline != '' ){
			update_post_meta( $id, 'custom-byline', $new_byline );
		}
		elseif ( $new_byline == '' && $custom_byline ){
			delete_post_meta( $id, 'custom-byline' );}
	}
}

function norwalk_display_byline($ouside_loop = false){
	global $post;
	$post_id = $post->ID;
	$custom_byline = get_post_meta( $post_id, 'custom-byline', true );?>
    <?php
	if( $custom_byline ) return $custom_byline;
	else if($ouside_loop){
		$author_info = get_userdata($post->post_author);
		$author_name = $author_info->first_name . ' ' . $author_info->last_name;
		return $author_name;
	} else return get_the_author();
	
}


/*
 *		Sharing buttons
 *		Added Norwalk 1.2.1
 *		Creates functions to add sharing buttons to template files.
 *
 */
if (!function_exists('norwalk_tweet_button')){
	function norwalk_tweet_button($echo = true, $target = false, $size = 'medium', $via = 'nancynorwalk', $count = 'horizontal'){
		if ($target) $url = ' data-url="' . $target . '"';
		else $url = ' data-url="' . get_permalink() . '"';
		$size = ' data-size="' . $size . '"';
		$via = ' data-via="' . $via . '"';
		$text = ' data-text="' . get_the_title() . '"';
		$count = ' data-count="' . $count . '"';
		
		$button = '<a href="https://twitter.com/share" class="twitter-share-button" data-lang="en"' . $url . $size . $via . $text . $count . '>Tweet</a>
		<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="https://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>';
		
		if ($echo) echo $button; 
		else return $button;
	}
}

if (!function_exists('norwalk_facebook_like')){
	function norwalk_facebook_like($echo = true, $target = false, $color = 'light', $ref = false, $layout = 'button_count', $share = 'false', $action = 'like'){
		if ($target) $href = ' data-href="' . $target . '"';
		else $href = ' data-href="' . get_permalink() . '"';
		$type = ' data-type="' . $layout . '"';
		$layout = ' data-layout="' . $layout . '"';
		$share = ' data-share="' . $share . '"';
		$action = ' data-action="' . $action . '"'; 
		$color = ' data-colorscheme="' . $color . '"'; 
		/*

		The $ref parameter was preventing the like button from loading on some pages.
		This was because the ref parameter can't be longer than 50 characters,
		and it was being auto-filled with the title of the story. 
		So, if the headline was more than 50 characters, 
		the like button	would not load. 

		This parameter is optional, and used for tracking in analytics. 
		Until we find a specific need for this kind of tracking, ref is disabled.

		Should we need to enable it, a better solution must be found for an autofill.

		if (!$ref) $ref = ' data-ref="FB+' . urlencode( get_the_title() ) . '"';
		*/
		$button = '<div class="fb-like"' . $href . $layout . $share . $action /*. $ref*/ . $color . ' data-send="true" data-show-faces="false" data-width="64"></div><div class="fb-share-button"' . $href . $type . '></div>';
		if ($echo) echo $button;
		else return $button;
	}
}
/*<div  data-share="true"></div>*/

if (!function_exists('norwalk_googleplus_button')){
	function norwalk_googleplus_button($echo = true, $target = false, $size = 'medium', $annotation = 'bubble', $width = NULL ){
		if ($target) $href = ' data-href="' . $target . '"';
		else $href = ' data-href="' . get_permalink() . '"';
		$size = ' data-size="' . $size . '"';
		if($annotation == 'inline' && $width != NULL){
			$width = ' data-width="' . $width . '"';
			$annotation = ' data-annotation="' . $annotation . '"' . $width . '"';
		}
		else $annotation = ' data-annotation="' . $annotation . '"';
		
		
		$button = '<div style="float:left;"><div class="g-plusone"' . $href . $size . $annotation . '></div></div>';
		if ($echo) echo $button;
		else return $button;
	}
}
if (!function_exists('trim_excerpt')){
	function trim_excerpt($limit) {
	  $excerpt = explode(' ', get_the_excerpt(), $limit);
      if (count($excerpt)>=$limit) {
        array_pop($excerpt);
        $excerpt = implode(" ",$excerpt).'...';
      } else {
        $excerpt = implode(" ",$excerpt);
      } 
      $excerpt = preg_replace('`\[[^\]]*\]`','',$excerpt);
      return $excerpt;
    }
}
if (!function_exists('norwalk_comment_admin_message')){
	function norwalk_comment_admin_message(){ ?>

	<div class="comment-admin-message">
		<p><date>Oct. 5th, 2014</date> &mdash; Changes made to comment posting:</p>
		<p><strong>Line breaks:</strong> Users no longer have to add a seperate line with a '.' character on it to get space between paragraphs. Instead, just use a double-carriage-return (hit enter/return twice) and the paragraphs will be spaced automatically.</p>
		<p>As always, report any issues to <a href="mailto:eric@nancyonnorwalk.com">Eric</a>, the website guy.</p>
	</div>

	<?php }
}

/**
 * Modified version of Wordpress's basic comment form. 
 * 
 * Modified to include an admin message, with function norwalk_comment_admin_message()
 *
 * Original documentation follows below:
 *
 * Output a complete commenting form for use within a template.
 *
 * Most strings and form fields may be controlled through the $args array passed
 * into the function, while you may also choose to use the comment_form_default_fields
 * filter to modify the array of default fields if you'd just like to add a new
 * one or remove a single field. All fields are also individually passed through
 * a filter of the form comment_form_field_$name where $name is the key used
 * in the array of fields.
 *
 * @since 3.0.0
 *
 * @param array       $args {
 *     Optional. Default arguments and form fields to override.
 *
 *     @type array $fields {
 *         Default comment fields, filterable by default via the 'comment_form_default_fields' hook.
 *
 *         @type string $author Comment author field HTML.
 *         @type string $email  Comment author email field HTML.
 *         @type string $url    Comment author URL field HTML.
 *     }
 *     @type string $comment_field        The comment textarea field HTML.
 *     @type string $must_log_in          HTML element for a 'must be logged in to comment' message.
 *     @type string $logged_in_as         HTML element for a 'logged in as <user>' message.
 *     @type string $comment_notes_before HTML element for a message displayed before the comment form.
 *                                        Default 'Your email address will not be published.'.
 *     @type string $comment_notes_after  HTML element for a message displayed after the comment form.
 *                                        Default 'You may use these HTML tags and attributes ...'.
 *     @type string $id_form              The comment form element id attribute. Default 'commentform'.
 *     @type string $id_submit            The comment submit element id attribute. Default 'submit'.
 *     @type string $name_submit          The comment submit element name attribute. Default 'submit'.
 *     @type string $title_reply          The translatable 'reply' button label. Default 'Leave a Reply'.
 *     @type string $title_reply_to       The translatable 'reply-to' button label. Default 'Leave a Reply to %s',
 *                                        where %s is the author of the comment being replied to.
 *     @type string $cancel_reply_link    The translatable 'cancel reply' button label. Default 'Cancel reply'.
 *     @type string $label_submit         The translatable 'submit' button label. Default 'Post a comment'.
 *     @type string $format               The comment form format. Default 'xhtml'. Accepts 'xhtml', 'html5'.
 * }
 * @param int|WP_Post $post_id Post ID or WP_Post object to generate the form for. Default current post.
 */
function norwalk_comment_form( $args = array(), $post_id = null ) {
	if ( null === $post_id )
		$post_id = get_the_ID();

	$commenter = wp_get_current_commenter();
	$user = wp_get_current_user();
	$user_identity = $user->exists() ? $user->display_name : '';

	$args = wp_parse_args( $args );
	if ( ! isset( $args['format'] ) )
		$args['format'] = current_theme_supports( 'html5', 'comment-form' ) ? 'html5' : 'xhtml';

	$req      = get_option( 'require_name_email' );
	$aria_req = ( $req ? " aria-required='true'" : '' );
	$html5    = 'html5' === $args['format'];
	$fields   =  array(
		'author' => '<p class="comment-form-author">' . '<label for="author">' . __( 'Name' ) . ( $req ? ' <span class="required">*</span>' : '' ) . '</label> ' .
		            '<input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30"' . $aria_req . ' /></p>',
		'email'  => '<p class="comment-form-email"><label for="email">' . __( 'Email' ) . ( $req ? ' <span class="required">*</span>' : '' ) . '</label> ' .
		            '<input id="email" name="email" ' . ( $html5 ? 'type="email"' : 'type="text"' ) . ' value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30"' . $aria_req . ' /></p>',
		'url'    => '<p class="comment-form-url"><label for="url">' . __( 'Website' ) . '</label> ' .
		            '<input id="url" name="url" ' . ( $html5 ? 'type="url"' : 'type="text"' ) . ' value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" /></p>',
	);

	$required_text = sprintf( ' ' . __('Required fields are marked %s'), '<span class="required">*</span>' );

	/**
	 * Filter the default comment form fields.
	 *
	 * @since 3.0.0
	 *
	 * @param array $fields The default comment fields.
	 */
	$fields = apply_filters( 'comment_form_default_fields', $fields );
	$defaults = array(
		'fields'               => $fields,
		'comment_field'        => '<p class="comment-form-comment"><label for="comment">' . _x( 'Comment', 'noun' ) . '</label> <textarea id="comment" name="comment" cols="45" rows="8" aria-required="true"></textarea></p>',
		/** This filter is documented in wp-includes/link-template.php */
		'must_log_in'          => '<p class="must-log-in">' . sprintf( __( 'You must be <a href="%s">logged in</a> to post a comment.' ), wp_login_url( apply_filters( 'the_permalink', get_permalink( $post_id ) ) ) ) . '</p>',
		/** This filter is documented in wp-includes/link-template.php */
		'logged_in_as'         => '<p class="logged-in-as">' . sprintf( __( 'Logged in as <a href="%1$s">%2$s</a>. <a href="%3$s" title="Log out of this account">Log out?</a>' ), get_edit_user_link(), $user_identity, wp_logout_url( apply_filters( 'the_permalink', get_permalink( $post_id ) ) ) ) . '</p>',
		'comment_notes_before' => '<p class="comment-notes">' . __( 'Your email address will not be published.' ) . ( $req ? $required_text : '' ) . '</p>',
		'comment_notes_after'  => '<p class="form-allowed-tags">' . sprintf( __( 'You may use these <abbr title="HyperText Markup Language">HTML</abbr> tags and attributes: %s' ), ' <code>' . allowed_tags() . '</code>' ) . '</p>',
		'id_form'              => 'commentform',
		'id_submit'            => 'submit',
		'name_submit'          => 'submit',
		'title_reply'          => __( 'Leave a Reply' ),
		'title_reply_to'       => __( 'Leave a Reply to %s' ),
		'cancel_reply_link'    => __( 'Cancel reply' ),
		'label_submit'         => __( 'Post Comment' ),
		'format'               => 'xhtml',
	);

	/**
	 * Filter the comment form default arguments.
	 *
	 * Use 'comment_form_default_fields' to filter the comment fields.
	 *
	 * @since 3.0.0
	 *
	 * @param array $defaults The default comment form arguments.
	 */
	$args = wp_parse_args( $args, apply_filters( 'comment_form_defaults', $defaults ) );

	?>
		<?php if ( comments_open( $post_id ) ) : ?>
			<?php
			/**
			 * Fires before the comment form.
			 *
			 * @since 3.0.0
			 */
			do_action( 'comment_form_before' );
			?>
			<div id="respond" class="comment-respond">
				<h3 id="reply-title" class="comment-reply-title"><?php comment_form_title( $args['title_reply'], $args['title_reply_to'] ); ?> <small><?php cancel_comment_reply_link( $args['cancel_reply_link'] ); ?></small></h3>
				<?php //norwalk_comment_admin_message(); ?>
				<?php if ( get_option( 'comment_registration' ) && !is_user_logged_in() ) : ?>
					<?php echo $args['must_log_in']; ?>
					<?php
					/**
					 * Fires after the HTML-formatted 'must log in after' message in the comment form.
					 *
					 * @since 3.0.0
					 */
					do_action( 'comment_form_must_log_in_after' );
					?>
				<?php else : ?>
					<form action="<?php echo site_url( '/wp-comments-post.php' ); ?>" method="post" id="<?php echo esc_attr( $args['id_form'] ); ?>" class="comment-form"<?php echo $html5 ? ' novalidate' : ''; ?>>
						<?php
						/**
						 * Fires at the top of the comment form, inside the <form> tag.
						 *
						 * @since 3.0.0
						 */
						do_action( 'comment_form_top' );
						?>
						<?php if ( is_user_logged_in() ) : ?>
							<?php
							/**
							 * Filter the 'logged in' message for the comment form for display.
							 *
							 * @since 3.0.0
							 *
							 * @param string $args_logged_in The logged-in-as HTML-formatted message.
							 * @param array  $commenter      An array containing the comment author's
							 *                               username, email, and URL.
							 * @param string $user_identity  If the commenter is a registered user,
							 *                               the display name, blank otherwise.
							 */
							echo apply_filters( 'comment_form_logged_in', $args['logged_in_as'], $commenter, $user_identity );
							?>
							<?php
							/**
							 * Fires after the is_user_logged_in() check in the comment form.
							 *
							 * @since 3.0.0
							 *
							 * @param array  $commenter     An array containing the comment author's
							 *                              username, email, and URL.
							 * @param string $user_identity If the commenter is a registered user,
							 *                              the display name, blank otherwise.
							 */
							do_action( 'comment_form_logged_in_after', $commenter, $user_identity );
							?>
						<?php else : ?>
							<?php echo $args['comment_notes_before']; ?>
							<?php
							/**
							 * Fires before the comment fields in the comment form.
							 *
							 * @since 3.0.0
							 */
							do_action( 'comment_form_before_fields' );
							foreach ( (array) $args['fields'] as $name => $field ) {
								/**
								 * Filter a comment form field for display.
								 *
								 * The dynamic portion of the filter hook, $name, refers to the name
								 * of the comment form field. Such as 'author', 'email', or 'url'.
								 *
								 * @since 3.0.0
								 *
								 * @param string $field The HTML-formatted output of the comment form field.
								 */
								echo apply_filters( "comment_form_field_{$name}", $field ) . "\n";
							}
							/**
							 * Fires after the comment fields in the comment form.
							 *
							 * @since 3.0.0
							 */
							do_action( 'comment_form_after_fields' );
							?>
						<?php endif; ?>
						<?php
						/**
						 * Filter the content of the comment textarea field for display.
						 *
						 * @since 3.0.0
						 *
						 * @param string $args_comment_field The content of the comment textarea field.
						 */
						echo apply_filters( 'comment_form_field_comment', $args['comment_field'] );
						?>
						<?php echo $args['comment_notes_after']; ?>
						<p class="form-submit">
							<input name="<?php echo esc_attr( $args['name_submit'] ); ?>" type="submit" id="<?php echo esc_attr( $args['id_submit'] ); ?>" value="<?php echo esc_attr( $args['label_submit'] ); ?>" />
							<?php comment_id_fields( $post_id ); ?>
						</p>
						<?php
						/**
						 * Fires at the bottom of the comment form, inside the closing </form> tag.
						 *
						 * @since 1.5.0
						 *
						 * @param int $post_id The post ID.
						 */
						do_action( 'comment_form', $post_id );
						?>
					</form>
				<?php endif; ?>
			</div><!-- #respond -->
			<?php
			/**
			 * Fires after the comment form.
			 *
			 * @since 3.0.0
			 */
			do_action( 'comment_form_after' );
		else :
			/**
			 * Fires after the comment form if comments are closed.
			 *
			 * @since 3.0.0
			 */
			do_action( 'comment_form_comments_closed' );
		endif;
}

/**
 * Tells Wordpress when to exclude categories from the main query of a page.
 * WILL AFFECT NAV MENUS
 */
if (!function_exists('norwalk_exclude_categories')) {
	function norwalk_exclude_categories($query){
		// Homepage only
		// if (is_home() && is_main_query()){
		// 	$categories = get_terms(array('category', 'nav_menu'), 
	 //        	array('exclude' => array(
	 //        		790 // State
	 //        	)
	 //        ));
	 //        $category_ids = array();
	 //        foreach ($categories as $category) {
	 //        	array_push($category_ids, $category->term_id);
	 //        }
	 //        $query->query_vars['category__in'] = array_merge($category_ids);
		// }
		// Every Page
		if (is_main_query()){
		}
	}
}
//add_action('pre_get_posts','norwalk_exclude_categories');

if (!function_exists('norwalk_sc_donation_thankyou')){
	function norwalk_sc_donation_thankyou($html, $charge_response){
		// This is copied from the original output so that we can just add in our own details
	    $html = '<div class="sc-payment-details-wrap">';
	          
	    $html .= '<p>' . __( 'Your donation to Nancy On Norwalk was successful!', 'sc' ) . '</p>';
	    $html .= '<p>' . __( 'Here is your transaction info:', 'sc' ) . '</p>';
	          
	    // if( ! empty( $charge_response->description ) ) {
	    //     $html .= '<p>' . __( "Here's what you bought:", 'sc' ) . '</p>';
	    //     $html .= $charge_response->description . '<br>' . "\n";
	    // }
	          
	    // if ( isset( $_GET['store_name'] ) && ! empty( $_GET['store_name'] ) ) {
	    //     $html .= 'From: ' . esc_html( $_GET['store_name'] ) . '<br/>' . "\n";
	    // }
	      
	    $html .= '<p><strong>' . __( 'Amount charged today: ', 'sc' ) . sc_stripe_to_formatted_amount( $charge_response->amount, $charge_response->currency ) . ' ' . 
	            strtoupper( $charge_response->currency ) . '</strong></p>' . "\n";
	      
	    $html .= '<p>Your transaction ID is: ' . $charge_response->id . '</p>';
	   
	    //Our own new details
	    // Let's add the last four of the card they used and the expiration date
	    $html .= '<p>Card: ****-****-****-' . $charge_response->source->last4 . '<br>';
	    $html .= 'Expiration: ' . $charge_response->source->exp_month . '/' . $charge_response->source->exp_year . '</p>';
	      
	    // We can show the Address provided - this requires shipping="true" in our shortcode
	    if( ! empty( $charge_response->source->address_line1 ) ) {
	        $html .= '<p>Address Line 1: ' . $charge_response->source->address_line1 . '</p>';
	    }
	      
	    if( ! empty( $charge_response->source->address_line2 ) ) {
	        $html .= '<p>Address Line 2: ' . $charge_response->source->address_line2 . '</p>';
	    }
	      
	    if( ! empty( $charge_response->source->address_city ) ) {
	        $html .= '<p>Address City: ' . $charge_response->source->address_city . '</p>';
	    }
	      
	    if( ! empty( $charge_response->source->address_state ) ) {
	        $html .= '<p>Address State: ' . $charge_response->source->address_state . '</p>';
	    }
	      
	    if( ! empty( $charge_response->source->address_zip ) ) {
	        $html .= '<p>Address Zip: ' . $charge_response->source->address_zip . '</p>';
	    }
	      
	    // Finally we can add the output of a custom field
	    // For our example shortcode: <div class="sc-form-group"><label for=""phone_number"">"Phone</label><input type="text" value="" class="sc-form-control sc-cf-text" id=""phone_number"" name="sc_form_field["phone_number"]" placeholder=""></div>
	    if( ! empty( $charge_response->metadata->phone_number ) ) {
	        $html .= '<p>Phone Number: ' . $charge_response->metadata->phone_number . '</p>';
	    }
	      
	    $html .= '</div>';
	      
	    return $html;
	}
}
add_filter( 'sc_payment_details', 'norwalk_sc_donation_thankyou', 20, 2 );



/*if(!function_exists('norwalk_sc_redirect')){
	function norwalk_sc_redirect($redirect, $failure){
		function norwalk_sc_show_charge_result($redirect, $failure){
			// We do not redirect. We want this to show up on the page
			// the viewer was looking at when they made the payment.
			if ($failure){ ?>
				<script> console.log('Charge considered by Stripe to be potentially fraudulant') </script>;
			<?php 
			} else { ?>
				<script> console.log( 'Charge processed successfully') </script>;
			<?php
			}

		}
		add_action('wp_footer', 'norwalk_sc_show_charge_result', 20, 2);
		//error_log('$success = ' . $redirect . '     $failure = ' . $failure);
	}
}
add_filter( 'sc_redirect', 'norwalk_sc_redirect', 20, 2 );*/

// function debug_to_console($data) {
//     if(is_array($data) || is_object($data))
// 	{
// 		echo("<script>console.log('PHP: ".json_encode($data)."');</script>");
// 	} else {
// 		echo("<script>console.log('PHP: ".$data."');</script>");
// 	}
// }







/* 

 *********************************************************
 *********************************************************





				#####  ###### #####  #####  ######  ####    ##   ##### ###### #####  
				#    # #      #    # #    # #      #    #  #  #    #   #      #    # 
				#    # #####  #    # #    # #####  #      #    #   #   #####  #    # 
				#    # #      #####  #####  #      #      ######   #   #      #    # 
				#    # #      #      #   #  #      #    # #    #   #   #      #    # 
				#####  ###### #      #    # ######  ####  #    #   #   ###### #####




 *********************************************************
 *********************************************************

*/

/**
 * Starkers functions and definitions
 *
 * @package WordPress
 * @subpackage Starkers
 * @since Starkers HTML5 3.0
 */

/** Tell WordPress to run starkers_setup() when the 'after_setup_theme' hook is run. */
//add_action( 'after_setup_theme', 'starkers_setup' );

if ( ! function_exists( 'starkers_setup' ) ):
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * @since Starkers HTML5 3.0
 */
function starkers_setup() {

	// Post Format support. You can also use the legacy "gallery" or "asides" (note the plural) categories.
	add_theme_support( 'post-formats', array( 'aside', 'gallery' ) );

	// This theme uses post thumbnails
	add_theme_support( 'post-thumbnails' );

	// Add default posts and comments RSS feed links to head
	add_theme_support( 'automatic-feed-links' );

	// Make theme available for translation
	// Translations can be filed in the /languages/ directory
	load_theme_textdomain( 'starkers', TEMPLATEPATH . '/languages' );

	$locale = get_locale();
	$locale_file = TEMPLATEPATH . "/languages/$locale.php";
	if ( is_readable( $locale_file ) )
		require_once( $locale_file );

	// This theme uses wp_nav_menu() in one locations.
	register_nav_menus( array(
		'primary' => __( 'Primary Navigation', 'norwalk' ),
	) );
}
endif;

if ( ! function_exists( 'starkers_menu' ) ):
/**
 * Set our wp_nav_menu() fallback, starkers_menu().
 *
 * @since Starkers HTML5 3.0
 */
function starkers_menu() {
	echo '<nav><ul><li><a href="'.get_bloginfo('url').'">Home</a></li>';
	wp_list_pages('title_li=');
	echo '</ul></nav>';
}
endif;

/**
 * Remove inline styles printed when the gallery shortcode is used.
 *
 * @since Starkers HTML5 3.2
 */
add_filter( 'use_default_gallery_style', '__return_false' );

/**
 * @since Starkers HTML5 3.0
 * @deprecated in Starkers HTML5 3.2 for WordPress 3.1
 *
 * @return string The gallery style filter, with the styles themselves removed.
 */
function starkers_remove_gallery_css( $css ) {
	return preg_replace( "#<style type='text/css'>(.*?)</style>#s", '', $css );
}
// Backwards compatibility with WordPress 3.0.
if ( version_compare( $GLOBALS['wp_version'], '3.1', '<' ) )
	add_filter( 'gallery_style', 'starkers_remove_gallery_css' );

if ( ! function_exists( 'starkers_comment' ) ) :
/**
 * Template for comments and pingbacks.
 *
 * @since Starkers HTML5 3.0
 */
function starkers_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case '' :
	?>
	<article <?php comment_class(); ?> id="comment-<?php comment_ID() ?>">
			<?php echo get_avatar( $comment, 40 ); ?>
			<?php printf( __( '%s says:', 'starkers' ), sprintf( '%s', get_comment_author_link() ) ); ?>
		<?php if ( $comment->comment_approved == '0' ) : ?>
			<?php _e( 'Your comment is awaiting moderation.', 'starkers' ); ?>
			<br />
		<?php endif; ?>

		<a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>">
			<?php
				/* translators: 1: date, 2: time */
				printf( __( '%1$s at %2$s', 'starkers' ), get_comment_date(),  get_comment_time() ); ?></a><?php edit_comment_link( __( '(Edit)', 'starkers' ), ' ' );
			?>

		<?php comment_text(); ?>

			<?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>

	<?php
			break;
		case 'pingback'  :
		case 'trackback' :
	?>
	<article <?php comment_class(); ?> id="comment-<?php comment_ID() ?>">
		<p><?php _e( 'Pingback:', 'starkers' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __('(Edit)', 'starkers'), ' ' ); ?></p>
	<?php
			break;
	endswitch;
}
endif;

/**
 * Closes comments and pingbacks with </article> instead of </li>.
 *
 * @since Starkers HTML5 3.0
 */
function starkers_comment_close() {
	echo '</article>';
}

/**
 * Adjusts the comment_form() input types for HTML5.
 *
 * @since Starkers HTML5 3.0
 */
/*function starkers_fields($fields) {
$commenter = wp_get_current_commenter();
$req = get_option( 'require_name_email' );
$aria_req = ( $req ? " aria-required='true'" : '' );
$fields =  array(
	'author' => '<p><label for="author">' . __( 'Name' ) . '</label> ' . ( $req ? '*' : '' ) .
	'<input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30"' . $aria_req . ' /></p>',
	'email'  => '<p><label for="email">' . __( 'Email' ) . '</label> ' . ( $req ? '*' : '' ) .
	'<input id="email" name="email" type="email" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30"' . $aria_req . ' /></p>',
	'url'    => '<p><label for="url">' . __( 'Website' ) . '</label>' .
	'<input id="url" name="url" type="url" value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" /></p>',
);
return $fields;
}
add_filter('comment_form_default_fields','starkers_fields');*/

/**
 * Register widgetized areas.
 *
 * @since Starkers HTML5 3.0
 */
function starkers_widgets_init() {
	// Area 1, located at the top of the sidebar.
	register_sidebar( array(
		'name' => __( 'Primary Widget Area', 'starkers' ),
		'id' => 'primary-widget-area',
		'description' => __( 'The primary widget area', 'starkers' ),
		'before_widget' => '<li>',
		'after_widget' => '</li>',
		'before_title' => '<h3>',
		'after_title' => '</h3>',
	) );

	// Area 2, located below the Primary Widget Area in the sidebar. Empty by default.
	register_sidebar( array(
		'name' => __( 'Secondary Widget Area', 'starkers' ),
		'id' => 'secondary-widget-area',
		'description' => __( 'The secondary widget area', 'starkers' ),
		'before_widget' => '<li>',
		'after_widget' => '</li>',
		'before_title' => '<h3>',
		'after_title' => '</h3>',
	) );

	// Area 3, located in the footer. Empty by default.
	register_sidebar( array(
		'name' => __( 'First Footer Widget Area', 'starkers' ),
		'id' => 'first-footer-widget-area',
		'description' => __( 'The first footer widget area', 'starkers' ),
		'before_widget' => '<li>',
		'after_widget' => '</li>',
		'before_title' => '<h3>',
		'after_title' => '</h3>',
	) );

	// Area 4, located in the footer. Empty by default.
	register_sidebar( array(
		'name' => __( 'Second Footer Widget Area', 'starkers' ),
		'id' => 'second-footer-widget-area',
		'description' => __( 'The second footer widget area', 'starkers' ),
		'before_widget' => '<li>',
		'after_widget' => '</li>',
		'before_title' => '<h3>',
		'after_title' => '</h3>',
	) );

	// Area 5, located in the footer. Empty by default.
	register_sidebar( array(
		'name' => __( 'Third Footer Widget Area', 'starkers' ),
		'id' => 'third-footer-widget-area',
		'description' => __( 'The third footer widget area', 'starkers' ),
		'before_widget' => '<li>',
		'after_widget' => '</li>',
		'before_title' => '<h3>',
		'after_title' => '</h3>',
	) );

	// Area 6, located in the footer. Empty by default.
	register_sidebar( array(
		'name' => __( 'Fourth Footer Widget Area', 'starkers' ),
		'id' => 'fourth-footer-widget-area',
		'description' => __( 'The fourth footer widget area', 'starkers' ),
		'before_widget' => '<li>',
		'after_widget' => '</li>',
		'before_title' => '<h3>',
		'after_title' => '</h3>',
	) );
}
/** Register sidebars by running starkers_widgets_init() on the widgets_init hook. */
//add_action( 'widgets_init', 'starkers_widgets_init' );

/**
 * Removes the default styles that are packaged with the Recent Comments widget.
 *
 * @updated Starkers HTML5 3.2
 */
function starkers_remove_recent_comments_style() {
	add_filter( 'show_recent_comments_widget_style', '__return_false' );
}
add_action( 'widgets_init', 'starkers_remove_recent_comments_style' );

if ( ! function_exists( 'starkers_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post—date/time and author.
 *
 * @since Starkers HTML5 3.0
 */
function starkers_posted_on() {
	printf( __( 'Posted on %2$s by %3$s', 'starkers' ),
		'meta-prep meta-prep-author',
		sprintf( '<a href="%1$s" title="%2$s" rel="bookmark"><time datetime="%3$s" pubdate>%4$s</time></a>',
			get_permalink(),
			esc_attr( get_the_time() ),
			get_the_date('Y-m-d'),
			get_the_date()
		),
		sprintf( '<a href="%1$s" title="%2$s">%3$s</a>',
			get_author_posts_url( get_the_author_meta( 'ID' ) ),
			sprintf( esc_attr__( 'View all posts by %s', 'starkers' ), get_the_author() ),
			get_the_author()
		)
	);
}
endif;

if ( ! function_exists( 'starkers_posted_in' ) ) :
/**
 * Prints HTML with meta information for the current post (category, tags and permalink).
 *
 * @since Starkers HTML5 3.0
 */
function starkers_posted_in() {
	// Retrieves tag list of current post, separated by commas.
	$tag_list = get_the_tag_list( '', ', ' );
	if ( $tag_list ) {
		$posted_in = __( 'This entry was posted in %1$s and tagged %2$s. Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'starkers' );
	} elseif ( is_object_in_taxonomy( get_post_type(), 'category' ) ) {
		$posted_in = __( 'This entry was posted in %1$s. Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'starkers' );
	} else {
		$posted_in = __( 'Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'starkers' );
	}
	// Prints the string, replacing the placeholders.
	printf(
		$posted_in,
		get_the_category_list( ', ' ),
		$tag_list,
		get_permalink(),
		the_title_attribute( 'echo=0' )
	);
}
endif;