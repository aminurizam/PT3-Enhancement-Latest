<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

//Route::get('/', function () {
//    return view('product','CatalogController@catalog');
//});

Route::get('/','CatalogController@catalog'); //route to product page
Route::get('product/{id}','CatalogController@viewProduct'); //route to vie product page

Route::auth();

Route::get('/home', 'HomeController@index');

Route::group(['middleware' => ['web', 'auth'], 'prefix' => 'admin'], function () {

    Route::get('dashboard', 'AdminController@dashboard');
    Route::resource('product', 'ProductController');
    Route::resource('customer', 'CustomerController');
    Route::resource('order', 'OrderController');
    Route::resource('product', 'ProductController');
    Route::resource('staff', 'StaffController');

});

Route::post('addToCart',['middleware' => ['web','auth'],'uses' => 'CatalogController@addToCart']);//route to process the add to cart
//'web' access dlm kernel.php method. //'auth' cek user dah log in ke belum.
Route::get('shopping-cart',['middleware' => ['web','auth'], 'uses' => 'CatalogController@viewCart']); //route to vewi cart
Route::delete('shopping-cart/product/{id}', ['middleware' => ['web','auth'], 'uses' => 'CatalogController@removeProduct']);