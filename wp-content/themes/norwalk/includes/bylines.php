<?php

	/*
	 *		Custom bylines
	 *		Added Norwalk 1.2.1
	 *		Creates meta box for custom byline field, and pre-fills it with the name of the story-creator
	 */

	add_action('admin_menu', 'norwalk_create_custom_byline');
	add_action('save_post', 'norwalk_save_byline');

	if (!function_exists('norwalk_create_custom_byline')){
		function norwalk_create_custom_byline(){
			add_meta_box('norwalk-custom-byline', 'Custom Byline', 'norwalk_custom_byline_box', 'post', 'side');
		}
	}

	if (!function_exists('norwalk_custom_byline_box')){
		function norwalk_custom_byline_box(){
			global $post;
			$id = $post->ID; ?>
	    	<p>	<label for="custom-byline">Use this name:</label>
	        	<input type="text" value="<?php	echo wp_specialchars( get_post_meta( $id, 'custom-byline', true ), 1 ); ?>" name="custom-byline" id="custom-byline" size="25">
	            <?php wp_nonce_field('custom-byline-field','verify-that-shit'); ?>
	        </p>
	    <?php
		}
	}

	if (!function_exists('norwalk_save_byline')){
		function norwalk_save_byline(){
			global $post;
			$id = $post->ID;
			
		/*	if ( !wp_verify_nonce( $_POST['verify-that-shit'], 'custom-byline-field' ) ) return $post_id;

			if ( !current_user_can( 'edit_post', $post_id ) ) return $post_id;*/
			
			$custom_byline = get_post_meta( $id, 'custom-byline', true );
			$new_byline = stripslashes( $_POST['custom-byline'] );
			
			if ( $new_byline && $custom_byline == ''){
				add_post_meta( $id, 'custom-byline', $new_byline, true );
			}
			elseif ( $new_byline != $custom_byline && $new_byline != '' ){
				update_post_meta( $id, 'custom-byline', $new_byline );
			}
			elseif ( $new_byline == '' && $custom_byline ){
				delete_post_meta( $id, 'custom-byline' );}
		}
	}

	function norwalk_display_byline($ouside_loop = false){
		global $post;
		$post_id = $post->ID;
		$custom_byline = get_post_meta( $post_id, 'custom-byline', true );?>
	    <?php
		if( $custom_byline ) return $custom_byline;
		else if($ouside_loop){
			$author_info = get_userdata($post->post_author);
			$author_name = $author_info->first_name . ' ' . $author_info->last_name;
			return $author_name;
		} else return get_the_author();
		
	}
