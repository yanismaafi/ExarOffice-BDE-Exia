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

/* Home Routes */
Route::get('/','HomeController@index')->name('home.index');
Route::post('/','HomeController@contact')->name('home.contact');
Route::get('/a-propos','HomeController@about')->name('home.about');
Route::get('/admin/accueil','HomeController@index')->name('admin.index')->middleware('admin');


/* User profil Routes */
Route::resource('profile', ProfileController::class, ['names' => 'profile'])->except(['index','edit']);


/* Event Routes */
Route::prefix('event')->group(function() {
    Route::get('','EventController@index')->name('event.index');
    Route::post('store','EventController@store')->name('event.store');
    Route::get('show/{id}','EventController@show')->name('event.show');
    Route::get('edit/{event}','EventController@edit')->name('event.edit');
    Route::put('update/{event}','EventController@update')->name('event.update'); 
    Route::post('search','EventController@search')->name('event.search');
    Route::post('register/{id}','EventController@register')->name('event.register');;
    Route::delete('delete/{id}','EventController@destroy')->name('event.destroy');
});



/* Blog Routes */ 
Route::prefix('blog')->group(function() {
    Route::get('','PostController@index')->name('blog.index');
    Route::get('create','PostController@create')->name('blog.create');
    Route::post('store','PostController@store')->name('blog.store');
    Route::get('show/{id}','PostController@show')->name('blog.show');
    Route::get('edit/{event}','PostController@edit')->name('blog.edit');
    Route::put('update/{event}','PostController@update')->name('blog.update'); 
    Route::post('comment','PostController@comment')->name('blog.comment');
    Route::post('search','PostController@search')->name('blog.search');
    Route::delete('delete/{id}','PostController@destroy')->name('blog.destroy');
});



/* Product Routes */ 
Route::prefix('product')->group(function() {
    Route::get('','ProductController@index')->name('product.index');
    Route::post('store','ProductController@store')->name('product.store');
    Route::get('show/{id}','ProductController@show')->name('product.show');
    Route::get('edit/{id}','ProductController@edit')->name('product.edit');
    Route::put('update/{id}','ProductController@update')->name('product.update');
    Route::post('search','ProductController@search')->name('product.search');
    Route::delete('delete/{id}','ProductController@destroy')->name('product.destroy');
});



/* Cart Routes */
Route::prefix('cart')->group(function() {
    Route::get('', 'CartController@emptyCart')->name('cart.index');
    Route::get('store', 'CartController@emptyCart')->name('cart.store');
    Route::get('clear', 'CartController@emptyCart')->name('cart.emptyCart');
    Route::post('validate-order', 'CartController@order')->name('cart.order');
    Route::delete('delete/{id}', 'CartController@destroy')->name('cart.destroy');
});



/* Admin Routes (Event) */
Route::get('admin/evenement','EventController@listEvent')->name('admin.event');
Route::get('admin/evenement/creer','EventController@create')->name('event.create');


/* Admin Routes (Product) */
Route::get('/admin/produit/','ProductController@listProducts')->name('admin.product');
Route::get('/admin/produit/creer','ProductController@create')->name('product.create');
Route::get('/admin/commandes','ProductController@CommandList')->name('product.order');

/* Admin (Users) */
Route::resource('admin/users',UserController::class,['names' => 'user']);


/* Authentification Route */
Auth::routes();


/* Route::get('locale/{locale}', function ($locale){
    Session::put('locale', $locale);
    return redirect()->back();
});*/



