<?php

use App\Http\Controllers\CitizenController;
use App\Http\Controllers\ContractController;
use App\Http\Controllers\ForeignerController;
use App\Http\Controllers\CarController;
use App\Http\Middleware\CheckId;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth:sanctum', config('jetstream.auth_session'),'verified',])
    ->group(
        function () {
            Route::get('/citizen', [CitizenController::class, 'showForm']);
            Route::get('/foreigner', [ForeignerController::class, 'showForm']);
            Route::post('/citizen', [CitizenController::class, 'store']);
            Route::post('/foreigner', [ForeignerController::class, 'store']);
            Route::middleware([CheckId::class])->group(function(){
                Route::get('/', [CarController::class, 'show'])->name('dashboard');
                Route::get('/book/{id}', [ContractController::class, 'show']);
                Route::get('/return', [ContractController::class, 'showReturn']);
                Route::post('/contract', [ContractController::class, 'store']);
                Route::post('/returnCar', [ContractController::class, 'destroy']);
            });
        }
    );
