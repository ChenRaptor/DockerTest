<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use App\Models\User;
use App\Models\Password;

class Team extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    /**
     * Relations avec Users
     */
    // public function users() : HasMany
    // {
    //     return $this->hasMany(User::class);
    // }


    public function users() : BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }

    
    public function passwords() : BelongsToMany
    {
        return $this->belongsToMany(Password::class);
    }

}