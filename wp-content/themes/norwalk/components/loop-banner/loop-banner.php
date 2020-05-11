<?php

function norwalk_loop_banner() {
	$content = render_site_text_as_basic_posts('top-post-banner', true);
	if ($content === '') {
		return '';
	}

    return <<<HTML
<div id="top-loop-banner" class="post">
    <div class="the-content">
        $content
    </div>
</div>
HTML;
}
