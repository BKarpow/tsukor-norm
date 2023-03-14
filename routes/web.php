<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\IndexGlucoseController;
use App\Http\Controllers\MySugarController;
use App\Http\Controllers\SugarTargetRangeController;
use App\Http\Controllers\BloodPressureController;
use App\Http\Controllers\MedicamentController;
use App\Http\Controllers\FeedbackController;
use Fresh\Transliteration\Transliterator;
use Fresh\Transliteration\UkrainianToLatin;
// use App\Lib\Tool;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Auth::routes();

Route::get('/tools', function(){
    return view('tools');
})->name('page.tools');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::post('/feedback-footer', [FeedbackController::class, 'feedbackFooterSend'])
->name('feedback.store');

Route::get('/terms-of-use', function(){
    return view('terms');
})->name('terms');

Route::get('/', function(){
    return view('main');
})->name('ig.index');
Route::get('/ig', [IndexGlucoseController::class, 'index'])->name('ig.index');

Route::get('/ig/add', [IndexGlucoseController::class, 'create'])->name('ig.add');
Route::post('/ig/add', [IndexGlucoseController::class, 'store']);
Route::get('/ig/edit/{indexGlucose}', [IndexGlucoseController::class, 'edit'])->name('ig.edit');
Route::post('/ig/edit/{indexGlucose}', [IndexGlucoseController::class, 'update'])->name('ig.update');

Route::post('/ig/search', [IndexGlucoseController::class, 'search'])->name('ig.search');
Route::group(['prefix'=>'/api/ig'], function(){
    Route::get('/all', [IndexGlucoseController::class, 'allListApi']);
    Route::post('/search', [IndexGlucoseController::class, 'search']);
});

Route::group([
    'prefix'=>'/my-sugar',
    'middleware' => "auth"
], function(){
    Route::get('/import', [MySugarController::class, 'import'])->name('sugar.import');
    Route::get('/api/analytic', [MySugarController::class, 'getAnalyticsDataSugarApi'])->name('sugar.api.analytic');
    Route::get('/api/percentage', [MySugarController::class, 'getLevelsPercentageApi']);
    Route::get('/api/empty-stomach', [MySugarController::class, 'getEmptyStomachApi']);

    Route::post('/import', [MySugarController::class, 'importStore'])->name('sugar.import.file.store');
    Route::get('/add', [MySugarController::class, 'create'])->name('sugar.add');
    Route::post('/add', [MySugarController::class, 'store'])->name('sugar.add.store');
    Route::delete('/delete/{mySugar}', [MySugarController::class, 'destroy'])->name('sugar.delete');
    Route::get('/edit/{mySugar}', [MySugarController::class, 'edit'])->name('sugar.edit');
    Route::post('/edit/{mySugar}', [MySugarController::class, 'update'])->name('sugar.edit');
});

Route::group([
    'prefix' => '/api/str',
    'middleware' => 'auth'
], function() {
    Route::get('/last', [SugarTargetRangeController::class, 'getLastApi'])->name('str.last');
    Route::post('/last', [SugarTargetRangeController::class, 'storeOrUpdateApi']);
});

Route::group([
    'prefix' => "/api/blood-pressure",
    'middleware' => 'auth'
], function() {
    Route::get('csrf-token', function() {
        return response()->json([
            "token" => csrf_token()
        ]);
    });
    Route::get("/", [BloodPressureController::class, 'index']);
    Route::get("/all", [BloodPressureController::class, 'getAllApi']);
    Route::post("/store", [BloodPressureController::class, 'store']);
    Route::delete("/destroy/{bloodPressure}", [BloodPressureController::class, 'destroy']);
});
Route::group([
    'prefix' => '/blood-pressure',
    'middleware' => 'auth',
    'controller' => BloodPressureController::class
], function() {
    Route::get('/create', 'create')->name('bloodPressure.create');
    Route::post('/create', 'store');
    Route::get('/edit/{bloodPressure}', 'edit')->name('bloodPressure.edit');
    Route::post('/edit/{bloodPressure}', 'update');
});
Route::group([
    'prefix' => '/medicament',
    'middleware' => 'auth'
], function() {
    Route::get('/api/list/sugar-lower', [MedicamentController::class, 'getActiveMedSugar']);
    Route::get('/api/triggerActive/{medicament}', [MedicamentController::class, 'triggerActive'])
            ->name('med.api.triggerActive');
    Route::get('/create', [MedicamentController::class, 'create'])->name('med.create');
    Route::get('/edit/{medicament}', [MedicamentController::class, 'edit'])->name('med.edit');
    Route::get('/delete/{medicament}', [MedicamentController::class, 'destroy'])->name('med.delete');
    Route::post('/edit/{medicament}', [MedicamentController::class, 'update'])->name('med.edit');
    Route::post('/create', [MedicamentController::class, 'store'])->name('med.create');
});
Route::group([
    'middleware' => 'auth',
    'prefix' => '/hba1c',
    'controller' => App\Http\Controllers\HbA1cController::class
], function() {
    Route::get('/', 'index')->name('hba1c.index');
    Route::post('/edit/{hbA1c}', 'update')->name('hba1c.edit');
    Route::get('/edit/{hbA1c}', 'edit')->name('hba1c.edit');
    Route::get('/create', 'create')->name('hba1c.create');
    Route::post('/create', 'store');
    Route::delete('/delete/{hbA1c}', 'destroy')->name('hba1c.delete');
});
// Route::group([], function() {});




