<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Version extends Model
{
    use HasFactory;

    protected $table = 'versions';

    protected $fillable = [
        'name',
        'abbreviation',
        'isActive',
        'imageLink'
    ];

    public function card()
    {
        $this->belongsTo(Card::class, 'version_id');
    }
}
