<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\RoomController;

Route::group([
    'prefix' => 'room'], function () {
      Route::post('/create', [RoomController::class, 'addRoom']);
      Route::post('/edit', [RoomController::class, 'editRoom']);
      Route::post('/delete', [RoomController::class, 'deleteRoom']);
      Route::get('/{room}/', [RoomController::class, 'getSpecificRoom']);
    });

Route::group([
    'prefix' => 'show'], function () {
        Route::get('/rooms', [RoomController::class, 'getRooms']);
    });
