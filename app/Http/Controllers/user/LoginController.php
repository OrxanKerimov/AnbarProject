<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function loginForm()
    {
        return view('anbar.user.login'); // открывает вид
    }

    public function login(Request $request)
    {
        $user = User::query()->where('user_name','=',$request->input('user_name')); // берет все данные этого пользователя из базы данных
        $request->validate([ // проверка на подтверждение входа в учетную запись
            'user_name' => 'required', // обязательное поле
            'password' => 'required', // обязательное поле
        ]);
        session(['Mail'=> User::query()->where('user_name','=',$request->input('user_name'))->value('email'), 'Anbar_id' => User::query()->where('user_name','=',$request->input('user_name'))->value('anbar_id')]); // создает сессию
        if ($user->value('accept') == 0) { // условие на проверку доступности к анбар странице
            if ($user->value('block') == 0) { // условие проверки на блокировку аккаунта
                if (Auth::attempt([ // условие на авторизацию пользователя
                    'user_name' => $request->input('user_name'),
                    'password' => $request->input('password'),
                ])) {
                    return redirect('main'); // перенаправляет на главную страницу
                } else {
                    return redirect()->back()->with('error', 'Incorrect login or password!');// возвращает на предыдущую страницу с созданием сессии
                }
            }else{
                return redirect()->back()->with('error','Admin blocked your account!'); // возвращает на предыдущую страницу с созданием сессии
            }
        }else{
            return redirect()->back()->with('error', 'Admin has not verified your account yet'); // возвращает на предыдущую страницу с созданием сессии
        }
    }

    public function logout()
    {
        session()->forget('Mail'); // удаляет сессию Майл
        Auth::logout(); // выходит из сессии
        return redirect('/login'); // перенапрвляет на страницу логина
    }

    public function recover(Request $request)
    {
        $user = User::query()->where('email',$request); // берет данные отпределенного пользователя
        if ($user == true) // условия подтверждения существования эмайла в базе данных
        {
            session()->flash('success','An email has been sent to your email address with a link to reset your password'); // создает сессию на один запрос с подтверждением существования эмайла

        }else{ // если эмайла нет
            session()->flash('error','There are no registered accounts on this email'); // создает сессию на один запрос с ошибкой эмайла
        }
    }
}
