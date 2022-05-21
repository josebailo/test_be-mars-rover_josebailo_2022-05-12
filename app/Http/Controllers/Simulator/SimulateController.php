<?php

namespace App\Http\Controllers\Simulator;

use App\Http\Controllers\Controller;
use App\Rules\Instructions;
use App\Services\ParseInstructionsService;
use App\Services\SimulationService;
use Illuminate\Http\Request;

class SimulateController extends Controller
{
    public function __invoke(
        Request $request,
        ParseInstructionsService $parseInstructionsService,
        SimulationService $simulationService,
    ) {
        $request->validate([
            'instructions' => ['required', new Instructions],
        ]);
        $instructions = $request->instructions;
        $parsedInstructions = $parseInstructionsService->parse($instructions);
        $output = $simulationService->simulate($parsedInstructions);

        return redirect()
            ->route('simulator.raw')
            ->with(compact('instructions', 'output'));
    }
}
