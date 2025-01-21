<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UserController;
use App\Http\Controllers\ClassroomController;

Route::group([
    'prefix' => 'user'], function () {
        Route::post('/create', [UserController::class, 'addUser']);
        Route::post('/edit', [UserController::class, 'editUser']);
        Route::post('/edit/mine', [UserController::class, 'editUser2']);
        Route::post('/delete', [UserController::class, 'deleteUser']);
        Route::get('/{user}/loggedin', [UserController::class, 'getCurrentlyLoggedUser']);
        Route::get('/{user}/', [UserController::class, 'getSpecificUser']);
        Route::get('/{user}/schedules/', [UserController::class, 'getScheduleForUser']);
    });

Route::group([
    'prefix' => 'show'], function () {
        Route::get('/users', [UserController::class, 'getUsers']);
        Route::get('/students', [UserController::class, 'getStudents']);
    });
