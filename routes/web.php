<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Models\UrlShortener;
use App\Http\Controllers\UrlShortenerController;
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

Route::get('/', function () {
    return view('welcome');
});


Route::post('/shorten', [UrlShortenerController::class, 'shorten']);
Route::get('/top', [UrlShortenerController::class, 'top']);
Route::get('/{shortUrl}', [UrlShortenerController::class, 'redirect']);

