<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\RingtoneController;


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


Route::get('/',[UserController::class,'index']);



Route::get('/downloadringtone/{id}',[UserController::class,'downloadringtone']);
Route::get('labels/{url?}',[UserController::class,'labelwisedetail']);



Auth::routes();

Route::get('/admin', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['middleware' => ['auth']], function() {
    Route::get('/admin/dashboard',[DashboardController::class,'dashboard']);
    Route::resource('/admin/ringtone', RingtoneController::class);
});

Route::get('logout', function ()
{
    auth()->logout();
    Session()->flush();

    return Redirect::to('/admin');
})->name('logout');

Route::any('/{url?}',[UserController::class,'ringtonedetail']);
