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

Route::get('/test', function() {
    $ticket = (new \App\Repositories\TicketRepository())->getForShow(15);
    // info($ticket);
    App\Jobs\SendMessage::dispatch($ticket);
    // info('Test');
    return 'Added';
});
