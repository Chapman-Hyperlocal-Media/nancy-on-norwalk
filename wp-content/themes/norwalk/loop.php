<?php
/**
 * The loop that displays posts.
 *
 * @package WordPress
 * @subpackage Starkers
 * @since Starkers HTML5 3.0
 */
?>
 
<?php /* Display navigation to next/previous pages when applicable */ ?>
<?php /* if ( $wp_query->max_num_pages > 1 ) : ?>
    <nav>
        <?php next_posts_link( __( '&larr; Older posts', 'starkers' ) ); ?>
        <?php previous_posts_link( __( 'Newer posts &rarr;', 'starkers' ) ); ?>
    </nav>
<?php endif;*/ ?>
<?php
    // Loop counting, for mobile ad placement.
    $loop_num = 0;
    $mobile_ads_slot = 1;

    // Special query for main page to exclude certain categories.
    if (is_home()){
        $categories = get_terms(array('category', 'nav_menu'), 
            array('exclude' => array(
                790 // State
            )
        ));
        $category_ids = array();
        $paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;
        foreach ($categories as $category) {
            array_push($category_ids, $category->term_id);
        }
        $homepage_query = new WP_Query( array('category__in' => $category_ids, 'paged' => $paged) );
        // Wordpress will think this query is an Archive because we specified categories. 
        $homepage_query->is_archive = false;
        // Switch the main query with the homepage query, for convenience.
        // after the loop is done, we will switch them back.
        $main_query = $wp_query;
        $wp_query = $homepage_query;
    }
?>
<?php /* If there are no posts to display, such as an empty archive page */ ?>
<?php if ( ! have_posts() ) : ?>
        <h1><?php _e( 'Not Found', 'starkers' ); ?></h1>
            <p><?php _e( 'Apologies, but no results were found for the requested archive. Perhaps searching will help find a related post.', 'norwalk' ); ?></p>
            <?php get_search_form(); ?>
<?php endif; ?>
 
<?php while ( have_posts() ) : the_post(); ?>

<?php $loop_num++; ?> 
<?php /* How to display posts of the Gallery format. The gallery category is the old way. */ ?>
 
    <?php if ( ( function_exists( 'get_post_format' ) && 'gallery' == get_post_format( $post->ID ) ) || in_category( _x( 'gallery', 'gallery category slug', 'starkers' ) ) ) : ?>
     
        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
            <header>
                <h2 class="post-title"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'starkers' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
 
                <?php norwalk_posted_on(); ?>
            </header>
 
<?php if ( post_password_required() ) : ?> 
                <?php the_content(); ?>
<?php else : ?>
<?php $images = get_children( array( 'post_parent' => $post->ID, 'post_type' => 'attachment', 'post_mime_type' => 'image', 'orderby' => 'menu_order', 'order' => 'ASC', 'numberposts' => 999 ) );
    if ( $images ) :
        $total_images = count( $images );
        $image = array_shift( $images );
        $image_img_tag = wp_get_attachment_image( $image->ID, 'thumbnail' ); ?>
        
        <a href="<?php the_permalink(); ?>"><?php echo $image_img_tag; ?></a>
         
        <p><?php printf( _n( 'This gallery contains <a %1$s>%2$s photo</a>.', 'This gallery contains <a %1$s>%2$s photos</a>.', $total_images, 'starkers' ), 'href="' . get_permalink() . '" title="' . sprintf( esc_attr__( 'Permalink to %s', 'starkers' ), the_title_attribute( 'echo=0' ) ) . '" rel="bookmark"', number_format_i18n( $total_images )); ?></p>

	<?php endif; ?>
     
    <?php the_excerpt(); ?>
 
