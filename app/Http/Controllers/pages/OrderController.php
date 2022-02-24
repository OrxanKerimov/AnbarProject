<?php

namespace App\Http\Controllers\pages;

use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use MongoDB\Driver\Session;

class OrderController extends Controller
{
    public function create()
    {

        $r1 = Order::query()->where('anbar_id',session('Anbar_id'))->select('id')->count(); // подсчет кол-ва строк данных в базе данных таблицы заказов с определенными параметрами
        $r2 = Order::query()->where('anbar_id',session('Anbar_id'))->where('confirmation',1); // берет все данные в базе данных таблицы заказов с confirmation = 1
        $r3 = Order::query()->where('anbar_id',session('Anbar_id'))->where('confirmation',0); // берет все данные в базе данных таблицы заказов с confirmation = 0
        $amount = 0; // новая переменная проданного количества товара
        foreach ($r2->get() as $s2) // цикл для распределения данных из базы данных
        {
            $amount = $s2->amount+$amount; // общее количество проданного товара
        }
        $profit = 0; // новая переменная подтвержденного заказа
        $profit1 = 0; // новая переменная неподтвержденного заказа
        foreach ($r2->get() as $s2) // цикл для распределения данных из базы данных
        {
            $profit = ($s2->product->sell )*$s2->amount + $profit; // общий заработок проданного заказа
        }
        foreach ($r3->get() as $s3) // цикл для распределения данных из базы данных
        {
            $profit1 = ($s3->product->sell)*$s3->amount + $profit1; // общий зароботок заказа в ожидании
        }
        $orders = Order::query()->where('anbar_id',session('Anbar_id'))->get(); // берет все данные из базы данных таблицы заказов с определенным anbar_id
        $clients = Client::query()->where('anbar_id',session('Anbar_id'))->get(); // берет все данные из базы данных таблицы клиентов с определенным anbar_id
        $products = Product::query()->where('anbar_id',session('Anbar_id'))->get(); // берет все данные из базы данных таблицы товаров с определенным anbar_id
        return view('anbar.pages.orders.order', compact('products','clients','orders','r1','r2','r3','amount','profit','profit1')); // открывает вид с некоторыми данными

    }
    public function store(Request $request)
    {
        $products = Product::query()->where('anbar_id',session('Anbar_id'))->where('id',$request->input('product_id')); // берет данные с определенным id из базы данных таблицы товаров
        $this->validate($request,[ // проверка на добавление нового заказа в базу данных
            'client_id' => 'required', // обязательное поле
            'product_id' => 'required', // обязательное поле
            'amount' => 'required|integer', // обязательное поле, только цифры
        ]);
        if ($products->value('amount') >= $request->input('amount')) { // условие если кол-во товара в заказе больше чем в анбаре то выдаст ошибку
            $order = Order::query()->create([ // добавление данных заказа в базу данных
                'product_id' => $request->input('product_id'),
                'client_id' => $request->input('client_id'),
                'amount' => $request->input('amount'),
                'anbar_id' => session('Anbar_id'),
            ]);
            if ($order == true) // условие при добавление заказа в базу
            {
                session()->flash('success','Order has been added successfully'); // создает сессию на один запрос с подтверждением действия
            }
        }else{
            session()->flash('error','The total quantity of the product is less than what is written in the order'); // создает сессию на один запрос с ошибкой действия
        }
        return redirect()->back(); // возвращает предыдущую страницу
    }

    public function edit($id)
    {
        $orders = Order::query()->where('anbar_id',session('Anbar_id'))->get(); // берет все данные из базы данных таблицы заказов с определенным anbar_id
        $clients = Client::query()->where('anbar_id',session('Anbar_id'))->get(); // берет все данные из базы данных таблицы клиентов с определенным anbar_id
        $products = Product::query()->where('anbar_id',session('Anbar_id'))->get(); // берет все данные из базы данных таблицы товаров с определенным anbar_id
        $order1 = Order::query()->where('anbar_id',session('Anbar_id'))->find($id); // берет данные с определенным id из базы данных таблицы заказов
        return view('anbar.pages.orders.edit', compact('products','clients','orders','order1')); // открывает вид с некоторыми данными
    }

