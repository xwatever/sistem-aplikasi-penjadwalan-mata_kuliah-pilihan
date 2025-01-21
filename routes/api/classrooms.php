<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ClassroomController;
use App\Http\Controllers\ClassroomAttendanceController;

Route::group([
    'prefix' => 'classroom'], function () {
        Route::post('/create', [ClassroomController::class, 'addClassroom']);
        Route::post('/delete', [ClassroomController::class, 'deleteClassroom']);
        Route::get('/{classroom}', [ClassroomController::class, 'getCurrentClassroom']);
        Route::get('/{classroom}/attendances', [ClassroomController::class, 'getCurrentClassroomAttendances']);
});

Route::group([
    'prefix' => 'classroom-attendance'], function () {
        Route::post('/create', [ClassroomAttendanceController::class, 'addClassroomAttendance']);
        Route::post('/delete', [ClassroomAttendanceController::class, 'deleteClassroomAttendance']);
});



Route::group([
    'prefix' => 'show'], function () {
        Route::get('/classrooms/', [ClassroomController::class, 'getClassrooms']);
});
