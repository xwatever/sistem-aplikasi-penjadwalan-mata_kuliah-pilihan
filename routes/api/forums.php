<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ForumController;
use App\Http\Controllers\ForumReplyController;

Route::group([
    'prefix' => 'forum'], function () {
        Route::post('/create', [ForumController::class, 'addForum']);
        Route::get('/{forum}/replies', [ForumReplyController::class, 'getForumReplies']);
        Route::get('/{forum}/content', [ForumController::class, 'getForumContent']);
});

Route::group([
    'prefix' => 'forum-reply'], function () {
        Route::post('/create', [ForumReplyController::class, 'addForumReply']);
});

Route::group([
    'prefix' => 'show'], function () {
        Route::get('/forums', [ForumController::class, 'getForums']);
});
