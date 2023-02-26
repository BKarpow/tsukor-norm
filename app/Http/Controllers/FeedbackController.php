<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Lib\TelegramTrait;

class FeedbackController extends Controller
{
    use TelegramTrait;

    public function feedbackFooterSend(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'answer' => "required|min:3|max:250",
            'g-recaptcha-response' => 'required|recaptchav3:register,0.5'
        ]);
        $this->sendText("Email: {$request->email} \n {$request->answer}.");
        return redirect()->back()->withStatus('Питання надіслано.');
    }
}
