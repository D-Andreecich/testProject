<?php

namespace App\Http\Controllers\Banks;

use App\Http\Controllers\Controller;
use App\Models\Bank;
use Illuminate\Http\Request;

class BanksEdit extends Controller
{
    function editBanks(Request $request)
    {
        $data = $request->all();
        Bank::where('id', array_shift($data))->update($data);
        return 'Запись успешно обновлена';
    }
}
