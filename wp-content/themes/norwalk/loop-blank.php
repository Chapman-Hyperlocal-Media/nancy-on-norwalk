<?php
/**
 * The loop that displays a page.
 *
 * @package WordPress
 * @subpackage Starkers
 * @since Starkers HTML5 3.2
 */
?>

<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

		<article id="post-<?php the_ID(); ?>" <?php post_class('type-page'); ?>>
			<div class="the-content">
				<?php the_content(); ?>
            </div>
			<footer>
				<?php edit_post_link( __( 'Edit', 'starkers' ), '', '' ); ?>
			</footer>
		</article>

        <?php comments_template( '', true ); ?>

<?php endwhile; ?>