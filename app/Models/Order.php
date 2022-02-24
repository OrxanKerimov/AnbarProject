<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['product_id','client_id','amount','confirmation','anbar_id']; // дает допуск для изменения данных
    use HasFactory;

    public function product()
    {
        return $this->belongsTo(Product::class); // зараждается связь между товаром и заказом с помощью product_id
    }

    public function client()
    {
        return $this->belongsTo(Client::class); // зараждается связь между клиентом и заказом с помощью client_id
    }
}
