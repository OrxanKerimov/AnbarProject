<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = ['name','photo','amount','buy','sell','brand_id','anbar_id']; // дает допуск для изменения данных

    public function brand()
    {
        return $this->belongsTo(Brands::class); // зараждается связь между брендом и продуктом с помощью brand_id
    }

    public function order()
    {
        return $this->hasMany(Task::class); // зараждается связь между товаром и заказом с помощью product_id
    }
}
