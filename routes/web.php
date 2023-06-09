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
//     return route('login');
// });


Auth::routes();
Route::group(['middleware' => ['auth']], function () { 
    Route::post('/store', 'AvailabilityController@store');
    Route::delete('/delete', 'AvailabilityController@destroy');
    Route::resource('availabilities', 'AvailabilityController');
    Route::get('/', 'HomeController@index')->name('home');
});
