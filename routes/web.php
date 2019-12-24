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

Route::get(
    '/',
    function () {
        return view('welcome');
    }
);

Auth::routes();

Route::get('/home', 'HomeController@index')
    ->name('home');

Route::get(
    '/smartadmin',
    function () {
        return view('smartadmin');
    }
);

Route::group(['namespace' => 'Ticket'], function () {
    Route::resource('ticket', 'TicketController')->names('ticket');
});

Route::group(['namespace' => 'Ticket\Admin', 'prefix' => 'admin/ticket'], function () {
    Route::resource('ticket', 'TicketController')->names('admin.ticket');
});
