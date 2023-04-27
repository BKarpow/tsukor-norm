<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\SugarTargetRange;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Lib\BridgeWordPressAuthTrait;
use Illuminate\Http\Request;
use App\Rules\ReCaptcha;
use App\Rules\StopRussianEmail;

class RegisterController extends Controller
{
    use BridgeWordPressAuthTrait;
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        $validateRules = [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users', new StopRussianEmail],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'type_diabet' => ['required', 'numeric', 'max:3'],
            'use_insulin' => ['sometimes'],
            'use_tablet' => ['sometimes'],
        ];
        if (!env('APP_DEBUG')){
            $validateRules['g-recaptcha-response'] = ['required', new ReCaptcha];
        }
        return Validator::make($data, $validateRules);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        $insulin = $data['use_insulin'] ?? false;
        $tablet = $data['use_tablet'] ?? false;
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'type_diabet' => $data['type_diabet'],
            'use_insulin'  => (bool)$insulin,
            'use_tablet'  => (bool)$tablet
        ]);
        SugarTargetRange::insert([
            'user_id' => $user->id,
            'min_glu' => 3.9,
            'max_glu' => 8.9,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        if ( $this->createNewWordPressUser($data) ) {
            session()->put('user_new', $data);
        }
        return $user;
    }

    /**
     * The user has been registered.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed  $user
     * @return mixed
     */
    protected function registered(Request $request, $user)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
        if ( $this->createNewWordPressUser($data) ) {
            return $this->goToAuthWpPage($data);
        }
    }
}
