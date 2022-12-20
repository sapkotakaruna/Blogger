<?php

use Illuminate\Support\Facades\Route;

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
Route::get('crud',[\App\Http\Controllers\CrudController::class,'index'])->name('crud.index');
Route::get('crud/create',[\App\Http\Controllers\CrudController::class,'create'])->name('crud.create');
Route::post('crud/store',[\App\Http\Controllers\CrudController::class,'store'])->name('crud.store');
Route::get('crud/edit/{id}',[\App\Http\Controllers\CrudController::class,'edit'])->name('crud.edit');
Route::post('crud/update/{id}',[\App\Http\Controllers\CrudController::class,'update'])->name('crud.update');
Route::get('crud/delete/{id}',[\App\Http\Controllers\CrudController::class,'destroy'])->name('crud.delete');
