<?php

namespace App\Listeners;

use App\Events\LoginUser;
use App\Mail\LoginMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class LoginUserSendEmail
{
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
     * @param  object  $event
     * @return void
     */
    public function handle(LoginUser $loginUser)
    {
        if (!env('APP_DEBUG')) {
            Mail::to($loginUser->user->email)
                ->send(
                    new LoginMail(
                        $loginUser->ip,
                        $loginUser->ua,
                        $loginUser->isSocLogin
                    )
                );
        } else {
            Log::info('Lpgin user log, ip: '.$loginUser->ip);
        }
    }
}
