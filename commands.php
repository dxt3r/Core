<?php

//replace bot.php with bot_debug.php if you want to receive in chat all the variables generated by the update received
//in bot_debug.php you will need to enter your id
require_once 'bot.php';

if (isset($text) and isset($chat_id)) {
    //a simple message when /start or /help is received from update
    if (stripos($text, '/start') === 0 or stripos($text, '/help') === 0) {
        sendMessage($chat_id,
            '/help - Show this message' . PHP_EOL . '/license - Sends you the link of the page with the license and source code of the bot');
    }


    //shows license of the bot
    if (stripos($text, '/license') === 0) {
        sendMessage($chat_id,
            'Copyright (C) 2017 Davide Turaccio' . PHP_EOL . 'This program is free software: you can redistribute it and/or modify it under the terms of the GNU Affero General Public License as published by the Free Software Foundation, either version 3 of the License, or at your option) any later version.' . PHP_EOL . 'This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU Affero General Public License for more details.' . PHP_EOL . 'You should have received a copy of the GNU Affero General Public License along with this program.  If not, see <http://www.gnu.org/licenses/>.' . PHP_EOL . PHP_EOL . 'The source code of this bot is avaible on https://github.com/davtur19/php-telegram-bot-api');
    }


    //a message with the user's name, response to the user's message, and buttons
    if (stripos($text, '/message') === 0 and isset($from_first_name) and isset($message_id)) {
        $menu['inline_keyboard'] = [
            [
                [
                    'text'          => 'Button 1',
                    'callback_data' => 'btn1'
                ]
            ],
            [
                [
                    'text'          => 'Button 2',
                    'callback_data' => 'btn2'
                ],
                [
                    'text'          => 'Button 3',
                    'callback_data' => 'btn3'
                ]
            ]
        ];
        sendMessage($chat_id, 'Hi ' . $from_first_name . PHP_EOL . $text, 'Markdown', false, false, $message_id, $menu);
    }


    //it will only work if you have a photo.jpg in the bot folder, otherwise you can use link or file_id
    if (stripos($text, '/photo') === 0) {
        sendPhoto($chat_id, 'photo.jpg');
    }


    if (stripos($text, '/video') === 0) {
        sendVideo($chat_id, 'video.mp4');
    }


    if (stripos($text, '/album') === 0) {
        $media = [
            [
                'type'  => 'photo',
                'media' => 'http://example/img/photo.jpg'
            ],
            [
                'type'  => 'photo',
                'media' => 'http://example/img/test.png'
            ]
        ];
        sendMediaGroup($chat_id, $media);
    }


    //send a message when a message is edited
    if (isset($edited_message) and isset($message_id)) {
        sendMessage($chat_id, 'You edited the message:' . PHP_EOL . $text, 'Markdown', false, false, $message_id);
    }


    //forward the message when one writes /feedback
    if ($input = command('/feedback', 1) and isset($message_id)) {
        $r = forwardMessage(MYID, $chat_id, null, $message_id, true);
        if ($r['ok']) {
            sendMessage($chat_id, 'Feedback sent');
        } else {
            sendMessage($chat_id, 'Feedback not sent');
        }
    }


    if (stripos($text, '/admins') === 0) {
        $admins = getChatAdministrators($chat_id);
        $str = '';
        foreach ($admins['result'] as $result) {
            $str .= '@' . $result['user']['username'] . PHP_EOL;
        }
        sendMessage($chat_id, 'Admins:' . PHP_EOL . $str);
    }

}

//edits the message and notifies the user
if (isset($data) and isset($id) and isset($message_chat_id) and isset($message_message_id)) {
    if (stripos($data, 'btn1') === 0) {
        $menu['inline_keyboard'] = [
            [
                [
                    'text'          => 'Button 1',
                    'callback_data' => 'btn1'
                ]
            ],
            [
                [
                    'text'          => 'Button 2',
                    'callback_data' => 'btn2'
                ],
                [
                    'text'          => 'Button 3',
                    'callback_data' => 'btn3'
                ]
            ]
        ];
        answerCallbackQuery($id, 'Button 1');
        editMessageText('Button 1', $message_chat_id, $message_message_id, null, null, null, $menu);
    }
}
