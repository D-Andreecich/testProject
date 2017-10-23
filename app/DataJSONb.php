<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DataJSONb extends Model
{
    protected $table = 'dataJSONb';

    protected $fillable = [
        'data_json',
    ];

    public $timestamps = false;
}
