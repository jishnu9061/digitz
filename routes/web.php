<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;

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

Route::get('/', [LoginController::class, 'index'])->name('login');
Route::post('/do-login', [LoginController::class, 'Login'])->name('do-login');

// Register
Route::get('/register', [RegisterController::class, 'index'])->name('register');
Route::post('/user-registration', [RegisterController::class, 'registerUser'])->name('do-register');

// Authenticated user routes
Route::group(['prefix' => 'user', 'as' => 'user.', 'middleware' => 'user'], function () {
    Route::post('/logout', [LoginController::class, 'logOut'])->name('logout');
    Route::get('/', [TaskController::class, 'index'])->name('index');
    Route::resource('tasks', TaskController::class);
    Route::patch('tasks/{task}/complete', [TaskController::class, 'markAsCompleted'])->name('tasks.complete');
});
