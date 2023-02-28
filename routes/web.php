<?php

use App\Models\Dependent;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DependentController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::delete('/delete-selected', 'DeleteController@deleteSelected')->name('delete-selected');

Route::get('dependent/index', [DependentController::class, 'index'])->name('dependent.index');
Route::post('/store',[DependentController::class, 'store'])->name('dependent.store');
Route::get('/get-users', [DependentController::class, 'getUsers'])->name('get-users');

//import export
Route::get('/file-import',[DependentController::class,'importView'])->name('import-view');
Route::post('/import',[DependentController::class,'import'])->name('import');
Route::get('/export',[DependentController::class,'export'])->name('export');

