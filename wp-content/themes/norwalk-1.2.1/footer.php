<?php
/**
 * The template for displaying the footer.
 *
 * @package WordPress
 * @subpackage norwalk
 * @since Norwalk HTML5 1.0
 */
?>

	<footer id="mainfoot">
        <div id="site" class="about">
            <h4 class="title">About this site</h4>
            <p>NancyOnNorwwalk.com was conceived as the place to go for Norwalk residents to get the real, unvarnished story about what is going on in and around their city. NancyOnNorwalk does not intend to be a print newspaper online; rather, it exists to pull the curtain back and shine a spotlight on how Norwalk is run and what is happening regarding issues that have an impact on taxpayers’ pocketbooks and safety.  As an independent site, NancyOnNorwalk’s first and only allegiance is to the reader.</p>
        </div>
        <div id="nancy" class="about">
            <h4 class="title">About Nancy</h4>
            <p>Nancy came to Norwalk more than 2 years ago as the Norwalk reporter for the Norwalk Daily Voice and resigned in October to begin Nancy On Norwalk. She is married to a career journalist, has a son, Eric (<a href="http://www.ericchapman.net">the artist and web designer who built this website</a>) and two middle-aged cats who are still trying to work out a peaceful co-existence.</p>
        </div>

		<?php
        $footer_nav_args = array(
                    'theme_location'  => 'foot-nav',
                    'menu'            => 'footer-navigation', 
                    'container'       => 'nav', 
                    'container_class' => 'navigation', 
                    'container_id'    => 'foot-nav',
                    //'menu_class'      => '{menu slug}', 
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
        wp_nav_menu($footer_nav_args); ?>

        <div id="legal">
        <p>Copyright © 2013 Englewood Edge LLC. Reproduction of material from any Nancy on Norwalk pages without written permission is strictly prohibited. All rights reserved.</p>
<p>Englewood Edge LLC is a registered LLC in the state of Florida.</p>
        </div>
        <script type="text/javascript"> // google+ share button code
		  (function() {
			var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
			po.src = 'https://apis.google.com/js/platform.js';
			var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
		  })();
		</script>
	</footer>

<?php
	/* Always have wp_footer() just before the closing </body>
	 * tag of your theme, or you will break many plugins, which
	 * generally use this hook to reference JavaScript files.
	 */

	wp_footer();
?>
</div><?php /*?> closes #NoN-content div started in header.php <?php */?>
</div><?php /*?> closes #wallpaper-content div started in header.php <?php */?>
</body>
</html>