# Core
# Intro

Core is a simple way to communicate with Telegram APIs in PHP


# Guide
## Setup
1. Upload files to a webserver or use `git clone https://github.com/dxt3r/Core.git NomeCartella`

1. Open setup.php and follow the procedure to set up the webhook, or set the webhook manually at the SITE/commands.php?api=TOKEN

1. Edit config.php and set as described in the comments.

1. Edit commands.php and make your own bot.

## CronJob

To use cronjob, just create a separate file and inculude base_functions.php to get all the basic functions.To use cronjob, just create a separate file and inculude base_functions.php to get all the basic functions.

## Caution ⚠️
The bot automatically generates the variables received from the update, it is recommended to read the documentation carefully and use bot_debug.php to understand how it works (it must be replaced in commands.php, from `require_once (bot.php);` a `require_once (bot_debug. php); `)

In the `bot_debug.php` file, replace` 1111` with your id in this line `define (" MYID "," 1111 ");`, otherwise it will only be very slow ⚠️

As the bot generates the variables based on the content of the received update, a missing variable will generate errors if not handled correctly as it will be NULL
(EX: $text will not exist if the bot will receive a photo)

The json payload is disabled by default because it could give problems with certain network configuration or server, in case you want to use carefully read what is below (even a look at the Telegram bees of how the json payload would not hurt)

The bot to be faster uses json payload, so for some functions if you want to get the answer from Telegram you will need to specify one more parameter. This is done only on the first function that is performed by the update received but only with those that support the json payload, those that have to do file upload or serve only to obtain information will not use it.

⚠️ With some configurations the json payload may not work properly and run last, if it were to force the use of the post request by putting the `$ response` parameter to` true` as an example.

Example: `$risposta = sendMessage(...); $risposta = true` while so `$risposta = sendMessage(..., true); $risposta = array di risposta da Telegram`. A `sendPhoto` using a file instead of `file_id` o `link` will automatically use the post request.

## Variable names
Variable names are created dynamically and they will exist only if present in the update received from Telegram. As names, they have the same array fields sent by update requests via Telegram's webhook. In addition, the first dimension of the array is excluded to create the names of the variables that are separated by an underscore.

