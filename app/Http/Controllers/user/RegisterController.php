<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{

    public function index()
    {
        return view('anbar.user.register'); // показывает вид
    }

    public function store(Request $request)
    {
        $rule = [ // правила для валидации
            'name' => 'required', // обязательное поле
            'email' => 'required|email|unique:users', // обязательное поле, должен быть эмайл, проверка на уникальность
            'anbar_id' => 'required', // обязательное поле
            'user_name' => 'required|min:6|unique:users', // обязательное поле, мин 6 символов, проверка на уникальность
            'password' => 'required|confirmed|min:8',]; // обязательное поле, повторение пароля, мин 8 символов
        $messages = ['password.confirmed' => 'Password is incorrect']; // сообщения выводящиеся при нарушении правила
        Validator::make($request->all(),$rule, $messages)->validate(); // использует валидацию 1 какие данные используются, 2 какие правила используются, 3 сообщения при нарушении правил
            if (User::query()->where('anbar_id',$request->input('anbar_id'))->count() == 0){ // условие на существования анбар страницы
                $admin = 1;
                $accept = 0;
            }
            else{ $admin = 0; $accept = 1;}
        $user = User::query()->create([ // добавляет в базу данных данные зарегестрированного пользователя
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'user_name' => $request->input('user_name'),
            'anbar_id' => $request->input('anbar_id'),
            'password' => Hash::make($request->input('password')),
            'admin_id' => $admin,
            'accept' => $accept,
        ]);
        session(['Mail'=> $request->input('email'), 'Anbar_id' => $request->input('anbar_id')]); // сохраняет мэйл в сессию чтобы в дальнейшем его использовать как определитель пользователя
        if ($admin === 1) // условие на то что пользователь является админом
        {
            Auth::login($user); // автоматически авторизует пользователя если он админ
        }
        return redirect()->route('login.create',); // перенаправляет на главную страницу при удачной регистрации
    }
}
