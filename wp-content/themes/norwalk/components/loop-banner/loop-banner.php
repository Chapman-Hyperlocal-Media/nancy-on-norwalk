<?php

function norwalk_loop_banner($post_id = null) {
    if (empty($post_id)) {
        return null;
    }
    $Post = get_post($post_id);
    if (empty($Post->post_content)) {
        return null;
    }

    $content = apply_filters('the_content', $Post->post_content);

    return <<<HTML
<div id="top-loop-banner" class="post">
    <div class="the-content">
        $content
    </div>
</div>
HTML;
}
