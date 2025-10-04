<?php

namespace App\Models\zzz_scraper;

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
        'type',
        'old_image'
    ];

    public function zzz_diskdrive()
    {
        return $this->hasMany(zzz_diskdrive::class, 'zzz_char_id');
    }

    public function zzz_wengine()
    {
        return $this->hasMany(zzz_wengine::class, 'zzz_char_id');
    }

    public function zzz_diskdrivestat()
    {
        return $this->hasMany(zzz_diskdrivestat::class, 'zzz_char_id');
    }

    public function zzz_bestsubstat()
    {
        return $this->hasMany(zzz_bestsubstat::class, 'zzz_char_id');
    }

}