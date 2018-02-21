<?php
/**
 * The main template file.
 *
 * @package WordPress
 * @subpackage Starkers
 * @since Starkers HTML5 3.0
 */?>
 
<?php get_header(); ?>
    <div id="main-content">
        <div class="content">
            <?php

                // Special query for main page to exclude certain categories.
                if (is_home()){
                    // Switch the main query with the modified query, for convenience.
                    // after the loop is done, we will switch them back.
                    $exclude_cats = array(
                        790, // State
                        7070 // Press Releases
                    );
                    $main_query = $wp_query;
                    $wp_query = norwalk_exclude_categories($exclude_cats);
                }

                get_template_part( 'loop', 'index' );

                if (is_home()){
                    //Restore the original main query.
                    if (isset($main_query)) $wp_query = $main_query;
                }

            ?>
        </div>
        <aside class="sidebar">
            <?php get_sidebar(); ?>
        </aside>
        <div class="clear-floats"></div>
        
    </div>
<?php get_footer(); ?>
