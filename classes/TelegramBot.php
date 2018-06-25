<?php

/**
 * Simply Telegram Bot
 */
class TelegramBot
{
    private $url = "https://api.telegram.org/bot";

    private $token;

    public function __construct($token = false)
    {
        if (!$token) {
            exit("Invalid token key");
        }
        $this->token = $token;
    }

    public function sendMessage($chat_id = false, $message = false, $reply_id = false)
    {
        if (!$chat_id || !$message) {
            return false;
        }
        mb_detect_encoding($message);
        $params["chat_id"] = $chat_id;
        $params["text"] = $message;
        if ($reply_id) {
            $params["reply_to_message_id"] = $reply_id;
        }
        /*
        $keyboard = [
            'keyboard' => [
                [
                    [
                        'text' => 'create'
                    ],
                    [
                        'text' => 'read'
                    ],
                    [
                        'text' => 'update'
                    ],
                    [
                        'text' => 'delete'
                    ]
                ]
            ]
        ];
        $params['reply_markup'] = json_encode($keyboard);
        */
        $url = $this->url . $this->token . "/sendMessage?" . http_build_query($params);
        $result = @file_get_contents($url);
        if ($result === false) {
            exit("Error. Does Not connect to api");
        }
        //var_DUMP($result);

        return true;
    }

    public function listen()
    {
        $update = file_get_contents("php://input");
        $updateArray = json_decode($update, true);
        if (!$updateArray["message"]) {
            return false;
        } else {
            return $updateArray["message"];
        }
    }

    public function sendDocument($chat_id = false, $document = 'http://andr-gud.pro/word_generation/tmp/document.docx') //функция не работает
    {
        if (!$chat_id || !$document) {
            return false;
        }
        $params = array();
        $params["chat_id"] = $chat_id;
        $params["document"] = $document;

        $url = $this->url . $this->token . "/sendDocument?" . http_build_query($params);

        $result = @file_get_contents($url);
        if ($result === false) {
            exit("Error. Does Not connect to api");
        }

        return true;
    }

}