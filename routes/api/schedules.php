<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ScheduleController;

Route::group([
    'prefix' => 'schedule'], function () {
        Route::post('/create', [ScheduleController::class, 'addSchedule']);
        Route::post('/edit', [ScheduleController::class, 'editSchedule']);
        Route::post('/delete', [ScheduleController::class, 'deleteSchedule']);
        Route::get('/{schedule}/', [ScheduleController::class, 'getCurrentSchedule']);
    });

Route::group([
    'prefix' => 'show'], function () {
        Route::get('/schedules', [ScheduleController::class, 'getSchedules']);
        Route::get('/schedules/present', [ScheduleController::class, 'getSchedules2']);
        Route::get('/schedules/mine/{user}', [ScheduleController::class, 'getMySchedules']);
        // Route::post('/schedules/mine', [ScheduleController::class, 'getMySchedules']);
    });
