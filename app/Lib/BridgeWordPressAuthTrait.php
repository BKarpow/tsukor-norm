<?php

namespace App\Lib;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;

trait BridgeWordPressAuthTrait {
    private function createNewWordPressUser(array $data) : bool
    {
        $pr = [
            "token" => env("BRIDGE_KEY"),
            "module" => "createUser",
            "user_login" => $data['name'],
            "user_email" => $data['email'],
            "user_pass" => $data['password'],
            "redirect_url" => url("/home")
        ];
        $response = Http::post(env("BRIDGE_REGISTER_API"), $pr);
        // Обробка відповіді
        if ($response->successful()) {
            $responseData = json_decode($response->body(), true);
            return $responseData['status'];
        } else {
            Log::error( $response->status() .', '. $response->body());
            return false;
        }
    }

    public function getValidAuthWpData(Request $request): array
    {
        return $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    public function goToAuthWpPage(array $data)
    {
        return view('blSignOn', [
            'redirectSignOn' => env("BRIDGE_SUGNON_URL"),
            'email' => $data['email'],
            'password' => $data['password'],
        ]);
    }
}
