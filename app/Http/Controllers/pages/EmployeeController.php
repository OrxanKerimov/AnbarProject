<?php

namespace App\Http\Controllers\pages;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class EmployeeController extends Controller
{

    public function create()
    {
        $employees = User::query()->where('anbar_id',session('Anbar_id'))->get(); // берет все даннные из базы данных таблицы сотрудников с определенным anbar_id
        return view('anbar.pages.employees.employees', compact('employees') ); // открывает вид с некоторыми данными
    }

    public function store(Request $request)
    {
        $this->validate($request,[ // проверка на добавление нового сотрудника в базу данных
            'name' => 'required', //обязательное поле
            'email' => 'required|email|unique:users', // обязательное поле, должен быть эмайл, проверка на уникальность
            'user_name' => 'required|min:6|unique:users', // обязательное поле, мин 6 символов, проверка на уникальность
            'telephone' => 'required|integer|unique:users', // обязательное поле, только цифры, проверка на уникальность
            'password' => 'required|confirmed|min:8', // обязательное поле, повторение пароля, мин 8 символов
        ]);
        $employee = User::query()->create([ // добавление данных сотрудника в базу данных
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'user_name' => $request->input('user_name'),
            'telephone' => $request->input('telephone'),
            'anbar_id' => session('Anbar_id'),
            'password' => Hash::make($request->input('password')),
        ]);
        if ($employee == true){ // условие при добавление сотрудника в базу
            session()->flash('success','Employee has been added successfully'); // создает сессию на один запрос с подтверждением действия
        }
        return redirect()->back(); // возвращает на предыдущую страницу
    }
    public function edit($id)
    {
        $employee1 = User::query()->where('anbar_id',session('Anbar_id'))->find($id); // берет данные с определенным id из базы данных таблицы сотрудников
        $employees = User::query()->where('anbar_id',session('Anbar_id'))->where('accept',0)->where('block',0)->get(); // берет все данные из базы данных таблицы сотрудников с определенным anbar_id
        return view('anbar.pages.employees.edit', compact('employees','employee1','id')); // открывает вид с некоторыми данными
    }

    public function update(Request $request, $id)
    {
        $employee = User::query()->where('anbar_id',session('Anbar_id'))->find($id); // берет данные с определенным id из базы данных таблицы сотрудников
        $this->validate($request,[ // проверка на редактирование сотрудника в базе данных
            'name' => 'required', // обязательное поле
            'email' => ['required','email',Rule::unique('users')->ignore($employee)], // обязательное поле, должен быть эмайл, проверка на уникальность кроме себя самого
            'user_name' => ['required', Rule::unique('users')->ignore($employee)], // обязательное поле, проверка на уникальность кроме себя самого
            'telephone' => ['required', 'integer', Rule::unique('users')->ignore($employee)], // обязательное поле, только цифры, проверка на уникальность кроме себя самого
        ]);
        $employee = User::query()->where('anbar_id',session('Anbar_id'))->where('id',$id)->update([ // редактирование данных сотрудника с определенным id
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'user_name' => $request->input('user_name'),
            'telephone' => $request->input('telephone'),
        ]);
        if ($employee == true){ // условие при правильном редактировании сотрудника в базу
            session()->flash('success','Employee has been updated successfully'); // создает сессию на один запрос с подтверждением действия
        }
        return redirect()->route('employee.create'); // перенос на другую страницу
    }

    public function destroy($id)
    {
        if ($id == 'delete'){ // из-за того удаление проходит через Ajax было добавлено условие для обновления страницы
            session()->flash('success','Employee has been deleted successfully.'); // создает сессию на один запрос с подтверждением действия
            return redirect()->route('employee.create'); // перенос на другую страницу
        }else{
            User::query()->where('anbar_id', session('Anbar_id'))->where('id',$id)->delete(); // удаляет сотрудника с определенным id
            session()->flash('success','Employee has been deleted successfully'); // создает сессию на один запрос с подтверждением действия
        }
    }

    public function accept($id){
        $employee = User::query()->where('id',$id)->where('anbar_id',session('Anbar_id'))->update([ // дает доступ сотруднику к анбар странице
            'accept' => 0,
        ]);
        if ($employee == true) // условие при предоставлении доступа сотруднику к анбар странице
        {
            session()->flash('success','Account has been verified'); // создает сессию на один запрос с подтверждением действия
        }
        return redirect()->back(); // возращает на предыдущую страницу
    }

    public function block($id){
        $employee = User::query()->where('id',$id)->where('anbar_id',session('Anbar_id'))->update([ // блокирует сотрудника чтобы больше не было доступа к анбар странице
           'block' => 1,
        ]);
        if ($employee == true) // условие при блокировке сотрудника к анбар странице
        {
            session()->flash('success','Account has been block'); // создает сессию на один запрос с подтверждением действия
        }
        return redirect()->back(); // возвращает на предыдущую страницу
    }

    public function unlock($id){
        $employee = User::query()->where('id',$id)->where('anbar_id',session('Anbar_id'))->update([ // разблокирует сотрудника чтобы снова предоставить доступ к анбар странице
            'block' => 0,
        ]);
        if ($employee == true) // условие при разблокировке сотрудника к анбар страницеи
        {
            session()->flash('success','Employee has been unlock'); // создает сессию на один запрос с подтверждением действия
        }
        return redirect()->back(); // возвращает на предыдущую страницу
    }
}
