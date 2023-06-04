<?php

namespace App\Listeners;

use App\Events\RegisterUser;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Lib\TelegramTrait;

class TelegramNoRegisterUser
{
    use TelegramTrait;
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\RegisterUser  $event
     * @return void
     */
    public function handle(RegisterUser $event)
    {
        $this->sendText("Новий користувач {$event->nameUser} <{$event->emailUser}>");
    }
}
