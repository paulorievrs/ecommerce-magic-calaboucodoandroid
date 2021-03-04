<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Card extends Model
{
    use HasFactory;

    protected $table = 'cards';

    public function cardState()
    {
        return $this->hasOne( cardState::class, 'id');
    }

    public function version()
    {
        return $this->hasOne( Version::class, 'id');
    }

    public function language()
    {
        return $this->hasOne( Language::class, 'id');
    }

    public function cart()
    {
        return $this->belongsTo( Cart::class, 'id');
    }

}
