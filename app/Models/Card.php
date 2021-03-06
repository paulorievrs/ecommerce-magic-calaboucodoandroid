<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Card extends Model
{
    use HasFactory;

    protected $table = 'cards';

    protected $fillable = [
        'value',
        'imageLink',
        'name',
        'english_name',

        'quantity',
        'card_states_id',
        'version_id',
        'language_id',
        'type_id',
        'CMC',
        'rarity',
        'colors'
    ];

    public function cardState()
    {
        return $this->hasOne( cardState::class, 'id', 'card_states_id');
    }

    public function version()
    {
        return $this->hasOne( Version::class, 'id', 'version_id');
    }

    public function language()
    {
        return $this->hasOne( Language::class, 'id', 'language_id');
    }

    public function type()
    {
        return $this->hasOne( Type::class, 'id', 'type_id');
    }

    public function cart()
    {
        return $this->belongsTo( Cart::class, 'id');
    }

}