Although the first dimension of the array is not used to create variable names, you can use $message, $edited_message, $channel_post, etc ... to distinguish the various messages, for example to understand if the message received is a message normal or modified.
(See here for the names: https://core.telegram.org/bots/api#update)

The names of the incomplete variables can also be used

For example:
$chat_id it will contain 'id' which is inside the array of 'chat'.
it will contain 'id' which is inside the array of...
(For more info on the names look at the bees of Telegram https://core.telegram.org/bots/api#chat)

## Bot operation:
1. When the bot receives a message, Telegram sends a json like the one below, to the page to which the webhook is set.
1. Then this json is decoded and put into the $ update variable which will be an array like the one below.
1. After that the variables are created using the array fields and are separated by an underscore, except for the first dimension of the array (ie update fields like update_id, message, edited_message, channel_post, etc.).

Json sent by Telegram
```
{
"update_id":10000,
"message":{
  "date":1441645532,
  "chat":{
     "last_name":"Test Lastname",
     "id":1111111,
     "first_name":"Test",
     "username":"Test"
  },
  "message_id":1365,
  "from":{
     "last_name":"Test Lastname",
     "id":1111111,
     "first_name":"Test",
     "username":"Test"
  },
  "text":"/start"
}
}
```
Content of $update
```
array(2) {
  ["update_id"]=>
  int(10000)
  ["message"]=>
  array(5) {
    ["date"]=>
    int(1441645532)
    ["chat"]=>
    array(4) {
      ["last_name"]=>
      string(13) "Test Lastname"
      ["id"]=>
      int(1111111)
      ["first_name"]=>
      string(4) "Test"
      ["username"]=>
      string(4) "Test"
    }
    ["message_id"]=>
    int(1365)
    ["from"]=>
    array(4) {
      ["last_name"]=>
      string(13) "Test Lastname"
      ["id"]=>
      int(1111111)
      ["first_name"]=>
      string(4) "Test"
      ["username"]=>
      string(4) "Test"
    }
    ["text"]=>
    string(6) "/start"
  }
}
```
Example of some variables following the array used above
```
$chat
["chat"]=>
    array(4) {
      ["last_name"]=>
      string(13) "Test Lastname"
      ["id"]=>
      int(1111111)
      ["first_name"]=>
      string(4) "Test"
      ["username"]=>
      string(4) "Test"
    }
    
$chat_id
1111111

$update_id
10000

$from_username
Test

$message
["message"]=>
  array(5) {
    ["date"]=>
    int(1441645532)
    ["chat"]=>
    array(4) {
      ["last_name"]=>
      string(13) "Test Lastname"
      ["id"]=>
      int(1111111)
      ["first_name"]=>
      string(4) "Test"
      ["username"]=>
      string(4) "Test"
    }
    ["message_id"]=>
    int(1365)
    ["from"]=>
    array(4) {
      ["last_name"]=>
      string(13) "Test Lastname"
      ["id"]=>
      int(1111111)
      ["first_name"]=>
      string(4) "Test"
      ["username"]=>
      string(4) "Test"
    }
    ["text"]=>
    string(6) "/start"
  }
```
## Division of files
In the main directory we find:
* bot.php is the main file that processes updates and retrieves files with various functions.
* bot_debug.php is the file that allows you to send all the variables created in the chat with the bot, so you can debug and better understand how it works (to use it is to be replaced in require_once in commands.php).
* commands.php is a sample file with basic commands for the bot, to which the webhook should be set.
* functions is the folder with the various functions.
* setup.php is only needed to set up the webhook in an easy way.
* LICENSE the file with the license (GNU Affero General Public License v3.0).

This is the division of the various functions into the files, they are called with the same name as the available Telegram methods
```
/bot
|   base_functions.php
|   bot.php
|   bot_debug.php
|   commands.php
|   LICENSE
|   setup.php
|   
\---functions
    +---admin.php
    |       deleteChatPhoto
    |       exportChatInviteLink
    |       getChatAdministrators
    |       getChatMember
    |       getChatMembersCount
    |       kickChatMember
    |       leaveChat
    |       pinChatMessage
    |       promoteChatMember
    |       restrictChatMember
    |       setChatDescription
    |       setChatPhoto
    |       setChatTitle
    |       unbanChatMember
    |       unpinChatMessage
    |       
    +---debug.php
    |       debug
    |
    +---edit.php
    |       deleteMessage
    |       editMessageCaption
    |       editMessageMedia
    |       editMessageReplyMarkup
    |       editMessageText
    |       
    +---games.php
    |       getGameHighScores
    |       sendGame
    |       setGameScore
    |       
    +---get_info.php
    |       getChat
    |       getFile
    |       getUserProfilePhotos
    |       
    +---inline.php
    |       answerInlineQuery
    |       
    +---input.php
    |       command
    |
    +---location.php
    |       editMessageLiveLocation
    |       sendLocation
    |       sendVenue
    |       stopMessageLiveLocation
    |       
    +---media.php
    |       sendAnimation
    |       sendAudio
    |       sendContact
    |       sendDocument
    |       sendMediaGroup
    |       sendPhoto
    |       sendVideo
    |       sendVideoNote
    |       sendVoice
    |       
    +---passport.php
    |       setPassportDataErrors
    |
    +---payments.php
    |       answerPreCheckoutQuery
    |       answerShippingQuery
    |       sendInvoice
    |       
    +---status.php
    |       answerCallbackQuery
    |       sendChatAction
    |       
    +---stickers.php
    |       addStickerToSet
    |       createNewStickerSet
    |       deleteChatStickerSet
    |       deleteStickerFromSet
    |       getStickerSet
    |       sendSticker
    |       setStickerPositionInSet
    |       setChatStickerSet
    |       setStickerPositionInSet
    |       uploadStickerFile
    |       
    \---updates.php
            deleteWebhook
            getMe
            getMeApi
            getUpdates
            getWebhookInfo
            getWebhookInfoApi
            setWebhook
```


