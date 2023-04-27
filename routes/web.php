<?php

// use App\Http\Controllers\AvailabilityController;
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

// Route::get('/', function () {
//     return view('welcome');
// });


// Route::group(['middleware' => ['auth']], function () { 
    Auth::routes();
    Route::post('/store', 'AvailabilityController@store');
    Route::resource('availabilities', 'AvailabilityController');
    Route::get('/home', 'HomeController@index')->name('home');
// });
