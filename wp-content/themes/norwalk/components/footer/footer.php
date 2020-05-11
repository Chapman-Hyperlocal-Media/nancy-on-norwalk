<?php
/**
 * Created by PhpStorm.
 * User: ericchapman
 * Date: 2/19/18
 * Time: 2:49 AM
 */

function norwalk_footer() {
    $footer_nav_args = array(
        'theme_location'  => 'foot-nav',
        'menu'            => 'footer-navigation',
        'container'       => 'nav',
        'container_class' => 'navigation',
        'container_id'    => 'foot-nav',
        //'menu_class'      => '{menu slug}',
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
    $footer_nav_menu = wp_nav_menu($footer_nav_args);
    $date = date('Y');
    $popups = norwalk_polite_popup_loop();
	$about_site = render_site_text_as_basic_posts('about-the-site', false, 'ASC');
	$about_nancy = render_site_text_as_basic_posts('about-nancy', false, 'ASC');

    return <<<HTML
    $popups
<footer id="mainfoot">
    <div id="site" class="about">
    	$about_site        
    </div>
    <div id="nancy" class="about">
        $about_nancy
    </div>
    $footer_nav_menu
    <div id="legal">
        <p>Copyright © $date Chapman Hyperlocal Media Inc. Reproduction of material from any Nancy on Norwalk pages without written permission is strictly prohibited. All rights reserved.</p>
        <p>Chapman Hyperlocal Media Inc. is a registered non-profit corporation in the state of Connecticut.</p>
    </div>
    <script type="text/javascript"> // google+ share button code
        (function() {
            var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
            po.src = 'https://apis.google.com/js/platform.js';
            var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
        })();
    </script>
</footer>
HTML;
}
