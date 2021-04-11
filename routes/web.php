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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/index','App\Http\Controllers\StaffDetailController@index')->name('index');
Route::get('/add','App\Http\Controllers\StaffDetailController@show');
Route::post('/add','App\Http\Controllers\StaffDetailController@add')->name('add');
Route::get('/edit/{id}','App\Http\Controllers\StaffDetailController@edit')->name('edit');
Route::post('/update/{id}','App\Http\Controllers\StaffDetailController@update')->name('edit.save');
Route::get('/destroy/{id}','App\Http\Controllers\StaffDetailController@destroy')->name('staff.delete');
Route::get('/detelechecked','App\Http\Controllers\StaffDetailController@checkeddelete')->name('staff.checkeddelete');