    public function update(Request $request, $id)
    {
        $products = Product::query()->where('anbar_id',session('Anbar_id'))->where('id',$request->input('product_id')); // берет данные с определенным id из базы данных таблицы товаров
        $this->validate($request,[ // проверка на редактирование заказа в базе данных
            'client_id' => 'required', // обязательное поле
            'product_id' => 'required', // обязательное поле
            'amount' => 'required|integer', // обязательное поле, только цифры
        ]);
        if ($products->value('amount') >= $request->input('amount')) { // условие если кол-во товара в заказе больше чем в анбаре то выдаст ошибку
            $order = Order::query()->where('anbar_id',session('Anbar_id'))->where('id',$id)->update([ // редактирование данных заказов с определенным id
                'client_id' => $request->input('client_id'),
                'product_id' => $request->input('product_id'),
                'amount' => $request->input('amount'),
            ]);
            if ($order == true) // условие при правильном редактировании заказа в базу
            {
                session()->flash('success','Order has been updated successfully'); // создает сессию на один запрос с подтверждением действия
            }
        }else{
            session()->flash('error','The total quantity of the product is less than what is written in the order'); // создает сессию на один запрос с подтверждением действия
        }
        return redirect()->route('order.create'); // перенос на другую страницу

    }

    public function destroy($id)
    {
        if ($id == 'delete'){ // из-за того удаление проходит через Ajax было добавлено условие для обновления страницы
            session()->flash('success', 'Order has been deleted successfully'); // создает сессию на один запрос с подтверждением действия
            return redirect()->route('order.create'); // перенос на другую страницу
        }
        else {
            Order::query()->where('anbar_id', session('Anbar_id'))->where('id', $id)->delete(); // удаляет заказ с определенным id
            session()->flash('success', 'Order has been deleted successfully'); // создает сессию на один запрос с подтверждением действия
        }
    }

    public function confirmation($id)
    {   $order = Order::query()->where('anbar_id',session('Anbar_id'))->where('id',$id); // берет данные с определенным id из базы данных таблицы заказов
        $product = Product::query()->where('anbar_id',session('Anbar_id'))->where('id',$order->value('product_id')); // берет данные с определенным id из базы данных таблицы товаров
        if ($product->value('amount') >= $order->value('amount')) { // условие если кол-во товара в заказе больше чем в анбаре то выдаст ошибку
            $amount = $product->value('amount') - $order->value('amount'); // отнимает кол-во заказа товара от общего кол-ва товара
        $product = Product::query()->where('anbar_id',session('Anbar_id'))->where('id',$order->value('product_id'))->update(['amount' => $amount ]); // при подтвеждения заказа изменяет общее кол-во продукта
        $order = Order::query()->where('anbar_id',session('Anbar_id'))->where('id',$id)->update([ // изменяет подтверждение заказа на положительный
            'confirmation' => 1,
        ]);
        if ($order == true) // условие при правильном редактировании заказа в базу данных
        {
            session()->flash('success','Order has been confirmed'); // создает сессию на один запрос с подтверждением действия
            return redirect()->back(); // перенос на предыдущую страницу
        }}else{ // если выйдет ошибка с кол-вом товара выйдет это
            session()->flash('error', 'Insufficient amount of product in the anbar.'); // создает сессию на один запрос с при ошибки действия
            return redirect()->back(); // перенос на предыдущую страницу
            }
    }
    public function cancellation($id)
    {
        $order = Order::query()->where('anbar_id',session('Anbar_id'))->where('id',$id); // берет данные с определенным id из базы данных таблицы заказов
        $product = Product::query()->where('anbar_id',session('Anbar_id'))->where('id',$order->value('product_id')); // берет данные с определенным id из базы данных таблицы товаров
            $amount = $product->value('amount') + $order->value('amount'); // прибавляет кол-во заказа товара к  общему кол-ву товара
            $product = Product::query()->where('anbar_id', session('Anbar_id'))->where('id', $order->value('product_id'))->update(['amount' => $amount]); // при отмене заказа изменяет общее кол-во продукта
            $order = Order::query()->where('anbar_id', session('Anbar_id'))->where('id', $id)->update([ // изменяет подтверждение заказа на 0
                'confirmation' => 0,
            ]);
            if ($order == true) { // условие при правильном редактировании клиента в базу данных
                session()->flash('error', 'Order has been canceled'); // создает сессию на один запрос с подтверждением действия
                return redirect()->back(); // перенос на предыдущую страницу
            }

    }
}
