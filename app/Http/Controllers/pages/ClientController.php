<?php

namespace App\Http\Controllers\pages;

use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\Product;
use Couchbase\Role;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ClientController extends Controller
{
    public function create()
    {

        $clients = Client::query()->where('anbar_id',session('Anbar_id'))->get(); // берет все даннные из базы данных таблицы клиентов с определенным anbar_id
        return view('anbar.pages.clients.clients',compact('clients')); // открывает вид с некоторыми данными
    }
    public function store(Request $request)
    {
            $this->validate($request,[ // проверка на добавление нового клиента в базу данных
            'name' => 'required|unique:clients', // обязательное поле, проверка на уникальность
            'telephone' => 'required|integer|unique:clients', // обязательное поле, только цифры, проверка на уникальность
            'email' => 'required|email|unique:clients', // обязательное поле, должен быть эмайл, проверка на уникальность
            'company' => 'required', // обязательное поле
        ]);
        $client = Client::query()->create([ // добавление данных клиента в базу данных
            'name' => $request->input('name'),
            'telephone' => $request->input('telephone'),
            'email' => $request->input('email'),
            'company' => $request->input('company'),
            'anbar_id' => session('Anbar_id'),
        ]);
        if ($client == true) // условие при добавление клиента в базу
        {
            session()->flash('success','Client has been added successfully'); // создает сессию на один запрос с подтверждением действия
        }
        return redirect()->back(); // возвращает на предыдущую страницу
    }

    public function edit($id)
    {
        $client1 = Client::query()->where('anbar_id',session('Anbar_id'))->find($id); // берет данные с определенным id из базы данных таблицы клиентов
        $clients = Client::query()->where('anbar_id',session('Anbar_id'))->get(); // берет все данные из базы данных таблицы клиентов с определенным anbar_id
        return view('anbar.pages.clients.edit',compact('client1','clients','id'));  // открывает вид с некоторыми данными
    }

    public function update(Request $request, $id)
    {
        $client = Client::query()->where('anbar_id',session('Anbar_id'))->find($id);  // берет данные с определенным id из базы данных таблицы клиентов
        $this->validate($request,[ // проверка на редактирование клиента в базе данных
            'name' => ['required', Rule::unique('clients')->ignore($client)], // обязательное поле, проверка на уникальность кроме себя самого
            'telephone' => ['required','integer', Rule::unique('clients')->ignore($client)], // обязательное поле, только цифры, проверка на уникальность кроме себя самого
            'email' =>['required','email', Rule::unique('clients')->ignore($client)], // обязательное поле, должен быть эмайл, проверка на уникальность кроме себя самого
            'company' => 'required', // обязательное поле
        ]);
        $client = Client::query()->where('anbar_id',session('Anbar_id'))->where('id',$id)->update([ // редактирование данных клиента с определенным id
            'name' => $request->input('name'),
            'telephone' => $request->input('telephone'),
            'email' => $request->input('email'),
            'company' => $request->input('company'),
        ]);
        if ($client == true) // условие при правильном редактировании клиента в базу данных
        {
            session()->flash('success','Client has been updated successfully'); // создает сессию на один запрос с подтверждением действия
        }
        return redirect()->route('client.create'); // перенос на другую страницу
    }

    public function destroy($id)
    {
        if ($id == 'delete'){ // из-за того удаление проходит через Ajax было добавлено условие для обновления страницы
            session()->flash('success', 'Client has been deleted successfully'); // создает сессию на один запрос с подтверждением действия
            return redirect()->route('client.create'); // перенос на другую страницу
        }
        else {
            Client::query()->where('anbar_id', session('Anbar_id'))->where('id', $id)->delete(); // удаляет клиента с определенным id
            session()->flash('success', 'Client has been deleted successfully'); // создает сессию на один запрос с подтверждением действия
        }
    }
}
