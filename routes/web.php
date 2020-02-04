<?php

use Illuminate\Support\Facades\Auth;
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

Route::middleware('auth')->get(
    '/',
    function (Request $request) {
        $token = Auth::user()->api_token;
        return view('welcome', compact('token'));
    }
);

Auth::routes();

Route::get('/test',
    function () {
        $ticket = \App\Models\Ticket\Ticket::query()->find(54);
        (new \App\Jobs\NotifyWatchers($ticket))->handle();
        return view('test');
    });
