<?php
/**
 * The template for displaying Archive pages.
 *
 * @package WordPress
 * @subpackage Starkers
 * @since Starkers HTML5 3.0
 */

get_header(); ?>
<div id="main-content">
    <div class="content">
    	<hgroup>
<?php
	if(is_category()): ?>
		
            <h1 id="archive-head"><?php
                printf( __( '%s', 'norwalk' ), '<span class="archive-head">' . single_cat_title( '', false ) . '</span> archive' );
            ?></h1>
        <?php $category_description = category_description();
            if ( ! empty( $category_description ) )
                echo '<h2 id="description">' . $category_description . '</h2>';?> 
<?php 	elseif(is_tag()): ?> 
		<h1 id="archive-head"><?php
			printf( __( 'Stories tagged %s', 'norwalk' ), '' . single_tag_title( '', false ) . '' );
		?></h1>                  
<?php	elseif ( have_posts() ):
		the_post();
?>

			<h1 id="archive-head">
			<?php if ( is_day() ) : ?>
                            <?php printf( __( 'Daily Archives: %s', 'norwalk' ), get_the_date() ); ?>
            <?php elseif ( is_month() ) : ?>
                            <?php printf( __( 'Monthly Archives: %s', 'norwalk' ), get_the_date('F Y') ); ?>
            <?php elseif ( is_year() ) : ?>
                            <?php printf( __( 'Yearly Archives: %s', 'norwalk' ), get_the_date('Y') ); ?>
            <?php else : ?>
                            <?php _e( 'Blog Archives', 'norwalk' ); ?>
			
			<?php endif; ?>
            </h1>
		<?php endif; ?>
        
        <h3 id='date-range'><?php
            $date_range = norwalk_get_date_range();
            echo 'Showing ' . $date_range[0] . ' to ' . $date_range[1];
        ?>
        <?php if ( $wp_query->max_num_pages > 1 ) : ?>
        <nav class="pagination">&nbsp;&nbsp;|&nbsp;&nbsp;<?php 
            posts_nav_link('&nbsp;&nbsp;|&nbsp;&nbsp;','Show newer posts','Show older posts'); ?>
            </nav>
        </h3>
        <?php endif; ?>
        </hgroup>
        

<?php rewind_posts();

	get_template_part( 'loop', '' );
?>
<?php if ( $wp_query->max_num_pages > 1 ) : ?>

		<nav class="pagination">
			<?php posts_nav_link('&nbsp;&nbsp;|&nbsp;&nbsp;','Show newer posts','Show older posts'); ?>
        </nav>
<?php endif; ?>
    </div>
    <aside class="sidebar">
        <?php 
			if (is_category()) $which_sidebar = 'category';
			else if (is_tag()) $which_sidebar = 'tag';
			else $which_sidebar = 'chronological';
			get_sidebar($which_sidebar); ?>
    </aside>
<div class="clear-floats"></div>
</div>
<?php get_footer(); ?>