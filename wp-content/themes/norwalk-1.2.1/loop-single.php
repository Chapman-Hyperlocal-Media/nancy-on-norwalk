<?php
/**
 * The loop that displays a single post.
 *
 * @package WordPress
 * @subpackage Starkers
 * @since Starkers HTML5 3.2
 */
?>

<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
		
		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			
			<header class="story-head">
              	<?php 
					if(has_post_thumbnail()){?>
						<div class="img-container thumb">
						 <?php the_post_thumbnail('story_thumb'); ?>
                        
                        <div class="inner-shadow top left"></div><div class="inner-shadow top right"></div><div class="inner-shadow left"></div><div class="inner-shadow right"></div></div>
					<?php }
				?>

				<h1 class="post-title"><?php the_title(); ?></h1>

				<?php if (!is_page()) norwalk_meta('meta top', 'top'); ?>
                <div class="norwalk-social-bar">
					<?php norwalk_tweet_button(); ?>
					<?php norwalk_googleplus_button(); ?>
                    <?php norwalk_facebook_like(); ?>
                    
                </div>
			</header>
			<div class="the-content">
           
			<?php the_content(); ?>
			</div>		
			<?php wp_link_pages( array( 'before' => '<nav>' . __( 'Pages:', 'starkers' ), 'after' => '</nav>' ) ); ?>
		
			<?php if ( get_the_author_meta( 'description' ) ) : // If a user has filled out their description, show a bio on their entries  ?>
				<?php echo get_avatar( get_the_author_meta( 'user_email' ), apply_filters( 'starkers_author_bio_avatar_size', 60 ) ); ?>
				<h2><?php printf( esc_attr__( 'About %s', 'starkers' ), get_the_author() ); ?></h2>
				<?php the_author_meta( 'description' ); ?>
					<a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>">
						<?php printf( __( 'View all posts by %s &rarr;', 'starkers' ), get_the_author() ); ?>
					</a>
			<?php endif; ?>
			
			<footer class="story-foot">
            	<div class="norwalk-social-bar">
					<?php norwalk_tweet_button(); ?>
					<?php norwalk_googleplus_button(); ?>
                    <?php norwalk_facebook_like(); ?>
                </div>
            </footer>
				
		</article>

<?php /*?>		<nav>
			<?php previous_post_link( '%link', '' . _x( '&larr;', 'Previous post link', 'starkers' ) . ' %title' ); ?>
			<?php next_post_link( '%link', '%title ' . _x( '&rarr;', 'Next post link', 'starkers' ) . '' ); ?>
		</nav><?php */?>
		<?php if (have_comments() || comments_open()){ ?>
        <a name="comments"></a>
        

			<?php comments_template( '', true ); ?>
		
        <?php } ?>
<?php endwhile; // end of the loop. ?>