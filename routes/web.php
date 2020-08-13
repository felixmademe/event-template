<?php

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


Route::get( '/', function ()
{
    return view( 'home/welcome' );
} );

// Authentication Routes...
Route::get( 'logga-in', 'Auth\LoginController@showLoginForm' )->name( 'login-form' );
Route::get( 'loggain', 'Auth\LoginController@showLoginForm' )->name( 'login-form' );
Route::get( 'l', 'Auth\LoginController@showLoginForm' )->name( 'login-form' );
Route::post( 'login', 'Auth\LoginController@login' )->name(  'login' );
Route::post( 'logout', 'Auth\LoginController@logout' )->name( 'logout' );

Route::group( [ 'middleware' => 'auth' ], function()
{
    Route::get( 'dashboard', 'DashboardController' );

    Route::get( 'evenemang/skapa', 'EventController@create' )->name( 'events.create' );
    Route::get( 'evenemang/{event}/redigera', 'EventController@edit' )->name( 'events.edit' );
    Route::post( 'evenemang', 'EventController@store' )->name( 'events.store' );
    Route::match( [ 'put', 'patch' ], 'evenemang/{event}', 'EventController@update' )->name( 'events.update' );
    Route::delete( 'evenemang/{event}', 'EventController@destroy' )->name( 'events.destroy' );
    Route::get( 'evenemang/{event}/admin', 'EventController@admin' )->name( 'events.admin' );
    Route::match( [ 'put', 'patch' ], 'evenemang/{event}/registrering', 'EventController@registration' )->name( 'events.registration' );
    Route::match( [ 'put', 'patch' ], 'evenemang/{event}/publikt', 'EventController@public' )->name( 'events.public' );
    Route::get( 'evenemang/{event}/generera', 'EventController@export' )->name( 'events.export' );

    Route::get( 'evenemang/{event}/admin/deltagare/lägg-till', 'ParticipantController@create' )->name( 'participants.create' );
    Route::get( 'deltagare/{slug}', 'ParticipantController@show' )->name( 'participants.show' );
    Route::get( 'deltagare/{slug}/redigera', 'ParticipantController@edit' )->name( 'participants.edit' );
    Route::match( [ 'put', 'patch' ], 'deltagare/{slug}', 'ParticipantController@update' )->name( 'participants.update' );
    Route::delete( 'deltagare/{slug}', 'ParticipantController@destroy' )->name( 'participants.destroy' );
    Route::match( [ 'put', 'patch' ], 'deltagare/{slug}/betalat', 'ParticipantController@paid' )->name( 'participants.paid' );
    Route::match( [ 'put', 'patch' ], 'deltagare/{slug}/incheckad', 'ParticipantController@checked' )->name( 'participants.checked' );
} );

// Public event routes and registration
Route::get( 'evenemang', 'EventController@index' )->name( 'events.index' );
Route::post( 'deltagare', 'ParticipantController@store' )->name( 'participants.store' );
Route::get( 'evenemang/{event}', 'EventController@show' )->name( 'events.show' );

Route::get( 'kontakt', 'ContactController@form' )->name( 'contacts' );
Route::post( 'kontakt/skicka', 'ContactController@send' )->name( 'contacts.send' );

Route::get('säkerhet/pgp-nyckel', 'KeyController@publickey')->name('key.show');
Route::get('säkerhet/fingeravtryck', 'KeyController@fingerprint')->name('key.fingerprint');
