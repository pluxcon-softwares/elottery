<?php

use App\Http\Controllers\ChartController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\GameController;
use App\Http\Controllers\LotteryController;
use App\Http\Controllers\LotteryTypeController;
use App\Http\Controllers\ResultController;
use App\Http\Controllers\TestController;
use App\Models\LotteryType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// TestController Routes for testing features
Route::get('test', [TestController::class, 'test']);


// CountryController Routes
Route::get('countries', [CountryController::class, 'countries']);
Route::post('country/create', [CountryController::class, 'create']);
Route::match(['get','post'], '/country/update', [CountryController::class, 'update']);
Route::post('country/delete', [CountryController::class, 'delete']);

// LotteryController Routes
Route::get('lotteries', [LotteryController::class, 'lotteries']);
Route::post('lottery/create', [LotteryController::class, 'create']);
Route::match(['get','post'], '/lottery/update', [LotteryController::class, 'update']);
Route::post('lottery/delete', [LotteryController::class, 'delete']);
Route::post('lotteries-by-country', [LotteryController::class, 'lotteriesByCountry']);
Route::post('lottery/lottery-by-id', [LotteryController::class, 'lotteryById']);

// ResultController Routes
Route::get('results', [ResultController::class, 'index']);
Route::post('result/store', [ResultController::class, 'store']);
Route::post('result/upload', [ResultController::class, 'upload']);

// ChartController Routes
Route::get('fetch-games', [ChartController::class, 'fetchGames']);
Route::post('fetch-chart', [ChartController::class, 'fetchChartByGame']);
Route::post('search-date-chart', [ChartController::class, 'searchDateChart']);
Route::post('search-event-chart', [ChartController::class, 'searchEventChart']);