<?php endif; ?>
 
            <footer>
	            <?php if ( function_exists( 'get_post_format' ) && 'gallery' == get_post_format( $post->ID ) ) : ?>
	            <a href="<?php echo get_post_format_link( 'gallery' ); ?>" title="<?php esc_attr_e( 'View Galleries', 'starkers' ); ?>"><?php _e( 'More Galleries', 'starkers' ); ?></a> | 
	            
	            <?php elseif ( in_category( _x( 'gallery', 'gallery category slug', 'starkers' ) ) ) : ?>
	            <a href="<?php echo get_term_link( _x( 'gallery', 'gallery category slug', 'starkers' ), 'category' ); ?>" title="<?php esc_attr_e( 'View posts in the Gallery category', 'starkers' ); ?>"><?php _e( 'More Galleries', 'twentyten' ); ?></a> | 
	            
	            <?php endif; ?>
	            
	            <?php comments_popup_link( __( 'Leave a comment', 'starkers' ), __( '1 Comment', 'starkers' ), __( '% Comments', 'starkers' ) ); ?>
	            <?php edit_post_link( __( 'Edit', 'starkers' ), '| ', '' ); ?>
            </footer>
        </article>
 
<?php /* How to display posts of the Aside format. The asides category is the old way. */ ?>
    
    <?php elseif ( ( function_exists( 'get_post_format' ) && 'aside' == get_post_format( $post->ID ) ) || in_category( _x( 'asides', 'asides category slug', 'starkers' ) )  ) : ?>
     
        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
 
        <?php if ( is_archive() || is_search() ) : // Display excerpts for archives and search. ?>
                <?php the_excerpt(); ?>
        <?php else : ?>
                <?php the_content( __( 'Continue reading &rarr;', 'starkers' ) ); ?>
        <?php endif; ?>
         
            <footer>
                <?php norwalk_posted_on(); ?> | <?php comments_popup_link( __( 'Leave a comment', 'starkers' ), __( '1 Comment', 'starkers' ), __( '% Comments', 'starkers' ) ); ?> <?php edit_post_link( __( 'Edit', 'starkers' ), '| ', '' ); ?>
            </footer>
        </article>
 
