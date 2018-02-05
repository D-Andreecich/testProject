<?php

namespace App\Http\Controllers\Banks;

use App\Http\Controllers\Controller;
use App\Models\Bank;
use Illuminate\Http\Request;


class BanksGet extends Controller
{
    function getBanks(Request $request){
        $data = $request->all();
        $banks =  Bank::select(
            [
                'id',
                'address_bank',
                'name_personal',
                'rating_bank',
                'rating_atm',
                'rating_pb24',
                'startWork',
                'endWork',
            ])
            ->get();
            return $banks ? $banks->toArray() : [];
    }
}
