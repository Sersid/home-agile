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

Route::middleware('auth:api')
    ->group(function () {
        Route::get('/user',
            function (Request $request) {
                return $request->user();
            });
        Route::get('/system', 'Ticket\Api\SystemController@index');
        Route::where(['ticket' => '[0-9]+'])
            ->group(function () {
                Route::patch('/ticket/status/{ticket}', 'Ticket\Api\TicketController@status');
                Route::patch('/ticket/priority/{ticket}', 'Ticket\Api\TicketController@priority');
                Route::patch('/ticket/executor/{ticket}', 'Ticket\Api\TicketController@executor');
                Route::patch('/ticket/term/{ticket}', 'Ticket\Api\TicketController@term');
                Route::patch('/ticket/agile/{ticket}', 'Ticket\Api\TicketController@agile');
                Route::get('/ticket/comments/{ticket}', 'Ticket\Api\CommentController@index');
                Route::post('/ticket/comments', 'Ticket\Api\CommentController@store');
                Route::post('/ticket/comments', 'Ticket\Api\CommentController@store');
                Route::post('/ticket/watch', 'Ticket\Api\WatchController@watch');
                Route::post('/ticket/unwatch', 'Ticket\Api\WatchController@unwatch');
            });
        Route::apiResources([
            'ticket' => 'Ticket\Api\TicketController',
        ]);
    });