<?php /* How to display Category and Tag pages. */ ?>
 	<?php elseif (is_archive()): //( is_category() || is_tag()): ?>
        <a class="blanket-link" href="<?php the_permalink();?>"  title="<?php printf( esc_attr__( 'Click to view this story', 'starkers' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark">
            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                <div class="archive-post-inner">
                	<?php 
    					if(has_post_thumbnail()){?>
    					
    						 <?php the_post_thumbnail('thumbnail'); ?>

    					<?php }
    					else {
    						global $wpdb; 
    						
    						$attachment_id = $wpdb->get_var("SELECT ID FROM $wpdb->posts WHERE post_parent = '$post->ID' 
    AND post_status = 'inherit' AND post_type='attachment' ORDER BY post_date DESC LIMIT 1"); 
    						$thumb = wp_get_attachment_image( $attachment_id, 'thumbnail' ); 
    						if ($thumb) echo $thumb;
    						else {
                                $thumb_markup = '<div class="attachment-thumbnail"><img class="" src="' . get_bloginfo('template_directory') . '/images/blankthumb.gif" /><span>no image</span></div>';
                                echo $thumb_markup;
    						}
    					}
    				?>
                    <h2 class="post-title"><?php the_title(); ?></h2>
     
                    <?php //norwalk_meta('meta'); ?>
               
    			<div class="the-content"> 
                    <p><?php echo trim_excerpt(20); ?> <span class="link-style">(Read more)</span></p>
                </div>
                <p class="date"><?php echo get_the_date('n / j / Y')?></p>
                    <?php // wp_link_pages( array( 'before' => '<nav>' . __( 'Pages:', 'starkers' ), 'after' => '</nav>' ) ); ?>
                <?php //endif; ?>
         		
                </div>
    		</article>
        </a>   	
        	
            
<?php /* How to display all other posts. */ ?>            
    <?php else : ?>
     
        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
         
			<header>
            	<?php 
					if(has_post_thumbnail()){?>
						<div class="img-container thumb">
                            <a href="<?php the_permalink();?>">
        						<?php 
                                    if (is_search()) the_post_thumbnail('search_thumb');
        							else the_post_thumbnail('story_thumb'); 
        							$strip_images = true;
                                ?>
                            </a>
                        <div class="inner-shadow top left"></div><div class="inner-shadow top right"></div><div class="inner-shadow left"></div><div class="inner-shadow right"></div></div>
					<?php }	elseif (is_search()) { ?>
						<div class="img-container thumb">
					<?php global $wpdb; 
						echo '<a href="' . get_permalink() . '">';
						$attachment_id = $wpdb->get_var("SELECT ID FROM $wpdb->posts WHERE post_parent = '$post->ID' 
AND post_status = 'inherit' AND post_type='attachment' ORDER BY post_date DESC LIMIT 1"); 
						$thumb = wp_get_attachment_image( $attachment_id, 'search_thumb' ); 
						if ($thumb) echo $thumb;
						else echo '<img class="search-thumbnail" src="' . get_bloginfo('template_directory') . '/images/blankthumb.gif" />';
						echo '</a>';
						echo '<div class="inner-shadow top left"></div><div class="inner-shadow top right"></div><div class="inner-shadow left"></div><div class="inner-shadow right"></div></div>';
						$strip_images = false;
					} else $strip_images = false;

				?>
                <h2 class="post-title"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'starkers' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
 
                <?php if (!is_search()) norwalk_meta('meta'); 
				else norwalk_meta('meta top', 'top')?>
            </header>
			<div class="the-content"> 

                <?php if(is_search()) the_excerpt();
					else if($strip_images == false) the_content( __( 'Continue reading <span class="more-title">' . get_the_title() . '</span>', 'norwalk' ) ); 
					else the_content( __( 'Continue reading <span class="more-title">' . get_the_title() . '</span>', 'norwalk' ) );?>
                 
                <?php wp_link_pages( array( 'before' => '<nav>' . __( 'Pages:', 'starkers' ), 'after' => '</nav>' ) ); ?>
   
     		</div>
            <footer>
 
                 
            </footer>
		</article>
 
            <?php comments_template( '', true ); ?>
 

    <?php endif; // This was the if statement that broke the loop into three parts based on post type. ?>
 
    <?php   
        /*  mobile ad placements; 
         *  empty divs placed after each story.
         *  Javascript will into these divs from sidebar 
         *  when document width makes it appropriate.
         */
    ?>
    <div id="mobile-ad-slot-<?php echo $mobile_ads_slot; ?>" class="mobile-ad-slot post">
        <p class="ad-label">Advertisement</p>
    </div>

    <?php 
        $mobile_ads_slot++;

        /*  widgetable sidebar approach
        if ( is_int( $loop_num / 2 ) && ($loop_num / 2) != 0){
            echo "<ul id='mobile-ads-" . $mobile_ads_slot . "' class='mobile-ads'>";
            if ( ! dynamic_sidebar( 'mobile-ads-' . $mobile_ads_slot )  )  echo '<!-- mobile-ads-' . $mobile_ads_slot . ' not found -->';
            echo "</ul>";
            $mobile_ads_slot++;
        }*/
    ?>
<?php endwhile; // End the loop. Whew. ?>
 
<?php /* Display navigation to next/previous pages when applicable */ ?>
<?php if ( $wp_query->max_num_pages > 1 && !is_archive() && !is_search() ) : ?>
    <nav class="pagination">
        <?php next_posts_link( __( '&larr; Older posts' ) ); ?>
        <?php previous_posts_link( __( 'Newer posts &rarr;' ) ); ?>
    </nav>
<?php endif; 
 
 if (is_home()){
    //Restore the original main query.
    if (isset($main_query)) $wp_query = $main_query;
 }




?>