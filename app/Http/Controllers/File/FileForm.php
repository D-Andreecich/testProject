<?php

namespace App\Http\Controllers\File;

use App\Http\Controllers\Controller;

class FileForm extends Controller
{
    function __invoke()
    {
        return view('test.file');
    }
}
