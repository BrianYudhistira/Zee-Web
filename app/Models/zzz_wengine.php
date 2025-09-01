<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class zzz_wengine extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'zzz_char_id',
        'build_name',
        'w_engine_picture',
        'detail'
    ];

    public function zzz_char()
    {
        return $this->belongsTo(zzz_char::class, 'zzz_char_id');
    }
}