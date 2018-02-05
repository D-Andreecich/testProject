<?php

namespace App\Http\Controllers\Banks;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BanksShow extends Controller
{
    function __invoke()
    {
        return view('test.test');
    }
}
