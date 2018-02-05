<?php

namespace App\Http\Controllers\Banks;

use App\Http\Controllers\Controller;
use Illuminate\Validation\Validator;
use App\Models\Bank;
use Illuminate\Http\Request;


class BanksClear extends Controller
{
    function clear(){
         Bank::truncate();
    }
}
