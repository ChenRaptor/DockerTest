<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

use App\Models\User;
use App\Models\Team;

class Password extends Model
{
    use HasFactory;

    protected $fillable = [
        'site',
        'login',
        'password',
        'user_id',
        'id'
    ];

    protected $casts = [
        'password' => 'encrypted',
    ];
    /**
     * Relations avec User
     */
    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function teams() : BelongsToMany
    {
        return $this->belongsToMany(Team::class);
    }
}