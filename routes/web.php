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

Route::post('/logged', [LoginController::class, 'login'])
    ->name('logged');

Route::post('/unauthorized', function() {
    return view('/login/unauthorized');
})->name('unauthorized');

Route::middleware('auth')->group(function()
{
    Route::get('/', function(){
        return view('home');
    })->name('home');

    Route::get('user/my', [UserController::class, 'show_My_Profile'])
        ->name('my_profile');

    Route::put('user/my/update', [UserController::class, 'update_My_Profile'])
        ->name('update_me');

    Route::middleware('admin')->group(function ()
    {
        Route::get('logs', [AdminController::class, 'show_Logs'])
            ->name('logs');

        Route::get('users', [AdminController::class, 'show_All_Users'])
            ->name('all_users');

        Route::post('user/store', [AdminController::class, 'new_User'])
            ->name('new_user');

        Route::put('user/update/{id}', [AdminController::class, 'update'])->where('id', '[0-9]+')
            ->name('update');

        Route::get('user/edit/{id}', [AdminController::class, 'edit_User'])->where('id', '[0-9]+')
            ->name('edit');

        Route::delete('user/delete/{id}', [AdminController::class, 'delete_User'])->where('id', '[0-9]+')
            ->name('delete');

        Route::get('user/{id}', [AdminController::class, 'show_User'])->where('id', '[0-9]+')
            ->name('user_details');
    });
});

Route::get('logout', [LoginController::class, 'logout'])->name('logout');


