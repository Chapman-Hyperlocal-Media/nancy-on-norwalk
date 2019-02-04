<?php

function norwalk_polite_popup($post) {
    $postId = $post->ID;
    $title = get_the_title();
    $content = apply_filters('the_content', get_the_content());
    $customFields = get_post_custom($postId);
    $expiration = $customFields['modal-expiration'][0];
    return <<<HTML
<aside class="norwalk-polite-modal" data-id="$postId" data-expiration="$expiration">
    <div class="norwalk-polite-modal__inner">
        <h3 class="norwalk-polite-modal__title">$title</h3>
        <div class="norwalk-polite-modal__content">
            $content
            <p class="norwalk-polite-modal__small-text norwalk-polite-modal__dismissal-note">When dismissed, this message will not appear again on this computer for <span class="norwalk_polite-modal__dismissal-time">$expiration</span> days</p>
        </div>
        <button class="norwalk-polite-modal__close" type="button" aria-label="Close">Close</button>
    </div>
</aside>
HTML;
}