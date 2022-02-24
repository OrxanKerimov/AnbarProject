<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brands extends Model
{
    use HasFactory;
    protected $fillable = ['brand_name','photo','updated_at','anbar_id']; // дает допуск для изменения данных

    public function products()
    {
        return $this->hasMany(Product::class); // зараждается связь между брендом и продуктом с помощью brand_id

    }
}
