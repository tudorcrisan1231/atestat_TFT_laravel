<?php

use Illuminate\Support\Facades\Route;
// use App\Http\Controllers\TFTMatchController;
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

Route::get('/', 'App\Http\Controllers\TFTMatchController@homePageData')->name('home');

Route::get('/login', 'App\Http\Controllers\Login@loginAccount')->name('login');
Route::get('/register', 'App\Http\Controllers\Register@createAccount')->name('register');

Route::get('/{region}/{summonerName}', 'App\Http\Controllers\TFTMatchController@matchData')->name('match');


Route::post('/', 'App\Http\Controllers\TFTMatchController@getDataFormHomePage');  //metoda post pe care am pus o in home.blade.php ajunge aici si este redirectionata in getDataFormHomePage;
