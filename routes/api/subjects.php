<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\SubjectController;

Route::group([
    'prefix' => 'subject'], function () {
        Route::post('/create', [SubjectController::class, 'addSubject']);
        Route::post('/edit', [SubjectController::class, 'editSubject']);
        Route::post('/delete', [SubjectController::class, 'deleteSubject']);
        Route::get('/{subject}/', [SubjectController::class, 'getSpecificSubject']);
    });


Route::group([
    'prefix' => 'show'], function () {
        Route::get('/subjects/', [SubjectController::class, 'getSubjects']);
    });
