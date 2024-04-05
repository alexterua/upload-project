<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /** @var array<int, string> */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**  @var array<int, string> */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /** @return HasMany */
    public function files(): HasMany
    {
        return $this->hasMany(File::class, 'user_id', 'id');
    }

    /** @var array<string, string> */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /** @return int */
    public function getId(): int
    {
        return $this->id;
    }

}
