<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IndexGlucoseController;

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

Route::post('/add/ig', [IndexGlucoseController::class, 'store']);
Route::post('/ig/sort', [IndexGlucoseController::class, 'sortedApi']);
// Route::get('/ig/sort', [IndexGlucoseController::class, 'sortedApi']);


