<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class zzz_bestdiskdrivestat extends Model
{
    use HasFactory;

    protected $fillable = [
        'characters_id',
        'disk_number',
        'substats',
        'endgame_stats'
    ];

    public function zzz_char()
    {
        return $this->belongsTo(zzz_char::class, 'characters_id');
    }
}