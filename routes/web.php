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
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;

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

// Route artisan control
Route::group([
    'prefix' => '/artisan',
    'middleware' => 'admin',
], function(){
    Route::get('/migrate', function(){
        $c = Artisan::call('migrate');
        if ($c === 0) {
            echo "Migration success!";
        } else {
            echo "Error migration!!";
        }
    });

    Route::get('/migrate-rollback', function(){
        $c = Artisan::call('migrate:rollback');
        if ($c === 0) {
            echo "Migration rollback success!";
        } else {
            echo "Error migration rollback!!";
        }
    });
});

Route::get('/terms-of-use', function(){
    return view('terms');
})->name('terms');

Route::group([
    'prefix' => '/about',
    'controller' => App\Http\Controllers\AboutController::class,
], function(){
    Route::get('/', 'aboutPage')->name('about');
});

Route::get('/', function(){
    if (Auth::check()) {
        return redirect()->route('home');
    }
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
    'controller' => MySugarController::class,
    'middleware' => "auth"
], function(){
    Route::get('/', 'index')->name('sugar.index');
    Route::get('/analytic', 'analytic')->name('sugar.analytic');
    Route::get('/import', 'import')->name('sugar.import');
    Route::get('/api/analytic', 'getAnalyticsDataSugarApi')->name('sugar.api.analytic');
    Route::get('/api/profile', 'gluProfileApi')->name('sugar.api.profile');
    Route::get('/api/percentage', 'getLevelsPercentageApi');
    Route::get('/api/empty-stomach', 'getEmptyStomachApi');
    Route::get('/api/all-dates', 'getAllDatesSugar');

    Route::post('/import', 'importStore')->name('sugar.import.file.store');
    Route::get('/add', 'create')->name('sugar.add');
    Route::post('/add', 'store')->name('sugar.add.store');
    Route::delete('/delete/{mySugar}', 'destroy')->name('sugar.delete');
    Route::get('/edit/{mySugar}', 'edit')->name('sugar.edit');
    Route::post('/edit/{mySugar}', 'update')->name('sugar.edit');
});

Route::group([
    'prefix' => '/export-pdf',
    'middleware' => 'auth',
    'controller' => HomeController::class
], function() {
    Route::get('/', 'pdfExport')->name('pdfExport');
    Route::post('/store', 'pdfExportStore')->name('pdfExport.store');
    Route::get('/download/{pdfName}', 'pdfDownload')->name('pdfExport.download');
    Route::delete('/delete/{pdfName}', 'pdfDelete')->name('pdfExport.delete');
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
    // Route::delete("/destroy/{bloodPressure}", [BloodPressureController::class, 'destroy']);
});
Route::group([
    'prefix' => '/blood-pressure',
    'middleware' => 'auth',
    'controller' => BloodPressureController::class
], function() {
    Route::get('/', 'index')->name('bloodPressure.index');
    Route::get('/create', 'create')->name('bloodPressure.create');
    Route::post('/create', 'store');
    Route::get('/edit/{bloodPressure}', 'edit')->name('bloodPressure.edit');
    Route::post('/edit/{bloodPressure}', 'update');
    Route::delete('/delete/{bloodPressure}', 'destroy')->name('bloodPressure.delete');;
});
Route::group([
    'prefix' => '/medicament',
    'middleware' => 'auth'
], function() {
    Route::get('/', [MedicamentController::class, 'index'])->name('med.index');
    Route::get('/api/list/sugar-lower', [MedicamentController::class, 'getActiveMedSugar']);
    Route::get('/api/list', [MedicamentController::class, 'getActiveMed']);
    Route::get('/api/list/all', [MedicamentController::class, 'getAllMedicaments']);
    Route::get('/api/list/trash', [MedicamentController::class, 'getTrashMedicaments']);
    Route::get('/api/triggerActive/{medicament}', [MedicamentController::class, 'triggerActive'])
            ->name('med.api.triggerActive');
    Route::get('/create', [MedicamentController::class, 'create'])->name('med.create');
    Route::get('/edit/{medicament}', [MedicamentController::class, 'edit'])->name('med.edit');
    Route::get('/delete/{medicament}', [MedicamentController::class, 'destroy'])->name('med.delete');
    Route::get('/restore/{medicament}', [MedicamentController::class, 'restoreMed'])->name('med.restore');
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
    Route::get('/api/last', 'getLastDaysApi');
});
Route::group([
    'prefix' => '/insulin',
    'middleware' => 'auth',
    'controller' => App\Http\Controllers\InsulinController::class
], function() {
    Route::get('/', 'index')->name('insulin.index');
    Route::get('/create', 'create')->name('insulin.create');
    Route::post('/create', 'store');
    Route::get('/edit/{insulin}', 'edit')->name('insulin.edit');
    Route::post('/edit/{insulin}', 'update');
    Route::delete('/delete/{insulin}', 'destroy')->name('insulin.delete');
});
Route::group([
    'prefix' => '/insulin-log',
    'middleware' => 'auth',
    'controller' => App\Http\Controllers\InsulinTakeController::class
], function() {
    Route::get('/', 'index')->name('insulinLog.index');
    Route::get('/create', 'create')->name('insulinLog.create');
    Route::post('/create', 'store');
    Route::get('/edit/{insulinTake}', 'edit')->name('insulinLog.update');
    Route::post('/edit/{insulinTake}', 'update');
    Route::delete('/delete/{insulinTake}', 'destroy');
});

