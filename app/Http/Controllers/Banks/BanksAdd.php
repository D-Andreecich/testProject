<?php

namespace App\Http\Controllers\Banks;

use App\Http\Controllers\Controller;
use Illuminate\Validation\Validator;
use App\Models\Bank;
use Illuminate\Http\Request;


class BanksAdd extends Controller
{
    function add(Request $request){
        $data = $request->all();
        $bank = Bank::create([
            'address_bank' =>  $data['address_bank'],
            'name_personal' => $data['name_personal'],
            'rating_bank' => $data['rating_bank'],
            'rating_atm' => $data['rating_atm'],
            'rating_pb24' => $data['rating_pb24'],
            'startWork' => $data['startWork'],
            'endWork' => $data['endWork'],
        ]);
        return 'Запись успешно добавлена';
    }
}
