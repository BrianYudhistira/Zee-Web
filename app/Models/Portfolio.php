<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Portfolio extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'name',
        'profile_image',
        'insta_link',
        'git_link',
        'linkedin_link',
    ];

    public function user(){
        // This function seems to be misplaced, it should be a relationship method
        // It should return the user associated with this portfolio
        return $this->belongsTo(User::class, 'user_id');
    }

    public function projects()
    {
        return $this->hasMany(Project::class, 'portfolio_id');
    }

    public function skills()
    {
        return $this->hasMany(Skills::class, 'portfolio_id');
    }
}
