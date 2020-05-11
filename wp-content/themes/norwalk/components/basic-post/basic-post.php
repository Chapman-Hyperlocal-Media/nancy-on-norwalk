<?php
/**
 * Created by PhpStorm.
 * User: ericchapman
 * Date: 2020-05-10
 * Time: 19:06
 */

function basic_post($post, $hide_title = false) {
	$title = '';
	if (!$hide_title) {
		$title = $post->post_title;
		if ($title !== '') {
			$title = '<h4 class="norwalk-basic-post__title">' . apply_filters('the_title', $title) . '</h4>' . $hide_title;
		}
	}
	$content = apply_filters('the_content', $post->post_content);
	return <<<HTML
	<div class="norwalk-basic-post">
		$title
		$content
	</div>
HTML;
}
