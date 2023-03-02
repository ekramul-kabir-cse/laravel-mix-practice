<?php

use App\Models\Dependent;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\DependentController;
use App\Http\Controllers\InfoController;

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


//ajax with just store and show not dependent dropdown
Route::get('dependent/index', [DependentController::class, 'index'])->name('dependent.index');
Route::post('/store/user',[DependentController::class, 'store'])->name('store.user');
Route::get('/get-users', [DependentController::class, 'getUsers'])->name('get-users');

//import export
Route::get('/file-import',[DependentController::class,'importView'])->name('import-view');
Route::post('/import',[DependentController::class,'import'])->name('import');
Route::get('/export',[DependentController::class,'export'])->name('export');

//invoice generator
Route::get('/invoice/{id}', [InvoiceController::class, 'generateInvoice'])->name('invoice');



//crud with many field
Route::get('/info/create',[InfoController::class,'create'])->name('info.create');
Route::post('/store', [InfoController::class, 'store'])->name('info.store');
Route::get('/info/index',[InfoController::class,'index'])->name('info.index');
Route::get('/info/edit/{id}',[InfoController::class,'editInfo'])->name('info.edit');
Route::post('/info/update/{id}',[InfoController::class,'updateInfo'])->name('info.update');
Route::post('/info/delete/{id}',[InfoController::class,'delete'])->name('info.delete');



