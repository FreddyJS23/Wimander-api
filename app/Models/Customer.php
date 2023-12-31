<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Customer extends Model
{
    use HasFactory;

    protected $fillable=[
        'user_id',
        'name',
        'last_name',
        'mac',
        'phone',
        'locked',
    ];

/**
 * Get the connection associated with the Customer
 *
 * @return \Illuminate\Database\Eloquent\Relations\HasOne
 */
public function connection(): HasOne
{
    return $this->hasOne(Connection::class);
}

}
