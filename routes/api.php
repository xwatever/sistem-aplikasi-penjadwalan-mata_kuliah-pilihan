<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

require __DIR__ . '/api/users.php';
require __DIR__ . '/api/subjects.php';
require __DIR__ . '/api/rooms.php';
require __DIR__ . '/api/schedules.php';
require __DIR__ . '/api/classrooms.php';
require __DIR__ . '/api/forums.php';
