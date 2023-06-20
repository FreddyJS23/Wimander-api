<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'user',
        'email',
        'password',
        'active',
    ];


    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

/**
 * Get the connection associated with the User
 *
 * @return \Illuminate\Database\Eloquent\Relations\HasOne
 */
public function connection(): HasOne
{
    return $this->hasOne(Connection::class);
}

/**
 * Get the customer associated with the User
 *
 * @return \Illuminate\Database\Eloquent\Relations\HasOne
 */
public function customer(): HasOne
{
    return $this->hasOne(Customer::class);
}


}
