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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes(['verify' => true]);

Route::get('/home', 'HomeController@index')->middleware('verified');

Route::resource('categories', 'CategoryController');

Route::resource('comments', 'CommentController');

// Courses
Route::resource('courses', 'CourseController');

Route::get('courses/contents/{course_id}', 'CourseController@contents')->name('courses.contents');
Route::get('courses/subscribers/{course_id}', 'CourseController@subscribers')->name('courses.subscribers');
Route::get('courses/items/{course_id}/{item_id}', 'CourseController@items')->name('courses.items');

Route::post('courses/disapprove', 'CourseController@disapprove')->name('courses.disapprove');
Route::post('courses/approve', 'CourseController@approve')->name('courses.approve');

// publish/unpublish
Route::post('courses/publishCourse', 'CourseController@publishCourse')->name('courses.publishCourse');
Route::post('courses/unpublishCourse', 'CourseController@unpublishCourse')->name('courses.unpublishCourse');

Route::resource('courseUsers', 'CourseUserController');

Route::resource('items', 'ItemController');
Route::get('items/create/{course_id?}', 'ItemController@create')->name('items.create');

Route::resource('payments', 'PaymentController');

Route::resource('users', 'UserController');

Route::resource('views', 'ViewController');

Route::resource('roles', 'RoleController');

Route::resource('coupons', 'CouponController');

// Laravel 5.1.17 and above
// Route::post('/pay', 'PaymentController@redirectToGateway')->name('pay');
Route::get('/payment/callback', 'PaymentController@handleGatewayCallback')->name('paymentCallback');
Route::post('/pay', 'PaymentController@redirectToGateway')->name('pay'); // keep this as POST

Route::delete('courses/{course_id}/unsubscribe/{user_id}', 'CourseController@unsubscribe')->name('courses.unsubscribe');