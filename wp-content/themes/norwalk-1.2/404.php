<?php
/**
 * The template for displaying 404 pages.
 *
 * @package WordPress
 * @subpackage Starkers
 * @since Starkers HTML5 3.0
 */

get_header(); ?>
<div id="main-content">

	<div class="content">
        <div class="post">
        	
            <h1 id="search-head"><?php _e( 'Oops! 404, page not found! ', 'norwalk' ); ?></h1>
            <div class="the-content">
                    <p><?php _e( 'Something went wrong.', 'norwalk' ); ?></p>
                    <p><?php _e( 'We don\'t know why, but the page you requested could not be found.', 'norwalk' ); ?></p>
                    <p><?php _e( 'Make sure the URL you entered was correct. If you clicked a link from another site, it was probably set up wrong. If was one of ours, let us know.', 'norwalk' ); ?></p>
                    <p><?php _e( 'Either way, you can try searching below for what you were looking for.', 'norwalk' ); ?></p>
                    <?php get_search_form(); ?>
            
                <script type="text/javascript">
                    // focus on search field after it has loaded
                    document.getElementById('s') && document.getElementById('s').focus();
                </script>
	        </div>
        </div>
	</div>
    <aside class="sidebar">
		<?php get_sidebar('search'); ?>
    </aside>
<div class="clear-floats"></div>
</div>
<?php get_footer(); ?>