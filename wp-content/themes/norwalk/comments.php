<?php
/**
 * The template for displaying Comments.
 *
 * The area of the page that contains both current comments
 * and the comment form.  The actual display of comments is
 * handled by a callback to starkers_comment which is
 * located in the functions.php file.
 *
 * @package WordPress
 * @subpackage Starkers
 * @since Starkers HTML5 3.0
 */
?>
<div id="comments-section">
<?php if ( post_password_required() ) : ?>
				<p><?php _e( 'This post is password protected. Enter the password to view any comments.', 'norwalk' ); ?></p>
<?php
		return;
	endif;
?>

<?php
	// You can start editing here -- including this comment!
?>

<?php if ( have_comments() ) : ?>
			<?php /* STARKERS NOTE: The following h3 id is left intact so that comments can be referenced on the page */ ?>
			<div id="comment-section-head">
                <h3 id="comments-title"><?php
                printf( _n( 'One comment', '%1$s comments', get_comments_number(), 'norwalk' ),
                number_format_i18n( get_comments_number() ));
                ?></h3>


<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // Are there comments to navigate through? ?>
	<nav class="comment-nav">
    	<a href="#prevcomm" name="prevcomm">&larr; Older Comments</a><a href="#nextcomm" name="nextcomm">Newer Comments &rarr;</a>
		<?php previous_comments_link( __( '&larr; Older Comments', 'norwalk' ) ); ?>
		<?php next_comments_link( __( 'Newer Comments &rarr;', 'norwalk' ) ); ?>
	</nav>
<?php endif; // check for comment navigation ?>
            </div>
            <div class="comments">
		<?php
            wp_list_comments( array( 'style' => 'div', 'callback' => 'norwalk_comment', 'end-callback' => 'starkers_comment_close' ) );
        ?></div>

<?php  if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // Are there comments to navigate through? ?>
	<nav class="comment-nav">
    	<a href="#prevcomm" name="prevcomm">&larr; Older Comments</a>
        <a href="#nextcomm" name="nextcomm">Newer Comments &rarr;</a>
		<?php previous_comments_link( __( '&larr; Older Comments', 'starkers' ) ); ?>
		<?php next_comments_link( __( 'Newer Comments &rarr;', 'starkers' ) ); ?>
	</nav>
<?php endif; // check for comment navigation ?>

<?php else : // or, if we don't have comments:

	if ( ! comments_open() ) :
?>
	<p><?php _e( 'Comments are closed.', 'starkers' ); ?></p>
<?php endif; // end ! comments_open() ?>

<?php endif; // end have_comments() ?>

<?php comment_form(); ?>
</div>