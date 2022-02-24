<?php

namespace App\Http\Controllers\pages;

use App\Http\Controllers\Controller;
use App\Models\Cost;
use Illuminate\Http\Request;

class CostController extends Controller
{
    public function create()
    {
        $costs = Cost::query()->where('anbar_id',session('Anbar_id'))->get(); // берет все даннные из базы данных таблицы доп затрат с определенным anbar_id
        return view('anbar.pages.costs.cost',compact('costs')); // открывает вид с некоторыми данными
    }

    public function store(Request $request)
    {
        $this->validate($request,[ // проверка на добавление новой затраты в базу данных
            'expenses_name' => 'required', // обязательное поле
            'spend' => 'required', // обязательное поле
        ]);
        $cost = Cost::query()->create([ // добавление данных доп затрат в базу данных
            'expenses' => $request->input('expenses_name'),
            'spend' => $request->input('spend'),
            'anbar_id' => session('Anbar_id'),
        ]);
        if ($cost == true){ // условие при добавление клиента в базу
            session()->flash('success','Additional expenses has been added successfully'); // создает сессию на один запрос с подтверждением действия
        }
        return redirect()->back(); // возвращает на предыдущую страницу
    }

    public function edit($id)
    {
        $cost1 = Cost::query()->where('anbar_id',session('Anbar_id'))->find($id); // берет данные с определенным id из базы данных таблицы доп затрат
        $costs = Cost::query()->where('anbar_id',session('Anbar_id'))->get(); // берет все даннные из базы данных таблицы доп затрат с определенным anbar_id
        return view('anbar.pages.costs.edit',compact('cost1','costs','id')); // открывает вид с некоторыми данными
    }

    public function update(Request $request, $id)
    {
        $this->validate($request,[ // проверка на редактирование доп затраты в базе данных
            'expenses_name' => 'required', // обязательное поле
            'spend' => 'required', // обязательное поле
        ]);
        $cost = Cost::query()->where('anbar_id',session('Anbar_id'))->where('id',$id)->update([ // редактирование данных доп затрат с определенным id
            'expenses' => $request->input('expenses_name'),
            'spend' => $request->input('spend'),
        ]);
        if ($cost == true){ // условие при правильном редактировании доп затраты в базу
            session()->flash('success','Additional expenses has been updated successfully'); // создает сессию на один запрос с подтверждением действия
        }
        return redirect()->route('cost.create'); // перенос на другую страницу
    }

    public function destroy($id)
    {
        if ($id == 'delete'){ // из-за того удаление проходит через Ajax было добавлено условие для обновления страницы
            session()->flash('success', 'Additional expenses has been deleted successfully'); // создает сессию на один запрос с подтверждением действия
            return redirect()->route('cost.create'); // перенос на другую страницу
        }
        else {
            Cost::query()->where('id', $id)->where('anbar_id', session('Anbar_id'))->delete(); // удаляет доп затрат с определенным id
            session()->flash('success', 'Additional expenses has been deleted successfully'); // создает сессию на один запрос с подтверждением действия
        }
    }
}
