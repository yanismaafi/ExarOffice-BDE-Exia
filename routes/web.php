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


/*User profil Routes*/
Route::resource('profile', ProfileController::class, ['names' => 'profile'])->except(['index','edit']);


/* Event Routes */
Route::resource('/evenement', EventController::class, ['names' => 'event'])->only(['index','show']);
Route::post('/evenement/recherche','EventController@search')->name('event.search');
Route::post('/evenement/inscription/{id}','EventController@register');

/* Blog Routes */ 
Route::resource('/blog', PostController::class, ['name' => 'blog'])->except(['edit','update']);
Route::post('/blog/comment','PostController@comment')->name('blog.comment');


/* Product Routes */ 
Route::get('/produits','ProductController@index')->name('product.index');
Route::get('/produit/{slug}','ProductController@show')->name('product.show');
Route::post('/rehcerche','ProductController@search')->name('product.search');


/* Cart Routes */
Route::resource('/panier', CartController::class, ['names' => 'cart'])->except('edit','update','destroy');
Route::get('/panier/vider', 'CartController@emptyCart')->name('cart.emptyCart');
Route::post('/panier/valider-commande', 'CartController@order')->name('cart.order');
Route::delete('/panier/{id}', 'CartController@destroy')->name('cart.destroy');



/* Admin Routes (event)*/
Route::get('admin/evenement','EventController@listEvent')->name('admin.event');
Route::get('admin/evenement/creer','EventController@create')->name('event.create');
Route::post('admin/evenement/ajouter','EventController@store')->name('event.store');
Route::get('admin/evenement/{slug}','EventController@edit')->name('event.edit');
Route::post('admin/evenement/{slug}/modifier','EventController@update')->name('event.update');
Route::delete('admin/evenement/{id}','EventController@destroy')->name('event.destroy');


/* Admin Routes (product)*/
Route::get('/admin/produit/','ProductController@listProduct')->name('admin.product');
Route::get('/admin/produit/creer','ProductController@create')->name('product.create');
Route::post('/admin/produit/ajouter','ProductController@store')->name('product.store');
Route::get('/admin/produit/{slug}','ProductController@edit')->name('product.edit');
Route::post('/admin/produit/{slug}','ProductController@update')->name('product.update');
Route::delete('/admin/produit/{id}','ProductController@destroy')->name('product.destroy');
Route::get('/admin/commandes','ProductController@CommandList')->name('product.order');

/* Admin (Users) */
Route::resource('admin/users',UserController::class,['names' => 'user']);


/* Authentification Route */
Auth::routes();




