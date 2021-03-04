<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class cardState extends Model
{
    use HasFactory;

    protected $table = 'card_states';

    public function card()
    {
        $this->belongsTo(Card::class, 'card_states_id');
    }
}
