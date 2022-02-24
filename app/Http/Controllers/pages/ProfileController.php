<?php

namespace App\Http\Controllers\pages;

use App\Http\Controllers\Controller;
use App\Models\Brands;
use App\Models\Client;
use App\Models\Cost;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class ProfileController extends Controller
{

    public function index()
    {
        $profile = User::query()->where('anbar_id',session('Anbar_id'))->where('email',session('Mail')); // берет данные с определенным эмайлом и отпределенным anbar_id
        return view('anbar.pages.profile.profile',compact('profile')); // открывает вид с некоторыми данными
    }

    public function edit()
    {
        $profile = User::query()->where('anbar_id',session('Anbar_id'))->where('email',session('Mail')); // берет данные с определенным эмайлом и отпределенным anbar_id
        $id = $profile->value('id'); // берет из базы данных id
        return view('anbar.pages.profile.edit',compact('profile','id')); // открывает вид с некоторыми данными

    }

    public function update(Request $request,$id)
    {
        $profile = User::query()->where('anbar_id', session('Anbar_id'))->find($id); // берет данные с определенным id из базы данных таблицы пользователей
        $this->validate($request, [ // проверка на редактирование пользователя в базе данных
            'name' => ['required', Rule::unique('users')->ignore($profile)], // обязательное поле, проверка на уникальность кроме себя самого
            'email' => ['required', 'email', Rule::unique('users')->ignore($profile)], // обязательное поле, должен быть эмайл, проверка на уникальность кроме себя самого
            'user_name' => ['required', 'min:8', Rule::unique('users')->ignore($profile)], // обязательное поле, мин 8 символов, проверка на уникальность кроме себя самого
            'telephone' => ['required', 'integer', Rule::unique('users')->ignore($profile)], // обязательное поле, только цифры, проверка на уникальность кроме себя самого
        ]);
        $user = User::query()->where('anbar_id', session('Anbar_id'))->where('id', $id)->update([ // редактирование данных пользователя с определенным id
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'user_name' => $request->input('user_name'),
            'telephone' => $request->input('telephone'),
        ]);
        if ($user == true) { // условие при правильном редактировании пользователя в базе данных
            session()->flash('success', 'Your profile has been updated successfully'); // создает сессию на один запрос с подтверждением действия
        }
        return redirect()->route('profile.index'); // перенос на другую страницу
    }

    public function updatep(Request $request)
    {
        $messages = ['password.confirmed' => 'Password is incorrect']; // сообщение для валидации
        $this->validate($request,[ // проверка на редактирование пароля в базе данных
            'password' => 'required|confirmed|min:8', // обязательное поле, повторный пароль, мин 8 символов
        ],$messages);
        $user = User::query()->where('anbar_id',session('Anbar_id'))->where('email',session('Mail'))->update([ // редактирование данных пароля пользователя с определенным id
            'password' => Hash::make($request->input('password')),
        ]);
        if ($user == true){ // условие при правильном редактировании пользователя в базе данных
            session()->flash('success','Your account password has been updated successfully.'); // создает сессию на один запрос с подтверждением действия
        }
        return redirect()->route('profile.index'); // перенос на другую страницу
    }

    public function destroy()
    {   if (User::query()->where('email',session('Mail'))->value('admin_id') == 1) // удалит все анбар страницу если пользователь будет админом при удалении
    {
        Order::query()->where('anbar_id',session('Anbar_id'))->delete(); // очистит таблицу заказов с определенным anbar_id
        Client::query()->where('anbar_id',session('Anbar_id'))->delete(); // очистит таблицу клиентов с определенным anbar_id
        Product::query()->where('anbar_id',session('Anbar_id'))->delete(); // очистит таблицу товаров с определенным anbar_id
        Brands::query()->where('anbar_id',session('Anbar_id'))->delete(); // очистит таблицу брендов с определенным anbar_id
        Cost::query()->where('anbar_id',session('Anbar_id'))->delete(); // очистит таблицу доп затрат с определенным anbar_id
        User::query()->where('anbar_id',session('Anbar_id'))->delete(); // очистит таблицу пользователей с определенным anbar_id
        session()->flush(); // очистит все сессии
        session()->flash('success','You have successfully deleted the anbar page with all data'); // создает сессию на один запрос с подтверждением действия
    }else{
        User::query()->where('anbar_id',session('Anbar_id'))->where('email',session('Mail'))->delete(); // удалит пользователя с определенным id
        session()->flush(); // очистит все сессии
        session()->flash('success','Your account has been successfully deleted'); // создает сессию на один запрос с подтверждением действия
    }

        return redirect()->route('login.create'); // перенос на другую страницу
    }
}
