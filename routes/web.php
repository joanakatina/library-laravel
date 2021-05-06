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

Route::view('/', 'pages.home');           //naršyklės lange įvedus svetainės adresą bus matomas vaizdas home, esantis kataloge pages
Route::view('/home', 'pages.home');       //naršyklės lange įvedus svetainės adresą + '/home' (pvz., http://localhost:8000/home) bus matomas vaizdas home
Route::view('/about', 'pages.about');     //naršyklės lange įvedus svetainės adresą + '/about' bus matomas vaizdas about
Route::view('/contacts', 'pages.contacts');
Route::view('/admin', 'admin.dashboard'); //naršyklės lange įvedus svetainės adresą + '/admin' bus matomas vaizdas dashboard
Route::get('/authors', App\Http\Controllers\AuthorsController::class);

Route::get('redirects', App\Http\Controllers\HomeController::class);
Route::group(['middleware' => ['role:admin|librarian']], function () {
    Route::get('/admin', function () {
        return view('admin.dashboard');
    });

    Route::resource('admin/authors', App\Http\Controllers\Admin\AuthorsController::class);
    Route::resource('admin/publishers', App\Http\Controllers\Admin\PublishersController::class);
    Route::resource('admin/books', App\Http\Controllers\Admin\BooksController::class);
    Route::resource('admin/genres', App\Http\Controllers\Admin\GenresController::class);
    Route::resource('admin/countries', App\Http\Controllers\Admin\CountriesController::class);
});

Route::group(['middleware' => ['role:admin']], function () {
    Route::resource('admin/roles', App\Http\Controllers\Admin\RolesController::class);
    Route::resource('admin/users', App\Http\Controllers\Admin\UsersController::class);
});

