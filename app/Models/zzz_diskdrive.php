<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class zzz_diskdrive extends Model
{
    use HasFactory;

    protected $fillable = [
        'zzz_char_id',
        'name',
        'detail_2pc',
        'detail_4pc'
    ];

    public function zzz_char()
    {
        return $this->belongsTo(zzz_char::class, 'zzz_char_id');
    }
    
    // Alias for consistent naming
    public function zzzChar()
    {
        return $this->zzz_char();
    }
}