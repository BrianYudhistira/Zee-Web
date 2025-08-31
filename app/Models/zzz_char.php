<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class zzz_char extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'name',
        'link',
        'image',
        'element',
        'element_picture',
        'tier',
    ];

    public function zzz_diskdrive()
    {
        return $this->hasMany(zzz_diskdrive::class, 'characters_id');
    }

    public function zzz_wengine()
    {
        return $this->hasMany(zzz_wengine::class, 'characters_id');
    }

    public function zzz_bestdiskdrivestat()
    {
        return $this->hasMany(zzz_bestdiskdrivestat::class, 'characters_id');
    }

}