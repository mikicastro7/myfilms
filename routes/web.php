<?php

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

Route::get('/', 'CatalogController@index');
Route::get('/film/{id}', 'CatalogController@showMovie');
Route::get('/cart', 'CartController@showCart');
Route::post('/rating/rate', 'RatingController@postStar');
Route::post('/comment', 'CommentController@postComment');
Route::post('/like_comment', 'CommentController@likeComment');
Route::get('/add-to-cart/{id}', 'CartController@addToCart');
Route::get('/remove-item-cart/{id}', 'CartController@getRemoveItem');
Route::get('/remove-item-cart/checkout/{id}', 'CartController@getRemoveItemCheckout');
Route::get('/checkout', 'CartController@payment')->middleware('auth');
Route::get('/checkout/card', 'CartController@cardPayment')->middleware('auth');
Route::post('/checkout/card', 'CartController@postCardPayment')->middleware('auth');
Route::get('/checkout/paypal', 'PaymentController@postPayment')->middleware('auth');
Route::get('/checkout/payment/status', array(
	'as' => 'payment.status',
	'uses' => 'PaymentController@getPaymentStatus',
))->middleware('auth');
Route::get('/myfilms/{id}', 'MyfilmsController@showMyFilms')->middleware('auth');
Route::get('/logout', 'LogoutController@logout')->middleware('auth');
Route::get('/admin', 'AdminControllers\AdminController@dashboard')->middleware('adminRead');

//Users Routes
Route::get('/admin/users', 'AdminControllers\AdminUsersController@Users')->middleware('adminRead');
Route::get('/admin/users/list', ['as'=>'getUsers.data','uses'=>'AdminControllers\AdminUsersController@getUsers'])->middleware('adminRead');
Route::post('/admin/users/add', ['as'=>'addUsers.data','uses'=>'AdminControllers\AdminUsersController@addUser'])->middleware('admin');
Route::delete('/admin/users/delete', ['as'=>'deleteUsers.data','uses'=>'AdminControllers\AdminUsersController@deleteUser'])->middleware('admin');
Route::put('/admin/users/edit', ['as'=>'editUsers.data','uses'=>'AdminControllers\AdminUsersController@editUser'])->middleware('admin');

//Movies Routes
Route::get('/admin/movies', 'AdminControllers\AdminMoviesController@Movies')->middleware('adminRead');
Route::get('/admin/movies/list', ['as'=>'getMovies.data','uses'=>'AdminControllers\AdminMoviesController@getMovies'])->middleware('adminRead');
Route::post('/admin/movies/add', ['as'=>'addMovies.data','uses'=>'AdminControllers\AdminMoviesController@addMovie'])->middleware('admin');
Route::delete('/admin/movies/delete', ['as'=>'deleteMovies.data','uses'=>'AdminControllers\AdminMoviesController@deleteMovie'])->middleware('admin');
Route::put('/admin/movies/edit', ['as'=>'editMovies.data','uses'=>'AdminControllers\AdminMoviesController@editMovie'])->middleware('admin');
Route::get('/admin/movies/categories', ['uses'=>'AdminControllers\AdminMoviesController@getCategories'])->middleware('admin');

//Category Routes
Route::get('/admin/categories', 'AdminControllers\AdminCategoriesController@Categories')->middleware('adminRead');
Route::get('/admin/categories/list', ['as'=>'getCategories.data','uses'=>'AdminControllers\AdminCategoriesController@getCategories'])->middleware('adminRead');
Route::post('/admin/categories/add', ['as'=>'addCategories.data','uses'=>'AdminControllers\AdminCategoriesController@addCategory'])->middleware('admin');
Route::delete('/admin/categories/delete', ['as'=>'deleteCategories.data','uses'=>'AdminControllers\AdminCategoriesController@deleteCategory'])->middleware('admin');
Route::put('/admin/categories/edit', ['as'=>'editCategories.data','uses'=>'AdminControllers\AdminCategoriesController@editCategory'])->middleware('admin');


Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');

Route::get('my-datatables', 'MyDatatablesController@index');
Route::get('get-data-my-datatables', ['as'=>'get.data','uses'=>'MyDatatablesController@getData']);
