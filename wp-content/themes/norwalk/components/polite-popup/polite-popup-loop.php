<?php
/**
 * Created by PhpStorm.
 * User: ericchapman
 * Date: 2019-01-28
 * Time: 21:17
 */
function norwalk_polite_popup_loop() {
	$query_settings = array(
		'post_type' => 'modals',
		'posts_per_page' => 3
	);
	$modal_query = new WP_Query($query_settings);

	if (!$modal_query->have_posts()) {
		return;
	}
	$output = array();
	while($modal_query->have_posts()):
		$modal_query->the_post();
		$output[] = norwalk_polite_popup($modal_query->post);
	endwhile;
	return implode("\n", $output);
}
