<?php

namespace App\Http\Controllers;

use App\Rules\Instructions;
use App\Services\ParseInstructionsService;
use App\Services\SimulationService;
use Illuminate\Http\Request;

class CommandController extends Controller
{
    public function __invoke(
        Request $request,
        ParseInstructionsService $parseInstructionsService,
        SimulationService $simulationService,
    ) {
        $request->validate([
            'instructions' => ['required', new Instructions],
        ]);
        $instructions = $parseInstructionsService->parse($request->instructions);
        $output = $simulationService->simulate($instructions);

        return ['output' => $output];
    }
}
