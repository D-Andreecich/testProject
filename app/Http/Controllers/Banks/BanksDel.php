<?php

namespace App\Http\Controllers\Banks;

use App\Http\Controllers\Controller;
use Illuminate\Validation\Validator;
use App\Models\Bank;
use Illuminate\Http\Request;


class BanksDel extends Controller
{
    function delBanks(Request $request){
        Bank::destroy($request->id);
        return 'Запись успешно удалена';
    }
}
