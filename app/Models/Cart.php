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
        $this->hasOne( Card::class, 'card_id');
    }

    public function user()
    {
        $this->hasOne( User::class, 'user_id');
    }
}
