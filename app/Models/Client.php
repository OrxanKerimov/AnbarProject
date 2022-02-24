<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;
    protected $fillable = ['name','telephone','email','company','anbar_id']; // дает допуск для изменения данных
    public function order()
    {
        return $this->hasMany(Task::class); // зараждается связь между клиентом и заказом с помощью client_id
    }
}
