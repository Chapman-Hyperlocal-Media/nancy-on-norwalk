<?php

if ( ! function_exists( 'norwalk_posted_on' ) ) :
	/**
	 * Prints HTML with information for the current post—date/time.
	 *
	 * @since Starkers HTML5 3.0
	 */
	function norwalk_posted_on($tag = 'span') {
		
		printf( __( '<' . $tag . ' class="date">%2$s</' . $tag . '>', 'norwalk' ),
			'meta-prep meta-prep-author',
			sprintf( '<a href="%1$s" title="%2$s" rel="bookmark"><time datetime="%3$s" pubdate><span class="time">%4$s</span> <span class="month">%5$s</span> <span class="day">%6$s</span> <span class="year">%7$s</span></time></a>',
				get_permalink(),
				esc_attr( get_the_time() ),
				get_the_date('Y-m-d'),
				get_the_time('g : i a T'),
				get_the_date('F'),
				get_the_date('j'),
				get_the_date('Y')
			)
		);
	}
endif;

if( !function_exists('norwalk_meta') ):

	function norwalk_meta($class, $loc = 'side'){
		echo '<ul class="' . $class .'">';
			if ($loc == 'side' && count( get_the_category() )):
				   printf( __( '<li>%2$s</li>', 'norwalk' ), 'entry-utility-prep entry-utility-prep-cat-links', get_the_category_list() ); 
			endif;
			
		echo '<li class="byline"><span class="tagline">By </span>' . norwalk_display_byline() . '</li>';
			
			norwalk_posted_on('li');
					
			$tags_list = get_the_tag_list( '<ul><li>','</li><li>','</li></ul>');
			
			// if ( is_single() && $loc == 'side' && $tags_list ):
			// 	printf( __( '<li class="tags"><span class="tagline">Tags </span>%2$s</li>', 'norwalk' ), 'entry-utility-prep entry-utility-prep-tag-links', $tags_list );  
			// endif; 
			echo '<li class="comments">';
			comments_popup_link( __( 'Leave a comment', 'norwalk' ), __( '1 Comment', 'norwalk' ), __( '% Comments', 'norwalk' ) );
		echo '</li>';
          	edit_post_link( __( 'Edit', 'norwalk' ), '<li class="edit-link">', '</li>' );
		echo '</ul>';
	}

endif;