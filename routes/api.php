<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('login', 'AuthController@login');
Route::post('register', 'AuthController@register');
Route::delete('logout', 'AuthController@logout');
Route::post('google/login', 'AuthController@loginGoogle');
Route::post('google/register', 'AuthController@registerGoogle');
Route::post('facebook/login', 'AuthController@loginFacebook');
Route::post('facebook/register', 'AuthController@registerFacebook');
Route::get('verify/{token}', 'AuthController@verify');
Route::post('password/reset', 'AuthController@reset');
Route::post('password/reset/{token}', 'AuthController@change');
Route::get('users', 'UserController@findByToken')->middleware('auth:api');
Route::post('users', 'UserController@store')->middleware('auth:api');
Route::put('users/{id}', 'UserController@update')->where('id', '[0-9]+')->middleware('auth:api');
Route::get('users/{id}', 'UserController@show')->where('id', '[0-9]+')->middleware('auth:api');
Route::delete('users/{id}', 'UserController@destroy')->where('id', '[0-9]+')->middleware('auth:api');
Route::post('users/accessToken', 'UserController@generateAccessToken')->middleware('auth:api');
Route::post('users/me', 'UserController@me')->middleware('auth:api');
Route::post('users/customerUpdate', 'UserController@customerUpdate')->middleware('auth:api');
//Route::put('users/email', 'UserController@emailUpdate')->middleware('auth:api');
Route::put('users/email-only', 'UserController@updateEmail')->middleware('auth:api');
Route::put('users/update-password', 'UserController@updatePassword')->middleware('auth:api');
Route::post('users/upload-image', 'UserController@updateImage')->middleware('auth:api');
Route::delete('users/avatar', 'UserController@deleteImage')->middleware('auth:api');
Route::delete('users/google', 'UserController@removeGoogle')->middleware('auth:api');
Route::delete('users/facebook', 'UserController@removeFacebook')->middleware('auth:api');
Route::post('users/google', 'UserController@addGoogle')->middleware('auth:api');
Route::post('users/facebook', 'UserController@addFacebook')->middleware('auth:api');
Route::resource('admins', 'AdminUserController')->middleware('auth:api');
Route::get('admins/{id}/disable', 'AdminUserController@disable')->where('id', '[0-9]+')->middleware('auth:api');
Route::get('admins/{id}/restore', 'AdminUserController@restore')->where('id', '[0-9]+')->middleware('auth:api');
Route::put('services/previewWorkout', 'ServiceController@previewWorkout')->middleware('auth:api');
Route::get('services/{id}/cms', 'ServiceController@cms')->where('id', '[0-9]+')->middleware('auth:api');
Route::get('services/{id}/weekly', 'ServiceController@weekly')->where('id', '[0-9]+')->middleware('auth:api');
Route::get('services/{id}/pending', 'ServiceController@pending')->where('id', '[0-9]+')->middleware('auth:api');
Route::post('services/workout', 'ServiceController@workout')->middleware('auth:api');
Route::post('services/pendingworkout', 'ServiceController@pendingworkout')->middleware('auth:api');
Route::put('services/previewPendingWorkout', 'ServiceController@previewPendingWorkout')->middleware('auth:api');
Route::resource('services', 'ServiceController')->except(['show'])->middleware('auth:api');
Route::resource('services', 'ServiceController')->only(['show'])->middleware('api');
Route::get('customers/{id}/disable', 'CustomerController@disable')->where('id', '[0-9]+')->middleware('auth:api');
Route::get('customers/{id}/restore', 'CustomerController@restore')->where('id', '[0-9]+')->middleware('auth:api');
Route::get('customers/export', 'CustomerController@export');
Route::get('customers/weights', 'CustomerController@weights')->middleware('auth:api');
Route::delete('customers/weights', 'CustomerController@deleteWeight')->middleware('auth:api');
Route::put('customers/weights', 'CustomerController@updateWeight')->middleware('auth:api');
Route::post('customers/weights', 'CustomerController@storeWeight')->middleware('auth:api');
Route::get('customers/conditions', 'CustomerController@conditions')->middleware('auth:api');
Route::post('customers/previousCondition', 'CustomerController@previousCondition')->middleware('auth:api');
Route::post('customers/nextCondition', 'CustomerController@nextCondition')->middleware('auth:api');
Route::post('customers/changeCondition', 'CustomerController@changeCondition')->middleware('auth:api');
Route::post('customers/changeObjective', 'CustomerController@changeObjective')->middleware('auth:api');
Route::post('customers/changeWeights', 'CustomerController@changeWeights')->middleware('auth:api');
Route::get('customers/recentWorkouts', 'CustomerController@recentWorkouts')->middleware('auth:api');
Route::post('customers/activity', 'CustomerController@activity')->middleware('auth:api');
Route::get('customers/link', 'CustomerController@link');
Route::get('customers/ccard', 'CustomerController@ccard')->middleware('auth:api');
Route::get('customers/referral', 'CustomerController@referral')->middleware('auth:api');
Route::get('customers/partners', 'CustomerController@partners')->middleware('auth:api');
Route::post('customers/trigger-workout', 'CustomerController@triggerWorkout')->middleware('auth:api');
Route::post('customers/trigger-notifiable', 'CustomerController@triggerNotifiable')->middleware('auth:api');
Route::resource('customers', 'CustomerController')->middleware('auth:api');
Route::get('transactions/export', 'TransactionController@export')->middleware('auth:api');
Route::get('transactions/{id}/log', 'TransactionController@log')->where('id', '[0-9]+')->middleware('auth:api');
Route::resource('transactions', 'TransactionController')->only(['index','show'])->middleware('auth:api');
Route::post('coupons/check', 'CouponController@check')->middleware('auth:api');
Route::post('coupons/generateFirstPay', 'CouponController@generateFirstPay')->middleware('auth:api');
Route::post('coupons/private', 'CouponController@private')->middleware('auth:api');
Route::post('coupons/subscription', 'CouponController@createRenewal')->middleware('auth:api');
Route::post('coupons/public', 'CouponController@public');
Route::post('coupons/email', 'CouponController@email');
Route::post('coupons/publicWithUser', 'CouponController@publicWithUser')->middleware('auth:api');
Route::post('coupons/referral', 'CouponController@referral');
Route::resource('coupons', 'CouponController')->middleware('auth:api');
Route::get('coupons/{id}/disable', 'CouponController@disable')->where('id', '[0-9]+')->middleware('auth:api');
Route::get('coupons/{id}/restore', 'CouponController@active')->where('id', '[0-9]+')->middleware('auth:api');
Route::post('subscriptions/cancel', 'SubscriptionController@cancel');
Route::post('subscriptions/paypal-ipn', 'SubscriptionController@paypalIpn');
Route::post('subscriptions/nmi', 'SubscriptionController@nmi');
Route::post('subscriptions/checkout', 'SubscriptionController@checkout')->middleware('auth:api');
Route::post('subscriptions/{id}/renewal', 'SubscriptionController@renewal')->where('id', '[0-9]+')->middleware('auth:api');
Route::post('subscriptions/findPaypalPlan', 'SubscriptionController@findPaypalPlan')->middleware('auth:api');
Route::get('subscriptions/{id}/disable', 'SubscriptionController@disable')->where('id', '[0-9]+')->middleware('auth:api');
Route::get('subscriptions/{id}/restore', 'SubscriptionController@restore')->where('id', '[0-9]+')->middleware('auth:api');
Route::get('subscriptions/export', 'SubscriptionController@export')->middleware('auth:api');
Route::resource('subscriptions', 'SubscriptionController')->middleware('auth:api');
Route::post('subscriptions/free', 'SubscriptionController@free')->middleware('auth:api');
Route::get('shortcodes/all', 'ShortcodeController@list')->middleware('auth:api');
Route::resource('shortcodes', 'ShortcodeController')->middleware('auth:api');
Route::get('shortcodes/{id}/disable', 'ShortcodeController@disable')->where('id', '[0-9]+')->middleware('auth:api');
Route::get('shortcodes/{id}/restore', 'ShortcodeController@active')->where('id', '[0-9]+')->middleware('auth:api');
Route::get('keywords/all', 'KeywordController@list')->middleware('auth:api');
Route::resource('keywords', 'KeywordController')->middleware('auth:api');
Route::get('invoices/export', 'InvoiceController@export')->middleware('auth:api');
Route::resource('invoices', 'InvoiceController')->only(['index','show'])->middleware('auth:api');
Route::get('categories/all', 'CategoryController@all');
Route::resource('categories', 'CategoryController')->middleware('auth:api');
Route::get('events/{id}/disable', 'EventController@disable')->where('id', '[0-9]+')->middleware('auth:api');
Route::get('events/{id}/restore', 'EventController@restore')->where('id', '[0-9]+')->middleware('auth:api');
Route::get('events/home', 'EventController@home');
Route::get('events/recent', 'EventController@recent');
Route::post('events/subscribeWithFacebook', 'EventController@subscribeWithFacebook');
Route::post('events/subscribeWithGoogle', 'EventController@subscribeWithGoogle');
Route::post('events/subscribe', 'EventController@subscribe');
Route::resource('events', 'EventController')->only(['index','update','store','destroy'])->middleware('auth:api');
Route::resource('events', 'EventController')->only(['show']);
Route::post('contacts','ContactController@store')->middleware('api');
Route::get('benchmarks/published', 'BenchmarkController@published')->middleware('auth:api');
Route::get('benchmarks/{id}/disable', 'BenchmarkController@disable')->where('id', '[0-9]+')->middleware('auth:api');
Route::get('benchmarks/{id}/restore', 'BenchmarkController@active')->where('id', '[0-9]+')->middleware('auth:api');
Route::resource('benchmarks', 'BenchmarkController')->middleware('auth:api');
Route::get('benchmarkResults/{id}/benchmark', 'BenchmarkResultController@benchmark')->where('id', '[0-9]+')->middleware('auth:api');
Route::get('benchmarkResults/history', 'BenchmarkResultController@history')->middleware('auth:api');
Route::resource('benchmarkResults', 'BenchmarkResultController')->middleware('auth:api');
Route::resource('tockens', 'PaymentTockenController')->middleware('auth:api');
Route::post('sessions/inside', 'SessionController@inside')->middleware('auth:api');
Route::post('sessions/outside', 'SessionController@outside')->middleware('auth:api');
Route::post('cart/inside', 'CartController@inside')->middleware('auth:api');
Route::post('cart/outside', 'CartController@outside')->middleware('auth:api');
Route::resource('cart', 'CartController')->only(['show'])->middleware('auth:api');
Route::resource('roles', 'RoleController')->only(['store','update','destroy','index'])->middleware('auth:api');
Route::get('setting/cart', 'SettingController@cart')->middleware('auth:api');
Route::post('setting/updateCart', 'SettingController@updateCart')->middleware('auth:api');
Route::get('setting/permissions', 'SettingController@permissions')->middleware('auth:api');
Route::post('setting/updatePermissions', 'SettingController@updatePermissions')->middleware('auth:api');
Route::get('setting/referral-discount', 'SettingController@referralDiscount')->middleware('auth:api');
Route::post('setting/update-referral-discount', 'SettingController@updateReferralDiscount')->middleware('auth:api');
Route::get('setting/tag-line', 'SettingController@tagLine')->middleware('auth:api');
Route::post('setting/update-tag-line', 'SettingController@updateTagLine')->middleware('auth:api');
Route::resource('medals', 'MedalController')->middleware('auth:api');
Route::post('done/check', 'DoneController@check')->middleware('auth:api');
Route::post('done/workouts', 'DoneController@workouts')->middleware('auth:api');
Route::post('done/question', 'DoneController@question')->middleware('auth:api');
Route::post('done/start', 'DoneController@startWorkout')->middleware('auth:api');
Route::resource('levelTests', 'LevelTestController')->only(['store','update','destroy','index'])->middleware('auth:api');
Route::get('surveys/active', 'SurveyController@active')->middleware('auth:api');
Route::get('surveys/inactive', 'SurveyController@inactive')->middleware('auth:api');
Route::get('surveys/me', 'SurveyController@me')->middleware('auth:api');
Route::post('surveys/report', 'SurveyController@report')->middleware('auth:api');
Route::resource('surveys', 'SurveyController')->middleware('auth:api');
Route::resource('survey-items', 'SurveyItemController')->middleware('auth:api');
Route::post('survey-items/selectOptionItems/{id}', 'SurveyItemController@saveOptionItems')->middleware('auth:api');
Route::post('survey-items/selectOptions/{id}', 'SurveyItemController@selectOptionSave')->middleware('auth:api');
Route::post('survey-items/selectEditOptionItems/{id}', 'SurveyItemController@selectOptionEdit')->middleware('auth:api');
Route::get('survey-items/selectOptionDelete/{id}', 'SurveyItemController@selectOptionDelete')->middleware('auth:api');
Route::resource('survey-reports', 'SurveyReportController')->only(['index','store'])->middleware('auth:api');
Route::post('survey-reports/view', 'SurveyReportController@view')->middleware('auth:api');
Route::get('survey-reports/export', 'SurveyReportController@export')->middleware('auth:api');
Route::get('reports/customers', 'ReportController@customers')->middleware('auth:api');
Route::get('reports/export-customers', 'ReportController@exportCustomers')->middleware('auth:api');
Route::get('reports/export-usage', 'ReportController@exportUsage')->middleware('auth:api');
Route::get('reports/customer-workouts', 'ReportController@customerWorkouts')->middleware('auth:api');
Route::get('reports/export-subscriptions', 'ReportController@exportSubscriptions')->middleware('auth:api');
Route::get('countries', 'CompanyController@fetchCountries')->middleware('auth:api');
Route::get('companies/{id}/disable', 'CompanyController@disable')->where('id', '[0-9]+')->middleware('auth:api');
Route::get('companies/{id}/restore', 'CompanyController@restore')->where('id', '[0-9]+')->middleware('auth:api');
Route::get('companies/home', 'CompanyController@home')->middleware('auth:api');
Route::get('companies/{id}/home', 'CompanyController@view')->middleware('auth:api');
Route::resource('companies', 'CompanyController')->middleware('auth:api');
Route::get('products/{id}/disable', 'ProductController@disable')->where('id', '[0-9]+')->middleware('auth:api');
Route::get('products/{id}/restore', 'ProductController@restore')->where('id', '[0-9]+')->middleware('auth:api');
Route::get('viewImages/{id}', 'ProductController@viewImages')->where('id', '[0-9]+')->middleware('auth:api');
Route::get('products/{id}/home', 'ProductController@showFront')->where('id', '[0-9]+')->middleware('auth:api');
Route::get('products/{id}/download', 'ProductController@download')->where('id', '[0-9]+')->middleware('auth:api');
Route::resource('products', 'ProductController')->middleware('auth:api');
Route::post('deleteImageItem', 'ProductController@deleteImageItem')->middleware('auth:api');
Route::post('bank/checkout', 'BankTransferController@checkout')->middleware('auth:api');
Route::get('bank', 'BankTransferController@index')->middleware('auth:api');//admin
Route::get('bank/{id}', 'BankTransferController@show')->middleware('auth:api');
Route::post('bank/{id}/approve', 'BankTransferController@approve')->middleware('auth:api');
Route::post('bank/{id}/reject', 'BankTransferController@reject')->middleware('auth:api');
Route::post('bank/{id}/restore', 'BankTransferController@restore')->middleware('auth:api');