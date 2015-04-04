<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section
 *
 * @package WordPress
 * @subpackage Starkers
 * @since Starkers HTML5 3.0
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?> <?php /*?>class="wallpaper-ad"<?php */?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="user-scalable=no, width=device-width, minimum-scale=1, maximum-scale=1">
<?php include 'meta-social.php'; ?>
<title><?php
 
    global $page, $paged;
 
    wp_title( '|', true, 'right' );
 
    bloginfo( 'name' );
 
    $site_description = get_bloginfo( 'description', 'display' );
    if ( $site_description && ( is_home() || is_front_page() ) )
        echo " | $site_description";
 
    if ( $paged >= 2 || $page >= 2 )
        echo ' | ' . sprintf( __( 'Page %s', 'starkers' ), max( $paged, $page ) );
 
    ?></title>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<!--[if lte IE 8]>
<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'template_url' ); ?>/stylesheets/ie.css" />
<script type="text/javascript" src="<?php bloginfo( 'template_url' ); ?>/js/FlashCanvasPro/bin/flashcanvas.js"></script>
<![endif]-->

<?php

    //remember to clear cache on live server after modifying these!!

    wp_enqueue_script('jquery');
		wp_enqueue_script('norwalk-js', get_template_directory_uri() . '/js/min/norwalk.min.js', 'jquery');
		wp_enqueue_script('modernizr', get_template_directory_uri() . '/js/modernizr.custom.99437.js');
    wp_enqueue_script('norwalk-ads', get_template_directory_uri() . '/js/min/norwalk-ads.min.js', 'jquery');
    wp_enqueue_style('reset', get_template_directory_uri() . '/stylesheets/reset.css');
    wp_enqueue_style('norwalk-css', get_template_directory_uri() . '/stylesheets/layout.css', 'reset');
    
?>
 
<!-- Quantcast Tag -->
<noscript>
<div style="display:none;">
<img src="//pixel.quantserve.com/pixel/p-7GR1A7wZbYvVp.gif" border="0" height="1" width="1" alt="Quantcast"/>
</div>
</noscript>
<!-- End Quantcast tag -->
 
<?php

    /* We add some JavaScript to pages with the comment form
     * to support sites with threaded comments (when in use).
     */
    if ( is_singular() && get_option( 'thread_comments' ) )
        wp_enqueue_script( 'comment-reply' );
 
    /* Always have wp_head() just before the closing </head>
     * tag of your theme, or you will break many plugins, which
     * generally use this hook to add elements to <head> such
     * as styles, scripts, and meta tags.
     */
    wp_head();

?>
</head>
 
<body <?php body_class(); ?>>
<?php /*?>

Begin facebook button code

<?php */?>
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appId=267909876722098";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
<?php /*?>

End facebook button code

<?php */?>
<div id="wallpaper-content">
<div id="NoN-content"> 
    <header id="mainhead">
    <h5 id="nav-label" style="display:none;">Navigation<img id="menu-icon" src="<?php echo get_template_directory_uri()?>/images/navMenu.png" width="16px" height="16px"/>
    </h5>
    <h6 id="nav-logo" style="display:none;"><a href="<?php echo home_url( '/' );?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">Nancy <span>On Norwalk</span></a></h6>
    <?php 
	if(is_single()){
		echo '<ul id="main-nextprev"  style="display:none;">';
		$format = '<li id="main-nav-next" class="main-post-nav">%link</li>';
		$link = '<span title="%title">Previous post</span>';
		previous_post_link($format, $link);
		$link = '<span title="%title">Next post</span>';
		next_post_link($format, $link);

		echo '</ul>';
	}
			$main_nav_args = array(
						'theme_location'  => 'main-nav',
						'menu'            => 'main-navigation', 
						'container'       => 'nav', 
						'container_class' => 'header-nav main-nav', 
						'container_id'    => 'main-nav',
						//'menu_class'      => 'main-nav', 
						//'menu_id'         => '',
						'echo'            => true,
						'fallback_cb'     => 'norwalk_default_nav',
						//'before'          => '',
						//'after'           => '',
						//'link_before'     => '',
						//'link_after'      => '',
						'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
						//'depth'           => 0,
						//'walker'          => ''
					);
			wp_nav_menu($main_nav_args);
		?>

<?php /*?>        <nav id="main-nav"></nav>
<?php */?>       
        <div id="logo">
        	<hgroup>
        		<?php if (is_single()) echo "<h2>"; else echo "<h1>" ?><a href="<?php echo home_url( '/' ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><span>Nancy</span> On Norwalk</a>
                <?php if (is_single()) echo "</h2>"; else echo "</h1>" ?>
	        </hgroup>
        </div>


        <?php /* Our navigation menu.  If one isn't filled out, wp_nav_menu falls back to the 'starkers_menu' function which can be found in functions.php.  The menu assiged to the primary position is the one used.  If none is assigned, the menu with the lowest ID is used.  */ ?>
        <?php /*wp_nav_menu( array( 'container' => 'nav', 'fallback_cb' => 'starkers_menu', 'theme_location' => 'primary' ) );*/ ?>
</header>
