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
			<header class="story-head">
				<?php 
				if(has_post_thumbnail()){
					
					if ( !has_excerpt(get_post_thumbnail_id()) ){
						the_post_thumbnail('story_thumb');
					}

					else {
						$thumbnail_id = get_post_thumbnail_id();
						$thumbnail = get_post( $thumbnail_id );

						$markup = [];

						$markup[] = '<div id="attachment_' . $thumbnail_id . '" class="wp-caption aligncenter">';
						$markup[] = 	'<a href="' . wp_get_attachment_url( $thumbnail_id ) . '">';
						$markup[] = 		get_the_post_thumbnail($post, 'story_thumb');
						$markup[] = 	'</a>';
						$markup[] = 	'<div class="wp-caption-text">';
						$markup[] = 		'<p>' . get_post(get_post_thumbnail_id())->post_excerpt . '</p>';
						$markup[] = 	'</div>';
						$markup[] = '</div>';

						echo implode("\n\r", $markup);
					}
					
				} ?>

				<?php if ( is_front_page() ) { ?>
					<h2 class="post-title"><?php the_title(); ?></h2>
				<?php } else { ?>	
					<h1 class="post-title"><?php the_title(); ?></h1>
				<?php } ?>
			</header>				

			<div class="the-content">
				<?php the_content(); ?>
			</div>
						
				<?php //wp_link_pages( array( 'before' => '<nav>' . __( 'Pages:', 'starkers' ), 'after' => '</nav>' ) ); ?>
						
			<footer>
				<?php edit_post_link( __( 'Edit', 'starkers' ), '', '' ); ?>
			</footer>
		</article>

				<?php //comments_template( '', true ); ?>

<?php endwhile; ?>