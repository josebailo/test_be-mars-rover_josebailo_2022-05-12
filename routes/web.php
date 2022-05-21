<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('simulator.welcome');
});

Route::get('/simulator/raw', function () {
    return view('simulator.raw');
})->name('simulator.raw');

Route::post('/simulate', \App\Http\Controllers\Simulator\SimulateController::class)->name('simulate');
