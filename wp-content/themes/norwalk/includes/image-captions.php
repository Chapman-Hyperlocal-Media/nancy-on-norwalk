<?php 

	// Override standard caption output, for image flexibility. Works with wp_flexible_images plugin.
	// add_filter( $tag, $function_to_add, $priority, $accepted_args );
	add_filter('img_caption_shortcode', 'norwalk_flex_caption', 10, 3 );
	if ( !function_exists( 'norwalk_flex_caption' ) ):

		function norwalk_flex_caption($wtf, $attr, $content){
			
			extract(shortcode_atts(array(
				'id'	=> '',
				'align'	=> 'alignnone',
				'width'	=> '',
				'caption' => ''
			), $attr));

			if ( 1 > (int) $width || empty($caption) )
				return '' . $content . '';

			if ( $id ) $id = 'id="' . esc_attr($id) . '" ';

			return '<div ' . $id . ' class="wp-caption ' . esc_attr($align) . '">'
			. do_shortcode( $content ) . '<div class="wp-caption-text"><p>' . $caption . '</p></div></div>';
		}

	endif;
