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

Route::middleware(['auth:sanctum'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');



Route::group([ 'middleware' => 'auth' ,'prefix' => 'marks'], function() {
    Route::get('/', 'App\Http\Controllers\Controller@index')->name('marks.index');
    Route::post('store', 'App\Http\Controllers\Controller@store')->name('marks.store');
    Route::get('edit/{id}', 'App\Http\Controllers\Controller@edit')->name('marks.edit');
    Route::post('update/{id}', 'App\Http\Controllers\Controller@update')->name('marks.update');
    Route::delete('delete/{id}', 'App\Http\Controllers\Controller@destroy')->name('marks.delete');
});
Route::group([ 'middleware' => 'auth'], function() {

    Route::get('image-gallery', 'App\Http\Controllers\ImageGalleryController@index')->name('image-gallery');
    Route::post('image-gallery', 'App\Http\Controllers\ImageGalleryController@upload');
    Route::delete('image-gallery/{id}', 'App\Http\Controllers\ImageGalleryController@destroy');
});

//Route::post('addMarks', 'App\Http\Controllers\Controller@addMarks')->name('addMarks');
