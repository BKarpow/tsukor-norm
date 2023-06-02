<?php

namespace App\Listeners;

use App\Events\RussianUserVisit;
use App\Lib\TelegramTrait;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class NewRusVisitTelegramNot
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
     * @param  \App\Event\RussianUserVisit  $event
     * @return void
     */
    public function handle(RussianUserVisit $event)
    {
        $ts = date('d-m-Y H:i:s', $event->timeVisit);
        $msg = "Кацапський користувач: {$event->ip}, {$event->userAgent} \n Дата {$ts}";
        $this->sendText($msg);
    }
}
