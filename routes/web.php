<?php

use App\Http\Controllers\Admin\CrudController;
use App\Http\Controllers\Front\HomeController;
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
Route::get('/',[HomeController::class,'index'])->name('home.index');
Route::post('/contact',[HomeController::class,'contactStore'])->name('contact.store');
Route::get('/blog/{slug}',[HomeController::class,'blog'])->name('blog');

Route::group(['prefix' => 'admin/', 'as' => 'admin.', 'middleware' => ['auth']], function (){
    Route::get('crud',[CrudController::class,'index'])->name('crud.index');
    Route::get('crud/create',[CrudController::class,'create'])->name('crud.create');
    Route::post('crud/store',[CrudController::class,'store'])->name('crud.store');
    Route::get('crud/edit/{id}',[CrudController::class,'edit'])->name('crud.edit');
    Route::post('crud/update/{id}',[CrudController::class,'update'])->name('crud.update');
    Route::get('crud/delete/{id}',[CrudController::class,'destroy'])->name('crud.delete');

    Route::get('trial',[\App\Http\Controllers\Admin\TrialController::class,'index'])->name('trial.index');
    Route::get('trial/create',[\App\Http\Controllers\Admin\TrialController::class,'create'])->name('trial.create');
    Route::post('trial/store',[\App\Http\Controllers\Admin\TrialController::class,'store'])->name('trial.store');
    Route::get('trial/edit/{id}',[\App\Http\Controllers\Admin\TrialController::class,'edit'])->name('trial.edit');
    Route::post('trial/update/{id}',[\App\Http\Controllers\Admin\TrialController::class,'update'])->name('trial.update');
    Route::get('trial/delete/{id}',[\App\Http\Controllers\Admin\TrialController::class,'destroy'])->name('trial.delete');

    Route::resource('aboutUs',\App\Http\Controllers\Admin\AboutUsController::class);
    Route::resource('services',\App\Http\Controllers\Admin\ServicesController::class);
    Route::resource('work',\App\Http\Controllers\Admin\WorkController::class);
    Route::resource('blog',\App\Http\Controllers\Admin\BlogController::class);
    Route::resource('contact',\App\Http\Controllers\Admin\ContactController::class);
    Route::resource('skill',\App\Http\Controllers\Admin\SkillController::class);
    Route::resource('user',\App\Http\Controllers\Admin\UserController::class);
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

