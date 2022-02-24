<?php

namespace App\Http\Controllers\pages;

use App\Http\Controllers\Controller;
use App\Models\Brands;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function create()
    {
        $brands = Brands::query()->where('anbar_id',session('Anbar_id'))->get(); // берет все даннные из базы данных таблицы брендов с определенным anbar_id
        $products = Product::query()->where('anbar_id',session('Anbar_id'))->get(); // берет все даннные из базы данных таблицы товаров с определенным anbar_id
        return view('anbar.pages.products.products', compact('brands','products')); // открывает вид с некоторыми данными
    }

    public function store(Request $request)
    {
        $this->validate($request,[ // проверка на добавление нового товара в базу данных
            'brand_id' => 'required', // обязательное поле
            'product_name' => 'required', //обязательное поле
            'product_photo' => 'required|image', // обязательное поле, файл должен содержать тип фото
            'amount' => 'required|integer', // обязательное поле, только цифры
            'buy' => 'required|integer', // обязательное поле, только цифры
            'sell' => 'required|integer', // обязательное поле, только цифры
        ]);
        $folder = date('Y-m-d');
        $photo = $request->file('product_photo')->store("images/{$folder}",'public'); // фото перемешает в заданную папку
        $product = Product::query()->create([ // добавление данных товара в базу данных
            'name' => $request->input('product_name'),
            'photo' => $photo,
            'amount' => $request->input('amount'),
            'buy' => $request->input('buy'),
            'sell' => $request->input('sell'),
            'brand_id' => $request->input('brand_id'),
            'anbar_id' => session('Anbar_id'),
        ]);
        if ($product == true) // условие при добавление товара в базу
        {
            session()->flash('success','Product has been added successfully'); // создает сессию на один запрос с подтверждением действия
        }
        return redirect()->back(); // возвращает на предыдущую страницу
    }

    public function edit($id)
    {
        $product1 = Product::query()->where('anbar_id',session('Anbar_id'))->find($id); // берет данные с определенным id из базы данных таблицы товара
        $brands = Brands::query()->where('anbar_id',session('Anbar_id'))->get(); // берет все данные из базы данных таблицы брендов с определенным anbar_id
        $products = Product::query()->where('anbar_id',session('Anbar_id'))->get(); // берет все данные из базы данных таблицы товаров с определенным anbar_id
        return view('anbar.pages.products.edit', compact('brands','products','product1','id')); // открывает вид с некоторыми данными
    }
    public function update(Request $request, $id)
    {
        if (!empty($request->product_photo)) { // условие на существование фото в файле
            $this->validate($request,[ // проверка данных на редактироваие определенного товара
                'brand_id' => 'required', // обязательное поле
                'product_name' => 'required', // обязательное поле
                'product_photo' => 'required|image', // обязательное поле, должен быть эмайл
                'amount' => 'required|integer', // обязательное поле, только цифры
                'buy' => 'required|integer', // обязательное поле, только цифры
                'sell' => 'required|integer', // обязательное поле, только цифры
            ]);
            $folder = date('Y-m-d');
            $photo = $request->file('product_photo')->store("images/{$folder}",'public'); // перенос файла с фото в другое место
            $update = Product::query()->where('id',$id)->where('anbar_id', session('Anbar_id'))->update([ // редактирование данных товара с определенным id
                'name' => $request->input('product_name'),
                'photo' => $photo,
                'amount' => $request->input('amount'),
                'buy' => $request->input('buy'),
                'sell' => $request->input('sell'),
                'brand_id' => $request->input('brand_id'),
            ]);
        }else{ // если фото нет
            $this->validate($request,[ // проверка на добавление нового товара в базу данных
                'brand_id' => 'required', // обязательное поле
                'product_name' => 'required', // обязательное поле
                'amount' => 'required|integer', // обязательное поле, только цифры
                'buy' => 'required|integer', // обязательное поле, только цифры
                'sell' => 'required|integer', // обязательное поле, только цифры
            ]);
            $update = Product::query()->where('id',$id)->where('anbar_id', session('Anbar_id'))->update([ // редактирование данных товара с определенным id
                'name' => $request->input('product_name'),
                'amount' => $request->input('amount'),
                'buy' => $request->input('buy'),
                'sell' => $request->input('sell'),
                'brand_id' => $request->input('brand_id'),
            ]);
        }
        if ($update == true){ // условие при правильном редактировании товара в базу
            session()->flash('success','Product has been updated successfully'); // создает сессию на один запрос с подтверждением действия
            return redirect()->route('product.create'); // перенос на другую страницу
        }
    }

    public function destroy($id)
    {
        if ($id == 'delete'){ // из-за того удаление проходит через Ajax было добавлено условие для обновления страницы
            session()->flash('success', 'Product has been deleted successfully'); // создает сессию на один запрос с подтверждением действия
            return redirect()->route('product.create'); // перенос на другую страницу
        }
        else {
            Product::query()->where('anbar_id', session('Anbar_id'))->where('id', $id)->delete(); // удаляет товар с определенным id
            session()->flash('success', 'Product has been deleted successfully'); // создает сессию на один запрос с подтверждением действия
        }
    }
}
