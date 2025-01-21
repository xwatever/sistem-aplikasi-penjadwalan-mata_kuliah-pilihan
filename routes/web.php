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

// Route::get('/', function () {
//     return view('welcome');
// });
//
// Auth::routes();
//
// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::group([
    'middleware' => ['auth', 'checkrole:super_admin,admin']], function () {
        Route::get('/admin', function () {
            return view('dashboard.admin_dashboard');
        })->name('admin');
});

Route::group([
    'middleware' => ['auth', 'checkrole:mahasiswa']], function () {
        Route::get('/student', function () {
            return view('dashboard.student_dashboard');
        })->name('student');
});

Route::get('/', function () {
    if (Auth::user()) {
        $user = Auth::user();
        if ($user->role == 1 || $user->role == 2)
            return view('dashboard.admin_dashboard');
        elseif ($user->role == 3)
            return view('dashboard.student_dashboard');
        // else
            // return view('auth.login');
            // return view('dashboard.admin_dashboard');
    } else {
        return view('auth.login');
    }
});

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
