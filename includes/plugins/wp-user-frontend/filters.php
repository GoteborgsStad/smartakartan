<?php

add_filter('wpuf_edit_post_redirect', function($response, $postId, $formId, $formSettings) {
    if (intval($formId) === 2184 && isset($response['message'])) {
        $response['message'] = pll__('Thank you for posting on our site. We have sent you an confirmation email. Please check your inbox!');
    }

    if (intval($formId) === 2487 && isset($response['message'])) {
        $response['message'] = pll__('Thank you for posting on our site. We have sent you an confirmation email. Please check your inbox!');
    }

    return $response;
}, 10, 4);
