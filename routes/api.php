<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\LandingController;

Route::prefix('landing')->group(function () {
    Route::get('roulette/show', [LandingController::class, 'rouletteShow']);
    Route::get('questions/show', [LandingController::class, 'questionsShow']);
    Route::post('claim', [LandingController::class, 'claim']);
});
