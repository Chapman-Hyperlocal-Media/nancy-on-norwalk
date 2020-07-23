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
<script type='text/javascript'>
var googletag = googletag || {};
googletag.cmd = googletag.cmd || [];
(function() {
var gads = document.createElement('script');
gads.async = true;
gads.type = 'text/javascript';
var useSSL = 'https:' == document.location.protocol;
gads.src = (useSSL ? 'https:' : 'http:') +
'//www.googletagservices.com/tag/js/gpt.js';
var node = document.getElementsByTagName('script')[0];
node.parentNode.insertBefore(gads, node);
})();
</script>

<!-- doug hardy ad code -->
<script type='text/javascript' src='http://partner.googleadservices.com/gampad/google_service.js'>

</script>

<script type='text/javascript'>

GS_googleAddAdSenseService("ca-pub-7723353377962344");

GS_googleEnableAllServices();

</script>

<script type='text/javascript'>

GA_googleAddSlot("ca-pub-7723353377962344", "nancyonnorwalk_300x250_1");

GA_googleAddSlot("ca-pub-7723353377962344", "nancyonnorwalk_300x250_2");

GA_googleAddSlot("ca-pub-7723353377962344", "nancyonnorwalk_300x250_3");

GA_googleAddSlot("ca-pub-7723353377962344", "nancyonnorwalk_300x250_4");

GA_googleAddSlot("ca-pub-7723353377962344", "nancyonnorwalk_300x250_5");

// disabled until I can make a spot for it in the layout.
//
//GA_googleAddSlot("ca-pub-7723353377962344", "nancyonnorwalk_728x90_leaderboard");

</script>

<script type='text/javascript'>

GA_googleFetchAds();

</script>

<script type='text/javascript'>
var googletag = googletag || {};
googletag.cmd = googletag.cmd || [];
(function() {
var gads = document.createElement('script');
gads.async = true;
gads.type = 'text/javascript';
var useSSL = 'https:' == document.location.protocol;
gads.src = (useSSL ? 'https:' : 'http:') +
'//www.googletagservices.com/tag/js/gpt.js';
var node = document.getElementsByTagName('script')[0];
node.parentNode.insertBefore(gads, node);
})();
</script>

<script type='text/javascript'>
googletag.cmd.push(function() {
googletag.defineSlot('/1732998/Nancy_on_Norwalk_top_sidebar_large_rectangle_ad', [300, 250], 'div-gpt-ad-1390517935355-2').addService(googletag.pubads());
googletag.defineSlot('/1732998/Nancy-On-Norwalk-upper-sidebar', [300, 250], 'div-gpt-ad-1390517935355-0').addService(googletag.pubads());
googletag.defineSlot('/1732998/NancyOnNorwalk-middle-sidebar', [300, 250], 'div-gpt-ad-1390517935355-4').addService(googletag.pubads());
googletag.defineSlot('/1732998/NancyOnNorwalk-lower-sidebar', [300, 250], 'div-gpt-ad-1390517935355-3').addService(googletag.pubads());
googletag.defineSlot('/1732998/Nancy_on_Norwalk_bottom_sidebar_large_rectangle_ad', [300, 250], 'div-gpt-ad-1390517935355-1').addService(googletag.pubads());
googletag.pubads().enableSingleRequest();
googletag.enableServices();
});
</script>



<?php 	wp_enqueue_script('jquery');
		wp_enqueue_script('norwalk-js', get_template_directory_uri() . '/js/min/norwalk.min.js');
		wp_enqueue_script('modernizr', get_template_directory_uri() . '/js/modernizr-1.6.js');
?>

<!-- Quantcast Tag -->
<script type="text/javascript">
var _qevents = _qevents || [];

(function() {
var elem = document.createElement('script');
elem.src = (document.location.protocol == "https:" ? "https://secure" : "http://edge") + ".quantserve.com/quant.js";
elem.async = true;
elem.type = "text/javascript";
var scpt = document.getElementsByTagName('script')[0];
scpt.parentNode.insertBefore(elem, scpt);
})();

_qevents.push({
qacct:"p-7GR1A7wZbYvVp"
});
</script>

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
<div id="wallpaper-content">
<div id="NoN-content">
    <header id="mainhead">
    <h5 id="nav-label" style="display:none;">Navigation<object id="menu-icon" type="image/svg+xml" data="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHhtbG5zOnhsaW5rPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5L3hsaW5rIiB2ZXJzaW9uPSIxLjEiIGlkPSJMYXllcl8xIiB4PSIwcHgiIHk9IjBweCIgdmlld0JveD0iMCAwIDQwIDMyIiBlbmFibGUtYmFja2dyb3VuZD0ibmV3IDAgMCA0MCAzMiIgeG1sOnNwYWNlPSJwcmVzZXJ2ZSI+PHN0eWxlPi5tZW51LWljb257ZmlsbDoJI0NDQ0NDQzt9PC9zdHlsZT48cmVjdCB4PSIxIiB5PSIyIiB3aWR0aD0iMzEiIGhlaWdodD0iNiIgY2xhc3M9Im1lbnUtaWNvbiIvPjxyZWN0IHg9IjEiIHk9IjI0IiB3aWR0aD0iMzEiIGhlaWdodD0iNiIgY2xhc3M9Im1lbnUtaWNvbiIvPjxyZWN0IHg9IjEiIHk9IjEzIiB3aWR0aD0iMzEiIGhlaWdodD0iNiIgY2xhc3M9Im1lbnUtaWNvbiIvPjwvc3ZnPg=="></object>
    </h5>
    <h6 id="nav-logo" style="display:none;"><a href="<?php echo home_url( '/' );?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">Nancy <span>On Norwalk</span></a></h6>
        <?php
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
<?php */?>        <?php if(is_singular()){?>
		<?php }?>
        <div id="logo">
        	<hgroup>
        		<?php if (is_single) echo "<h2>"; else echo "<h1>" ?><a href="<?php echo home_url( '/' ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><span>Nancy</span> On Norwalk</a>
                <?php if (is_single) echo "</h2>"; else echo "</h1>" ?>
	        </hgroup>
        </div>


        <?php /* Our navigation menu.  If one isn't filled out, wp_nav_menu falls back to the 'starkers_menu' function which can be found in functions.php.  The menu assiged to the primary position is the one used.  If none is assigned, the menu with the lowest ID is used.  */ ?>
        <?php /*wp_nav_menu( array( 'container' => 'nav', 'fallback_cb' => 'starkers_menu', 'theme_location' => 'primary' ) );*/ ?>
    </header>
