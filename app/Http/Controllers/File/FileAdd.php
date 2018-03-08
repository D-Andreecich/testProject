<?php

namespace App\Http\Controllers\File;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;

class FileAdd extends Controller
{
    /**
     * @param Request $request
     * @return mixed|string
     */
    function __invoke(Request $request)
    {
        $result = NULL;
        try {
            // Handle the user upload of avatar
                $file = $request->file('fileText');
                $resultStr = preg_replace("/[^0-9]/", '', file_get_contents($file));
                $result = response()->json([
                    'number' => implode(' + ', str_split($resultStr)),
                    'result' => array_sum(str_split($resultStr)),
                ]);
        } catch (Exception $e) {
            return 'Выброшено исключение: ' . $e->getMessage();
        }
        return $result?? response()->json([
            'number' => '',
            'result' => '',
        ]);
    }
}
