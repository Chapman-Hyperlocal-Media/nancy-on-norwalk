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
    wp_enqueue_style('norwalk-css', get_template_directory_uri() . '/stylesheets/layout.css', 'reset', null);

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

<?php */

if (is_single()) {?>
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appId=267909876722098";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
<?php }
/*?>

End facebook button code

<?php */?>

<?php echo norwalk_navigation(); ?>
