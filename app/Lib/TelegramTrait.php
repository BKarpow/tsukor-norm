<?php

namespace App\Lib;

trait TelegramTrait {


    private function sendText(string $text)
    {
        $t = new \Telegram(env("TELEGRAM_BOT_TOKEN"));
        $content = array('chat_id' => env("TELEGRAM_FEEDBACK_CHAT_ID"), 'text' => $text);
        return $t->sendMessage($content);
    }
}
