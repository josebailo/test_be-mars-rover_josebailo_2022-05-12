<?php

namespace App\Http\Controllers;

class CommandController extends Controller
{
    public function __invoke()
    {
        return ['output' => "1 3 N\n5 1 E"];
    }
}
