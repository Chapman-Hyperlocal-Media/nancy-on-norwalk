<?php
/**
 * The loop that displays an attachment.
 *
 * @package WordPress
 * @subpackage Starkers
 * @since Starkers HTML5 3.2
 */
?>

<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

				<?php /*if ( ! empty( $post->post_parent ) ) : ?>
					<p><a href="<?php echo get_permalink( $post->post_parent ); ?>" title="<?php esc_attr( printf( __( 'Return to %s', 'starkers' ), get_the_title( $post->post_parent ) ) ); ?>" rel="gallery"><?php /* translators: %s - title of parent post */ /*printf( __( '&larr; %s', 'starkers' ), get_the_title( $post->post_parent ) ); ?></a></p>
				<?php endif;*/ ?>

				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> >

<?php if ( wp_attachment_is_image() ) :
	$attachments = array_values( get_children( array( 'post_parent' => $post->post_parent, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => 'ASC', 'orderby' => 'menu_order ID' ) ) );
	foreach ( $attachments as $k => $attachment ) {
		if ( $attachment->ID == $post->ID )
			break;
	}?>

    <?php
	$k++;
	// If there is more than 1 image attachment in a gallery
	if ( count( $attachments ) > 1 ) {
		if ( isset( $attachments[ $k ] ) )
			// get the URL of the next image attachment
			$next_attachment_url = get_attachment_link( $attachments[ $k ]->ID );
		else
			// or get the URL of the first image attachment
			$next_attachment_url = get_attachment_link( $attachments[ 0 ]->ID );
	} else {
		// or, if there's only 1 image attachment, get the URL of the image
		$next_attachment_url = wp_get_attachment_url();
	}
?>
				<div class="img-container">
                	<a href="<?php echo $next_attachment_url; ?>" title="<?php echo esc_attr( get_the_title() ); ?>" rel="attachment">
					<?php /*$attachment_width  = apply_filters( 'starkers_attachment_width', 900 );
					$attachment_height = apply_filters( 'starkers_attachment_height', 900 );
					echo wp_get_attachment_image( $post->ID, array( $attachment_width, $attachment_height ) );*/ 
					echo wp_get_attachment_image( $post->ID, 'large' ); ?></a>
                    <div class="inner-shadow top left"></div>
                    <div class="inner-shadow top right"></div>
                    <div class="inner-shadow left"></div>
                    <div class="inner-shadow right"></div>
                </div>
			<?php if ( !empty( $post->post_excerpt ) ){ ?>
				<h2 id="single-attach-caption">
                <?php $myExcerpt = get_the_excerpt();
                  $tags = array("<p>", "</p>");
                  $myExcerpt = str_replace($tags, "", $myExcerpt);
                  echo $myExcerpt;?>
                 </h2>
			<?php }?>

				<?php the_content( __( 'Continue reading &rarr;', 'starkers' ) ); ?>

				<h3 class="parent-link"> This image was originally posted as part of this story:		
<a class="parent-title" href="<?php echo get_permalink($post->post_parent); ?>"><?php echo get_the_title($post->post_parent); ?></a>
						<?php
							printf( __( 'By %2$s', 'starkers' ),
								'meta-prep meta-prep-author',
								sprintf( '<a href="%1$s" title="%2$s">%3$s</a>',
									get_author_posts_url( get_the_author_meta( 'ID' ) ),
									sprintf( esc_attr__( 'View all posts by %s', 'starkers' ), get_the_author() ),
									get_the_author()
								)
							);
						?>
						on
						<?php
							printf( __( '%2$s', 'starkers' ),
								'meta-prep meta-prep-entry-date',
								sprintf( '<abbr title="%1$s">%2$s</abbr>',
									esc_attr( get_the_time() ),
									get_the_date()
								)
							);
							/*if ( wp_attachment_is_image() ) {
								echo ' | ';
								$metadata = wp_get_attachment_metadata();
								printf( __( 'Full size is %s pixels', 'starkers' ),
									sprintf( '<a href="%1$s" title="%2$s">%3$s &times; %4$s</a>',
										wp_get_attachment_url(),
										esc_attr( __( 'Link to full-size image', 'starkers' ) ),
										$metadata['width'],
										$metadata['height']
									)
								);
							}*/
						?><?php edit_post_link( __( 'Edit', 'norwalk' ), ' - ', '' ); ?></h3>
						
					
<?php /*?>				<nav>
					<?php previous_image_link('', 'Previous Image' ); ?>
					<?php the_title(); ?>
					<?php next_image_link( false ); ?>
				</nav><?php */?>
<?php else : ?>
				<a href="<?php echo wp_get_attachment_url(); ?>" title="<?php echo esc_attr( get_the_title() ); ?>" rel="attachment"><?php echo basename( get_permalink() ); ?></a>
<?php endif; ?>
				
				
				<?php wp_link_pages( array( 'before' => '<nav>' . __( 'Pages:', 'starkers' ), 'after' => '</nav>' ) ); ?>

				<footer>
					<?php // sharing links go here; ?>
				</footer>
				
			</article>

<?php endwhile; // end of the loop. ?>