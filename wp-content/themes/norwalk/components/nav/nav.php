<?php
/**
 * Created by PhpStorm.
 * User: ericchapman
 * Date: 2/19/18
 * Time: 3:23 AM
 */

function norwalk_navigation() {
    $post_nav_links = '';
	if (is_single()) {
	    $prev_link = get_previous_post_link('<li id="main-nav-next" class="main-post-nav">%link</li>','<span title="%title">Previous post</span>');
	    $next_link = get_next_post_link('<li id="main-nav-prev" class="main-post-nav">%link</li>','<span title="%title">Next post</span>');
	    $post_nav_links = <<<HTML
<ul id="main-nextprev"  style="display:none;">
    $prev_link
    $next_link
</ul>
HTML;
    }

    $main_nav_args = array(
        'theme_location'  => 'main-nav',
        'menu'            => 'main-navigation',
        'container'       => 'nav',
        'container_class' => 'header-nav main-nav',
        'container_id'    => 'main-nav',
        //'menu_class'      => 'main-nav',
        //'menu_id'         => '',
        'echo'            => false,
        'fallback_cb'     => 'norwalk_default_nav',
        //'before'          => '',
        //'after'           => '',
        //'link_before'     => '',
        //'link_after'      => '',
        'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
        //'depth'           => 0,
        //'walker'          => ''
    );
    $nav_menu = wp_nav_menu($main_nav_args);
    $logo_img_src = get_template_directory_uri() . '/images/navMenu.png';
    $home_url = home_url('/');
    $home_title_attr = esc_attr(get_bloginfo('name', 'display'));

    return <<<HTML
<header id="mainhead">
    <h5 id="nav-label" style="display:none;">Navigation<img id="menu-icon" src="$logo_img_src" width="16px" height="16px"/></h5>
    <h6 id="nav-logo" style="display:none;"><a href="$home_url" title="$home_title_attr" rel="home">Nancy <span>On Norwalk</span></a></h6>
        $post_nav_links
        $nav_menu   
        <div id="logo">
            <h2><a href="$home_url" title="$home_title_attr" rel="home"><span>Nancy</span> On Norwalk</a></h2>
        </div>
</header>
HTML;
}
