<?php

	/*
	 *		Sharing buttons
	 *		Added Norwalk 1.2.1
	 *		Creates functions to add sharing buttons to template files.
	 *
	 */

	if (!function_exists('norwalk_tweet_button')){

		function norwalk_tweet_button($echo = true, $target = false, $size = 'medium', $via = 'nancynorwalk', $count = 'horizontal'){
			if ($target) $url = ' data-url="' . $target . '"';
			else $url = ' data-url="' . get_permalink() . '"';
			$size = ' data-size="' . $size . '"';
			$via = ' data-via="' . $via . '"';
			$text = ' data-text="' . get_the_title() . '"';
			$count = ' data-count="' . $count . '"';
			
			$button = '<a href="https://twitter.com/share" class="twitter-share-button" data-lang="en"' . $url . $size . $via . $text . $count . '>Tweet</a>
			<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="https://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>';
			
			if ($echo) echo $button; 
			else return $button;
		}

	}

	if (!function_exists('norwalk_facebook_like')){

		function norwalk_facebook_like($echo = true, $target = false, $color = 'light', $ref = false, $layout = 'button_count', $share = 'false', $action = 'like'){
			if ($target) $href = ' data-href="' . $target . '"';
			else $href = ' data-href="' . get_permalink() . '"';
			$type = ' data-type="' . $layout . '"';
			$layout = ' data-layout="' . $layout . '"';
			$share = ' data-share="' . $share . '"';
			$action = ' data-action="' . $action . '"'; 
			$color = ' data-colorscheme="' . $color . '"'; 
			/*

			The $ref parameter was preventing the like button from loading on some pages.
			This was because the ref parameter can't be longer than 50 characters,
			and it was being auto-filled with the title of the story. 
			So, if the headline was more than 50 characters, 
			the like button	would not load. 

			*/

			if (!$ref) {
				$titleRef = preg_replace('/\s+/', '_', get_the_title());
				$titleRef = urlencode($titleRef);
				$titleRef = substr($titleRef, 0, 47);
				$ref = ' data-ref="FB+' . $titleRef . '"';
			}

			$button = '<div class="fb-like"' . $href . $layout . $share . $action . $ref . $color . ' data-send="true" data-show-faces="false" data-width="64"></div><div class="fb-share-button"' . $href . $type . '></div>';
			if ($echo) echo $button;
			else return $button;
		}

	}

	if (!function_exists('norwalk_googleplus_button')){

		function norwalk_googleplus_button($echo = true, $target = false, $size = 'medium', $annotation = 'bubble', $width = NULL ){
			if ($target) $href = ' data-href="' . $target . '"';
			else $href = ' data-href="' . get_permalink() . '"';
			$size = ' data-size="' . $size . '"';
			if($annotation == 'inline' && $width != NULL){
				$width = ' data-width="' . $width . '"';
				$annotation = ' data-annotation="' . $annotation . '"' . $width . '"';
			}
			else $annotation = ' data-annotation="' . $annotation . '"';
			
			
			$button = '<div style="float:left;"><div class="g-plusone"' . $href . $size . $annotation . '></div></div>';
			if ($echo) echo $button;
			else return $button;
		}

	}

	if (!function_exists('norwalk_social_bar')) {

		function norwalk_social_bar() {
				$tweetButton = norwalk_tweet_button();
				$gPlusButton = norwalk_googleplus_button();
				$fbLikeButton = norwalk_facebook_like();
				$html = <<<EOT
				<div class="norwalk-social-bar">
						$tweetButton
						$gPlusButton
	          $fbLikeButton
	      </div>
EOT;
		}

	}
