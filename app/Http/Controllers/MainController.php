<?php

namespace App\Http\Controllers;

use App\Models\Brands;
use App\Models\Client;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function index()
    {
        $brands = Brands::query()->where('anbar_id', session('Anbar_id'))->get(); // берет все даннные из базы данных таблицы брендов с определенным anbar_id
        $clients = Client::query()->where('anbar_id',session('Anbar_id'))->get(); // берет все даннные из базы данных таблицы клиентов с определенным anbar_id
        $orders = Order::query()->where('anbar_id',session('Anbar_id'))->get(); // берет все даннные из базы данных таблицы заказы с определенным anbar_id
        $products = Product::query()->where('anbar_id',session('Anbar_id'))->get(); // берет все даннные из базы данных таблицы товаров с определенным anbar_id
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
            $profit = ($s2->product->sell)*$s2->amount + $profit; // общий заработок проданного заказа
        }
        foreach ($r3->get() as $s3) // цикл для распределения данных из базы данных
        {
            $profit1 = ($s3->product->sell)*$s3->amount + $profit1; // общий зароботок заказа в ожидании
        }
        return view('anbar.index', compact('brands','clients','products','orders','r1','r2','r3','amount','profit','profit1')); // открывает вид с некоторыми данными
    }
}
