<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\Client\UserController;
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

Route::get('/login', function(){
    return view('/login/login');
})->name('login');

Route::post('/', [LoginController::class, 'login'])
    ->name('logged');

Route::middleware('auth')->group(function()
{
    Route::get('/', function(){
        return view('home');
    })->name('home');

    Route::get('user/my', [UserController::class, 'showMyProfile'])
        ->name('my_profile');

    Route::put('user/my/update', [UserController::class, 'updateMyProfile'])
        ->name('update_me');

    Route::middleware('admin')->group(function ()
    {
        Route::get('logs', [AdminController::class, 'showLogs'])
            ->name('logs');

        Route::get('users', [AdminController::class, 'showAllUsers'])
            ->name('all_users');

        Route::get('user/create', function() {
            return view('admin/new_user');
        })->name('new_user');

        Route::post('user/create', [AdminController::class, 'store'])
            ->name('new_user');

        Route::put('user/update/{id}', [AdminController::class, 'update'])->where('id', '[0-9]+')
            ->name('update');

        Route::get('user/edit/{id}', [AdminController::class, 'edit'])->where('id', '[0-9]+')
            ->name('edit');

        Route::get('user/delete/{id}', [AdminController::class, 'destroy'])->where('id', '[0-9]+')
            ->name('delete');
    });
});

Route::get('logout', [LoginController::class, 'logout'])->name('logout');


