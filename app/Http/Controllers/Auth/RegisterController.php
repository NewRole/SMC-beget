<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
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
    protected $redirectTo = '/home';

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
        return Validator::make($data, [
            'name' => [
                'required',
                'string',
                'max:255',
                'regex:/^[a-zA-Zа-яА-ЯёЁ0-9_\-\s]+$/u' // Только буквы, цифры, пробелы, дефисы и подчеркивания
            ],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                'unique:users',
                'regex:/^[^<>]+$/' // Запрет символов < и >
            ],
            'password' => [
                'required',
                'string',
                'min:8',
                'confirmed',
                'regex:/^[^<>]+$/'
            ],
        ], [
            'name.regex' => 'Имя содержит запрещенные символы',
            'email.regex' => 'Email содержит запрещенные символы',
            'password.regex' => 'Пароль содержит запрещенные символы'
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */


    protected function create(array $data)
    {
        return User::create([
            'name' => htmlspecialchars(strip_tags($data['name'])), // Двойная защита
            'email' => filter_var($data['email'], FILTER_SANITIZE_EMAIL),
            'password' => Hash::make($data['password']),
        ]);
    }
}
