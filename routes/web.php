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

//Route::get('/', function () {
//    return view('welcome');
//});

//frontend routes........
Route::get('/','UserController@index');
Route::get('/about','UserController@about');
Route::get('/blog','UserController@blog');
Route::get('/blog/{id}/view','UserController@blogView')->name('blogView');
Route::get('/contact','UserController@contact');
Route::get('/shop','UserController@shop');
Route::get('/shop/{id}/productsingle','UserController@productsingle')->name('productView');



Route::get('/login','UserController@showlogin')->name('user.login.show');
Route::post('/login','UserController@login')->name('user.login');
Route::get('/logout','UserController@logout');
Route::get('/register','UserController@showregister')->name('user.register.show');
Route::post('/register','UserController@register');
Route::get('/verify/{token}','UserController@verify');

//user routes...
Route::post('/comment','CommentController@create')->middleware('userAuth');
Route::get('/comment/{id}/deleteComment','CommentController@deleteComment')->name('user.commentDelete')->middleware('userAuth');
Route::get('/comment/{id}/editComment','CommentController@editCommentShow')->name('user.commentEditShow')->middleware('userAuth');
Route::post('/comment/{id}/editComment','CommentController@editComment')->name('user.commentEdit')->middleware('userAuth');
Route::get('/search','Usercontroller@search');
Route::get('/cart','CartController@show');
Route::get('/cart/clear','CartController@clear')->name('cartClear');
Route::get('cart/{id}/add','CartController@add')->name('cartAdd');
Route::get('cart/wishlist','CartController@wishlist')->name('cartWishlist');
Route::get('cart/{id}/addq','CartController@addq')->name('cartAddq');
Route::get('cart/{id}/remove','CartController@remove')->name('cartRemove');
Route::get('cart/checkout','CartController@checkout');
Route::get('/paysuccess','CartController@paysuccess');

//bakcend routes...
Route::group(['prefix'=>'admin'],function(){

    Route::get('/login','AdminController@showlogin')->name('admin.login.show');
    Route::post('/login','AdminController@login')->name('admin.login');
    Route::get('/logout','AdminController@logout')->name('admin.logout');

    Route::group(['middleware'=>'modAuth'],function(){
        Route::get('/dashboard','AdminController@index')->name('admin.dashboard');
        Route::get('/user','AdminDashboardController@showUser')->middleware('adminCheck');
        Route::post('/roleChange','AdminDashboardController@roleChange')->middleware('adminCheck');
        Route::get('/{id}/disable','AdminDashboardController@disable')->middleware('adminCheck');
        Route::get('/{id}/enable','AdminDashboardController@enable')->middleware('adminCheck');
        Route::get('/{id}/deleteUser','AdminDashboardController@deleteUser')->middleware('adminCheck');


        Route::get('/post/create','AdminDashboardController@createPostShow');
        Route::post('/post/create','AdminDashboardController@createPost');
        Route::get('/post','AdminDashboardController@showPost');
        Route::get('/post/{id}/edit','AdminDashboardController@showEditPost')->name('admin.postEditShow');
        Route::post('/post/{id}/edit','AdminDashboardController@editPost')->name('admin.postEdit');
        Route::get('/post/{id}/deletePost','AdminDashboardController@deletePost')->name('admin.postDelete');


        Route::get('/addProduct','ProductController@showAddProduct');
        Route::post('/addProduct','ProductController@addProduct');
        Route::get('/addCategory','ProductController@showAddCategory')->middleware('adminCheck');
        Route::post('/addCategory','ProductController@addCategory')->middleware('adminCheck');

        Route::get('/product','ProductController@showProduct');
        Route::get('/product/{id}/edit','ProductController@showEditProduct')->name('admin.productEditShow');
        Route::post('/product/{id}/edit','ProductController@editProduct')->name('admin.productEdit');
        Route::get('/product/{id}/deleteProduct','ProductController@deleteProduct')->name('admin.productDelete');


    });
});
