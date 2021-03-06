<?php


//updating messages
function editMessageText(
    $text,
    $chat_id = null,
    $message_id = null,
    $inline_message_id = null,
    $parse_mode = null,
    $disable_web_page_preview = null,
    $reply_markup = null,
    $response = RESPONSE
)
{
    $args = [
        'text' => $text,
    ];

    if (isset($chat_id)) {
        $args['chat_id'] = $chat_id;
    }
    if (isset($message_id)) {
        $args['message_id'] = $message_id;
    }
    if (isset($inline_message_id)) {
        $args['inline_message_id'] = $inline_message_id;
    }
    if (isset($parse_mode)) {
        $args['parse_mode'] = $parse_mode;
    }
    if (isset($disable_web_page_preview)) {
        $args['disable_web_page_preview'] = $disable_web_page_preview;
    }
    if (isset($reply_markup)) {
        $reply_markup = json_encode($reply_markup);
        $args['reply_markup'] = $reply_markup;
    }

    if ($response) {
        return curlRequest('editMessageText', $args);
    } else {
        return jsonPayload('editMessageText', $args);
    }
}


function editMessageCaption(
    $chat_id = null,
    $message_id = null,
    $inline_message_id = null,
    $caption = null,
    $parse_mode = null,
    $reply_markup = null,
    $response = RESPONSE
)
{
    if (isset($chat_id)) {
        $args['chat_id'] = $chat_id;
    }
    if (isset($message_id)) {
        $args['message_id'] = $message_id;
    }
    if (isset($inline_message_id)) {
        $args['inline_message_id'] = $inline_message_id;
    }
    if (isset($caption)) {
        $args['caption'] = $caption;
    }
    if (isset($parse_mode)) {
        $args['parse_mode'] = $parse_mode;
    }
    if (isset($reply_markup)) {
        $reply_markup = json_encode($reply_markup);
        $args['reply_markup'] = $reply_markup;
    }

    if ($response) {
        if (isset($args)) {
            return curlRequest('editMessageCaption', $args);
        } else {
            return curlRequest('editMessageCaption');
        }
    } else {
        if (isset($args)) {
            return jsonPayload('editMessageCaption', $args);
        } else {
            return jsonPayload('editMessageCaption');
        }
    }
}


function editMessageReplyMarkup(
    $chat_id = null,
    $message_id = null,
    $inline_message_id = null,
    $reply_markup = null,
    $response = RESPONSE
)
{
    if (isset($chat_id)) {
        $args['chat_id'] = $chat_id;
    }
    if (isset($message_id)) {
        $args['message_id'] = $message_id;
    }
    if (isset($inline_message_id)) {
        $args['inline_message_id'] = $inline_message_id;
    }
    if (isset($reply_markup)) {
        $reply_markup = json_encode($reply_markup);
        $args['reply_markup'] = $reply_markup;
    }

    if ($response) {
        if (isset($args)) {
            return curlRequest('editMessageReplyMarkup', $args);
        } else {
            return curlRequest('editMessageReplyMarkup');
        }
    } else {
        if (isset($args)) {
            return jsonPayload('editMessageReplyMarkup', $args);
        } else {
            return jsonPayload('editMessageReplyMarkup');
        }
    }
}


function deleteMessage($chat_id, $message_id, $response = RESPONSE)
{
    $args = [
        'chat_id' => $chat_id,
        'message_id' => $message_id,
    ];

    if ($response) {
        return curlRequest('deleteMessage', $args);
    } else {
        return jsonPayload('deleteMessage', $args);
    }
}


function editMessageMedia(
    $chat_id = null,
    $message_id = null,
    $inline_message_id = null,
    $media = null,
    $reply_markup = null,
    $response = RESPONSE
)
{
    $args = [
        'media' => $media,
    ];

    if (isset($chat_id)) {
        $args['chat_id'] = $chat_id;
    }
    if (isset($message_id)) {
        $args['message_id'] = $message_id;
    }
    if (isset($inline_message_id)) {
        $args['inline_message_id'] = $inline_message_id;
    }
    if (isset($reply_markup)) {
        $reply_markup = json_encode($reply_markup);
        $args['reply_markup'] = $reply_markup;
    }

    if ($response) {
        if (isset($args)) {
            return curlRequest('editMessageMedia', $args);
        } else {
            return curlRequest('editMessageMedia');
        }
    } else {
        if (isset($args)) {
            return jsonPayload('editMessageMedia', $args);
        } else {
            return jsonPayload('editMessageMedia');
        }
    }
}