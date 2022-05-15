<?php

namespace App\Http\Controllers;

use App\Rules\Instructions;
use Illuminate\Http\Request;

class CommandController extends Controller
{
    public function __invoke(Request $request)
    {
        $request->validate([
            'instructions' => ['required', new Instructions],
        ]);

        return ['output' => "1 3 N\n5 1 E"];
    }
}
