<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Rules\ReCaptcha;

class UserController extends Controller
{
    public function saveSetupType(Request $request)
    {
       $request->validate([
            'type_diabet' => 'required|numeric|max:2|min:1'
       ]);
       $user = Auth::user();
       $user->type_diabet = (int)$request->input('type_diabet');
       $user->use_insulin = (bool)$request->input('use_insulin', false);
       $user->use_tablet = (bool)$request->input('use_tablet', false);
       $user->save();
       return redirect()->route('home');
    }

    public function changeProfile(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:150',
            'password' => 'required|string|min:8',
        ]);
            $user = Auth::user();
            $user->name = $request->name;
            $user->password = Hash::make($request->password);
            $user->save();
            return redirect()->route('home')->withStatus('Профіль користувача оновлено!');
    }

    public function deleteUserAndData()
    {
        return view('auth.deleteUser');
    }

    public function deleteUserAndDataStore(Request $request)
    {
        $validateRules = [
            'password' => 'required|string'
        ];
        if (!env('APP_DEBUG')){
            $validateRules['g-recaptcha-response'] = ['required', new ReCaptcha];
        }
        $request->validate($validateRules);
        $user = User::findOrFail(Auth::id());
        if (Hash::check($request->password, $user->password)) {
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            $user->delete();
            return redirect()->route('home');
        } else {
            return redirect()->route('home')->withStatus("Некоректний пароль, спробуйте ше раз!");
        }
    }
}
