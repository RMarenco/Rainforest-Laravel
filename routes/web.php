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

Route::get('locale/{locale}', function ($locale){
    Session::put('locale', $locale);
    return redirect()->back();
});

Route::view('/', "index@index")->middleware('user')->middleware('verified');
Route::get('/', "HomeController@index")->middleware('user')->middleware('verified');
Route::get('/index', "UAHomeController@index");

Route::get('/user/logout', 'Auth\LoginController@userLogout')->name('user.logout');

Route::prefix('admin')->group(function(){
	Route::get('/home', 'HomeController@admin')->middleware('admin');
	//Route::get('/login', 'Auth\AdminLoginController@showLoginForm')->name('admin.login')->middleware('admin');
	//Route::post('/login', 'Auth\AdminLoginController@login')->name('admin.login.submit')->middleware('admin');
	Route::get('/', "AdminController@home")->name('admin.dashboard')->middleware('admin');
	//Route::get('/logout', 'Auth\AdminLoginController@logout')->name('admin.logout')->middleware('admin');
	Route::view('/index', "\admin\index")->middleware('admin');
	Route::get('/index', "AdminController@home")->middleware('admin');
	Route::post('/index', "AdminController@update_avatar")->name('update_avatar')->middleware('admin');

	Route::get('/users', "AdminController@users")->middleware('admin');
	Route::get('/users/products', "AdminController@user_products")->middleware('admin');

	Route::get('/categories', "AdminController@categories")->middleware('admin');

	Route::get('/categories/add-categories', "AdminController@addcategories")->middleware('admin');
	Route::post('/categories/add-categories', "AdminController@add_categories")->name('add_categories')->middleware('admin');	

	Route::get('/categories/update-categories', "AdminController@updatecategories")->middleware('admin');
	Route::post('/categories/update-categories', "AdminController@update_categories")->name('update_categories')->middleware('admin');

	Route::get('/users/update-product', "AdminController@updateproduct")->middleware('admin');
	Route::post('/users/update-product', "AdminController@update_product")->name('aupdate_product')->middleware('admin');

	Route::get('/display', "AdminController@display")->middleware('admin');
	Route::get('/hide', "AdminController@hide")->middleware('admin');

	Route::get('/admins', "AdminController@admins")->middleware('superadmin');
	Route::get('/admins/add-admins', "AdminController@addAdmins")->middleware('superadmin');
	Route::post('/admins/add-admins', "AdminController@add_Admins")->name('add_admins')->middleware('superadmin');
});
Route::prefix('user-seller')->group(function(){
	Route::get('/', "UserController@dashboard")->middleware('user')->middleware('verified');
	Route::get('/products', "UserController@products")->middleware('user')->middleware('verified');
	Route::get('/add-products', "UserController@addproduct")->middleware('user')->middleware('verified');
	Route::post('/add-products', "UserController@add_product")->name('add_product')->middleware('user')->middleware('verified');

	Route::get('/update-product', "UserController@updateproduct")->middleware('user')->middleware('verified');
	Route::post('/update-product', "UserController@update_product")->name('update_product')->middleware('user')->middleware('verified');

	Route::get('/see-buyout', "UserController@buyout")->middleware('user')->middleware('verified');
	Route::get('/manage-status', "UserController@status")->middleware('user')->middleware('verified');
	Route::post('/manage-status', "UserController@change_status")->name('change_status')->middleware('user')->middleware('verified');
	Route::get('/trackings', "UserController@trackings")->middleware('user')->middleware('verified');
});


Route::view('/profile', "settings")->middleware('user')->middleware('verified');
Route::get('/profile', "UserController@profile")->middleware('user')->middleware('verified');
Route::post('/profile', "UserController@update_avatar")->middleware('user')->middleware('verified');

Route::view('/cart', 'cart')->middleware('user')->middleware('verified');
Route::get('/see-buyout', "UserController@see_buyout")->middleware('user')->middleware('verified');
Route::get('/cart', "UserController@cart")->middleware('user')->middleware('verified');
Route::get('/order-tracking', "UserController@order_tracking")->middleware('user')->middleware('verified');
Route::get('/display', "UserController@display")->middleware('user')->middleware('verified');
Route::get('/hide', "UserController@hide")->middleware('user')->middleware('verified');
Route::get('/delete', "UserController@delete")->middleware('user')->middleware('verified');
Route::post('/delete', "UserController@delete_product")->name('delete_product')->middleware('user')->middleware('verified');

Auth::routes(['verify' => true]);

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/chat', 'HomeController@chat')->name('home');

Route::get('messages', 'MessageController@fetch');
Route::post('messages', 'MessageController@sentMessage');