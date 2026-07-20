<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\CountryController;
use App\Http\Controllers\PortController;

Route::get('/', function () {
    return view('dashboard');
})->name('dashboard');

Route::prefix('api')->group(function () {
    Route::get('/countries', [CountryController::class, 'index']);
    Route::get('/ports', [PortController::class, 'index']);
    Route::get('/ports/search', [PortController::class, 'search']);
});
