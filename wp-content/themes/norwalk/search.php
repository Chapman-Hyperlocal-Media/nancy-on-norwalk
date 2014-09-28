<?php
/**
 * The template for displaying Search Results pages.
 *
 * @package WordPress
 * @subpackage Starkers
 * @since Starkers HTML5 3.0
 */

get_header(); ?>
<div id="main-content">

	<div class="content">
		<?php if ( have_posts() ) : ?>
        		<hgroup>
                    <h1 id="search-head"><?php printf( __( 'Search Results for <span class="search-term">%s</span>', 'starkers' ), '' . get_search_query() . '' ); ?></h1>
                    <?php if ( $wp_query->max_num_pages > 1 ) : ?>
                    <h3>
                        <nav id="pagination">
							<?php 
							$num_pages = $wp_query->max_num_pages;
							$next_page_link = get_next_posts_link('Next Page&nbsp;&nbsp;>>');
							$prev_page_link = get_previous_posts_link('<<&nbsp;&nbsp;Previous Page');
							
							if($prev_page_link) echo $prev_page_link . '&nbsp;&nbsp;|&nbsp;&nbsp;';
							for ($i = 1; $i <= 4; $i++){
								if ($i != get_query_var('paged') )echo '<a href="' . get_site_url() . '/page/' . $i . '/?s=' . get_search_query() . '">' . $i . '</a>';
								else echo $i;
								if ($i != $wp_query->max_num_pages) echo '&nbsp;&nbsp;|&nbsp;&nbsp;';
							}
							
							if($next_page_link) echo '&nbsp;&nbsp;|&nbsp;&nbsp;' . $next_page_link;
							
							?>
                        </nav>
                    </h3>
                    <?php endif; ?>
                </hgroup>
                <div>
                    <?php
                        get_template_part( 'loop', 'search' );
                    ?>
                </div>
 				<?php if ( $wp_query->max_num_pages > 1 ) : ?>
                    <h3>
                        <nav id="pagination">
							<?php 
							$num_pages = $wp_query->max_num_pages;
							$next_page_link = get_next_posts_link('Next Page&nbsp;&nbsp;>>');
							$prev_page_link = get_previous_posts_link('<<&nbsp;&nbsp;Previous Page');
							
							if($prev_page_link) echo $prev_page_link . '&nbsp;&nbsp;|&nbsp;&nbsp;';
							for ($i = 1; $i <= 4; $i++){
								if ($i != get_query_var('paged') )echo '<a href="' . get_site_url() . '/page/' . $i . '/?s=' . get_search_query() . '">' . $i . '</a>';
								else echo $i;
								if ($i != $wp_query->max_num_pages) echo '&nbsp;&nbsp;|&nbsp;&nbsp;';
							}
							
							if($next_page_link) echo '&nbsp;&nbsp;|&nbsp;&nbsp;' . $next_page_link;
							
							?>
                        </nav>
                    </h3>
                    <?php endif; ?>
        <?php else : ?>
        <div class="post">
        	
            <h1 id="search-head"><?php _e( 'Nothing found. ', 'norwalk' ); ?></h1>
            <div class="the-content nothing-found">
                    <p><?php _e( 'Sorry, but nothing matched your search criteria. Please try again.', 'norwalk' ); ?></p>
                    <?php get_search_form(); ?>
            
                <script type="text/javascript">
                    // focus on search field after it has loaded
                    document.getElementById('s') && document.getElementById('s').focus();
                </script>
	        </div>
        </div>
        <?php endif; ?>
	</div>
    <aside class="sidebar">
        <?php get_sidebar('search'); ?>
    </aside>
	<div class="clear-floats"></div>
</div>
<?php get_footer(); ?>