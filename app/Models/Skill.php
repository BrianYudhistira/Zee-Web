<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Skill extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'portfolio_id',
        'name',
        'icon',
    ];

    /**
     * Get the portfolio that owns the skill.
     */
    public function portfolio(): BelongsTo
    {
        return $this->belongsTo(Portfolio::class);
    }
}
