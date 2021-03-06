<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $table = 'carts';

    public function card()
    {
        return $this->hasOne( Card::class, 'id', 'card_id');
    }


    public function user()
    {
        return $this->hasOne( User::class, 'id', 'user_id');
    }
}
