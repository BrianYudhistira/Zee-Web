<?php

namespace App\Models\zzz_scraper;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class zzz_diskdrivestat extends Model
{
    use HasFactory;

    protected $fillable = [
        'zzz_char_id',
        'disk_number',
        'substats',
        'endgame_stats'
    ];

    public function zzz_char()
    {
        return $this->belongsTo(zzz_char::class, 'zzz_char_id');
    }
    
    public function zzzChar()
    {
        return $this->zzz_char();
    }
}