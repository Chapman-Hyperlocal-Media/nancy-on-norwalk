<?php //<meta property="fb:admins" content="1174811549" />
?>
<meta property="fb:appid" content="267909876722098" />
<meta property="og:site_name" content="Nancy On Norwalk" />
<?php if (is_single()):
	$og_excerpt = apply_filters('get_the_excerpt', $post->post_content);
	$og_excerpt = str_replace(array("\r\n", "\r", "\n"), "", $og_excerpt);
	$og_excerpt = strip_tags( strip_shortcodes( $og_excerpt ) );
	$og_excerpt = wp_trim_words($og_excerpt, 40);
	?>
    <meta property="og:title" content="<?php the_title(); ?>" />
    <meta property="og:url" content="<?php the_permalink(); ?>" />
    <meta property="og:description" content="<?php echo $og_excerpt; ?>" />
<?php 
	if (has_post_thumbnail()){ 
		$post_thumb_id = get_post_thumbnail_id();
		$post_thumb_url = wp_get_attachment_url($post_thumb_id);
	} else {
		$args = array(
			'post_parent' => $post->ID,
			'post_type'   => 'attachment', 
			'numberposts' => 1,
			'post_status' => 'any',
			'order' => 'ASC' ); 
		$attachments = get_children($args);
		if($attachments) foreach ( $attachments as $attachment ){
			$post_thumb_url = wp_get_attachment_url( $attachment->ID );
		} else $post_thumb_url = false;
	}
	if ($post_thumb_url){
		echo '<meta property="og:image" content="' . $post_thumb_url . '" />'; 
		echo '<meta property="twitter:card" content="summary_large_image" />';
	} else {
		echo '<meta property="twitter:card" content="summary" />';
	} ?>
	<meta property="og:type" content="article" />
<?php /*?>	

Requires facebook profile url or author id for this field to work.

<meta property="article:author" content="<?php echo norwalk_display_byline(true); ?>" /><?php */?>
<?php else: ?>
    <meta property="og:title" content="<?php bloginfo('name'); ?>" />
    <meta property="og:description" content="<?php bloginfo('description'); ?>" />
    <meta property="og:url" content="<?php bloginfo('url'); ?>" />
    <meta property="og:image" content="<?php bloginfo('template_url')?>/images/facebook-default.png" />
    <meta property="og:type" content="website" />
    <meta property="twitter:card" content="summary_large_image" />
<?php endif; ?>
<meta property="twitter:site" content="@nancynorwalk" />