Route::group([
    'prefix' => '/glucose-api',
    'middleware' => 'auth',
    'controller' => App\Http\Controllers\ApiMainHistoryController::class
], function() {
    Route::get('/get-date', 'glucoseForDate');
    Route::get('/sync', 'syncToHistory');
});
Route::group([
    'prefix' => '/med-take',
    'middleware' => 'auth',
    'controller' => App\Http\Controllers\MedicamentTakeController::class,
], function() {
    Route::get('/', 'index')->name('medicamentTake.index');
    Route::get('/create', 'create')->name('medicamentTake.create');
    Route::post('/create', 'store');
    Route::get('/edit/{medicamentTake}', 'edit')->name('medicamentTake.update');
    Route::post('/edit/{medicamentTake}', 'update');
    Route::delete('/delete/{medicamentTake}', 'destroy')->name('medicamentTake.delete');
});
Route::group([
    'prefix' => '/setup-user',
    'middleware' => 'auth',
    'controller' => App\Http\Controllers\UserController::class,
], function() {
    Route::get('/', 'userIndex')->name('user.index');
    Route::get('/delete', 'deleteUserAndData')->name('user.delete');
    Route::post('/delete', 'deleteUserAndDataStore');
    Route::post('/create', 'saveSetupType')->name('user.saveSetup');
    Route::post('/change-profile', 'changeProfile')->name('user.changeProfile');
});

Route::group([
    'prefix' => '/keton',
    'middleware' => 'auth',
    'controller' => App\Http\Controllers\KetonController::class,
], function() {
    Route::get('/', 'index')->name('keton.index');
    Route::get('/create', 'create')->name('keton.create');
    Route::post('/create', 'store');
});

Route::group([
    'prefix' => '/data/export',
    'middleware' => 'auth',
    'controller' => App\Http\Controllers\ExportImportController::class,
], function() {
    Route::get('/json', 'getJson')->name('export.json');
});
Route::group([
    'prefix' => '/admin',
    'middleware' => 'admin',
    'controller' => App\Http\Controllers\AdminStatistickController::class
], function() {
    Route::get('/visitors', 'pageVisitors')->name('admin.ips');
});
Route::group([
    'prefix' => '/admin-product',
    'middleware' => 'admin',
    'controller' => App\Http\Controllers\ControlProductIgController::class
], function() {
    Route::get('/', 'showList')->name('admin.product');
    Route::get('/trigger/{indexGlucose}', 'publicTrigger')->name('admin.product.public.trigger');
});
// Route::group([], function() {});

Route::get('/redirect', [App\Http\Controllers\Auth\LoginController::class, 'redirectToProvider']);
Route::get('/callback', [App\Http\Controllers\Auth\LoginController::class, 'handleProviderCallback']);
// Route::get('/ip', function() {
//     dd($_SERVER);
// });




