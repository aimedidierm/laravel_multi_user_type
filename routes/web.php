<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Auth;

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
Route::get('/admin/home', 'HomeController@adminHome')->name('admin.home');
Route::view('/', 'login');
Route::post('/', 'LoginController@login');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home')->middleware('auth');
Route::view('/a/home', 'ahome')->middleware('usert');
Route::view('/t/home', 'thome')->middleware('usert');
