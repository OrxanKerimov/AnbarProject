<?php

namespace App\Http\Controllers\pages;

use App\Http\Controllers\Controller;
use App\Models\Brands;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class BrandController extends Controller
{

    public function create(Request $request)
    {
        $anbarId = $request->get('anbar_id');
        $branda = Brands::query()->where('anbar_id',session('Anbar_id')); // берет все из данные базы данных таблицы брендов для определенного анбара
        $brands = Brands::query()->where('anbar_id',session('Anbar_id'))->get(); // берет все данные из базы данных таблицы брендов для определенного анбара
        return view('anbar.pages.brands.brands',compact('brands','branda')); // возвращает вид страницы брендов с определенными параметрами
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'brand_name' => 'required|unique:Brands', // обязательное поле, должен быть уникальным
            'brand_photo' => 'required|image', // обязательное поле, файл должен содержать тип фото
        ]); // проверка на соответствие требованиям отправленных данных
        $folder = date('Y-m-d');
        $photo = $request->file('brand_photo')->store("images/{$folder}",'public'); // фото перемешает в заданную папку
        $brand=Brands::query()->create([ // добавление данных бренда в базу данных
            'brand_name'=>$request->input('brand_name'),
            'photo'=>$photo,
            'anbar_id'=>session('Anbar_id'),
        ]);
        if ($brand == true){ // условие при добавление бренда в базу
            session()->flash('success','Brand has been added successfully'); // создает сессию на один запрос с подтверждением действия
        }
        return redirect()->back(); // возвращает на предыдущую страницу

    }

    public function edit($id)
    {   $branda = Brands::query()->where('anbar_id',session('Anbar_id'))->get(); // берет все данные из базы данных таблицы брендов для определенного анбара
        $brands = Brands::query()->where('anbar_id',session('Anbar_id'))->where('id', $id); // берет данные из базы данных с определенным id из таблицы брендов для определенного анбара
        return view("anbar.pages.brands.edit", compact('id','brands','branda')); // возвращает вид страницы редактирования брендов с определенными параметрами
    }
    public function update(Request $request, $id)
    {
        $brands = Brands::query()->where('anbar_id',session('Anbar_id'))->find($id); // берет данные с определенным id из базы данных
        if (!empty($request->brand_photo)) // условие на проверку пустоты в файле для фото
        {
                $this->validate($request, [ // проверка данных на редактироваие определенного бренда
                    'brand_name' => ['required',Rule::unique('brands')->ignore($brands)], // обязательное поле, проверка на уникальность кроме себя самого
                    'brand_photo' => 'required|image', // обязательное поле, файл должен содержать тип фото
                ]);

            $folder = date('Y-m-d');
            $photo = $request->file('brand_photo')->store("images/{$folder}",'public'); // перенос файла с фото в другое место
            Brands::query()->where('anbar_id',session('Anbar_id'))->where('id',$id)->update([ // редактирование данных бренда с определенным id
                'brand_name' => $request->input('brand_name'),
                'photo' => $photo,
                ]);
            session()->flash('success','Brand has been updated successfully'); // создание сессии на один запрос с подтверждением действия
            return redirect()->route('brand.create'); // перенос на другую страницу
        }else // если фото нет
        {
            $this->validate($request, [ // проверка данных на редактироваие определенного бренда
                'brand_name' => ['required',Rule::unique('brands')->ignore($brands)], // обязательное поле, проверка на уникальность кроме себя самого
            ]);
            $brand = Brands::query()->where('anbar_id',session('Anbar_id'))->where('id',$id); // берет данные м определенным id из базы данных
            $brand->update(['brand_name' => $request->input('brand_name')]); // редактирование данных бренда с определенным id
            session()->flash('success','Brand has been updated successfully');  // создание сессии на один запрос с подтверждением действия
            return redirect()->route('brand.create');  // перенос на другую страницу
        }


    }

    public function destroy($id)
    {
        if ($id == 'delete'){ // из-за того удаление проходит через Ajax было добавлено условие для обновления страницы
            session()->flash('success', 'Brand has been deleted successfully'); // создание сессии на один запрос с подтверждением действия
            return redirect()->route('brand.create'); // перенос на другую страницу
        }
        else {
            Brands::query()->where('id', $id)->where('anbar_id', session('Anbar_id'))->delete(); // удаление определенного бренда
            session()->flash('success', 'Brand has been deleted successfully'); // создание сессии на один запрос с подтверждением действия
        }
    }
}
