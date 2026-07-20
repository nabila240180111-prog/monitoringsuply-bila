<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\CountryController;
use App\Http\Controllers\PortController;
use App\Http\Controllers\RiskController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\CurrencyController;
use App\Http\Controllers\WatchlistController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/', function () {
    return view('dashboard');
})->name('dashboard')->middleware('auth');

Route::prefix('api')->group(function () {
    Route::get('/countries', [CountryController::class, 'index']);
    Route::get('/ports', [PortController::class, 'index']);
    Route::get('/ports/search', [PortController::class, 'search']);
    
    Route::get('/risk', [RiskController::class, 'index']);
    Route::get('/news', [NewsController::class, 'index']);
    Route::get('/currency', [CurrencyController::class, 'index']);
    
    Route::get('/watchlist', [WatchlistController::class, 'index']);
    Route::post('/watchlist', [WatchlistController::class, 'store']);
    Route::delete('/watchlist/{id}', [WatchlistController::class, 'destroy']);
    
    Route::get('/admin/stats', [AdminController::class, 'getStats']);
    Route::get('/admin/articles', [AdminController::class, 'listArticles']);
    Route::post('/admin/articles', [AdminController::class, 'storeArticle']);
    Route::delete('/admin/articles/{id}', [AdminController::class, 'deleteArticle']);
    Route::get('/admin/users', [AdminController::class, 'listUsers']);
    Route::delete('/admin/users/{id}', [AdminController::class, 'deleteUser']);
    Route::get('/admin/ports', [AdminController::class, 'listPorts']);
    Route::post('/admin/ports', [AdminController::class, 'storePort']);
    Route::delete('/admin/ports/{id}', [AdminController::class, 'deletePort']);
});
