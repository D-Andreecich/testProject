<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bank extends Model
{
    protected $fillable = [
        'address_bank', 'name_personal', 'rating_bank', 'rating_atm', 'rating_pb24', 'startWork', 'endWork',
    ];
}
