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


Route::get('/clear', function() {
    Artisan::call('view:clear');
    Artisan::call('route:clear');
    Artisan::call('config:clear');
    Artisan::call('cache:clear');
    return 'Cache Cleared!';
});





Route::get('/', 'FrontendController@index')->name('frontend');
Route::get('readNotify', 'NotificationController@readNotify')->name('readNotify');
Route::get('readAllNotify', 'NotificationController@readAllNotify')->name('readAllNotify');
Route::get('checkNotify', 'NotificationController@checkNotify')->name('checkNotify');
//Route::get('/checkout', 'FrontendController@checkout')->name('checkout');
//Route::post('order-submit', 'OrderController@store')->name('order.create');
Route::get('paynow/{id}', 'OrderController@paynow')->name('order.paynow');
Route::put('paynow/{id}', 'OrderController@payNowUpdate')->name('order.payNowUpdate');
Route::get('thankyou/{id}', 'OrderController@paynowThankyou')->name('order.paynowThankyou');
Route::get('sendEmailInvoice/{id}', 'OrderController@sendEmailInvoice')->name('order.sendEmailInvoice');
Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');
Route::group(['prefix' => 'dashboard', 'middleware' => ['auth']], function () {
    Route::get('/', 'DashboardController@index')->name('dashboard');
    Route::resource('brands','BrandController');
    Route::resource('services','ServicesController');
    Route::resource('settings','SettingController');
    Route::resource('order','OrderController');
    Route::get('downloadInvoice/{orderID}', 'OrderController@downloadInvoice')->name('downloadInvoice');
    Route::group(['prefix' => 'users'], function () {
        Route::get('profile', 'UserController@profile')->name('users.profile');
        Route::post('change_profile_image', 'UserController@change_profile_image')->name('users.profile_image');
        Route::post('change_password', 'UserController@changePassword')->name('users.change_password');
    });
    Route::get('customers', 'UserController@customersList')->name('users.customer');


    Route::get('chat','MessageController@index')->name('show.chat');


    Route::resource('users','UserController');


    Route::get('/status', 'UserController@userOnlineStatus');

    Route::get('/impersonate/{user_id}', 'UserController@impersonate')->name('user.impersonate');
    Route::get('/impersonate_leave', 'UserController@impersonate_leave')->name('user.leave.impersonate');


    Route::resource('roles','RoleController');
    Route::resource('logs','LogController');
    // Sales Daily Target Route
    Route::group(['prefix' => 'sales'], function () {
        Route::resource('daily_target', 'DailyTargetController');
        Route::get('daily_target/{user_id}/{date}', 'DailyTargetController@singleDayReport')->name('daily_target.dayReport');
        Route::any('daily_target/bidpurchase', 'DailyTargetController@bidpurchase')->name('daily_target.bidpurchase');
        Route::any('daily_target/feedback', 'DailyTargetController@feedback')->name('daily_target.feedback');
        Route::get('sales_daily_target', 'DailyTargetController@indexSales')->name('daily_target.indexSales');
        Route::get('daily_target/sales/{user_id}/{date}', 'DailyTargetController@singleSalesDayReport')->name('daily_target.salesDayReport');
    });
    Route::group(['prefix' => 'employee'], function () {
        Route::resource('daily_progress', 'DailyProgressController');
        Route::get('daily_progress/{user_id}/{date}', 'DailyProgressController@singleDayReport')->name('daily_progress.dayReport');
    });
//    Route::get('/sales/targets/daily', 'DailyTargetController@index')->name('daily_target.index');
//    Route::get('/sales/targets/create','DailyTargetController@create')->name('daily_target.create');
//    Route::get('/sales/targets/edit/{id}','DailyTargetController@edit')->name('daily_target.edit');
//    Route::resource('daily_target', 'DailyTargetController')->except(['index', 'create','edit']);
    // End Sales Daily Target Route
    Route::resource('profiles','ProfileController');
    Route::get('/profiles/jss_record/{id}','ProfileController@jssRecord')->name('profiles.jss');
    Route::get('/bdlog/{id}','ProfileController@bdlog')->name('profiles.bdlog');
    Route::any('profiles/editbidpurchase', 'ProfileController@editbidpurchase')->name('profiles.editbidpurchase');
    Route::resource('projects','ProjectController');
    Route::post('newComment','ProjectController@newComment')->name('project.newComment');
    Route::get('projectview','ProjectController@projectview');

    Route::resource('project_milestone','ProjectMilestoneController');
    Route::resource('project_progress','ProjectCommentsController');
    Route::resource('teams','TeamController');





    Route::get('attendance', 'AttendanceController@index')->name('show.attendance');

    Route::get('attendance/create', 'AttendanceController@create')->name('attendance.create');
    Route::post('attendance/store', 'AttendanceController@store')->name('attendance.store');

    Route::get('attendance/{id}/edit', 'AttendanceController@edit')->name('edit.attendance');
    Route::put('attendance/{attendance}', 'AttendanceController@update')->name('attendance.update');


    Route::get('addAttendance', 'AttendanceController@importFileView')->name('add.attendance');
    Route::post('importFunc', 'AttendanceController@importFunction')->name('store.attendance');



    Route::get('leaves/summary','LeavesController@summary')->name('leaves.summary');
    Route::resource('leaves','LeavesController');
    Route::group(['prefix' => 'teams'], function () {
        Route::post('generateReport', 'TeamController@generateReport')->name('teams.generateReport');
    });
    Route::get('clear-cache', function() {
        Artisan::call('view:clear');
        Artisan::call('route:clear');
        Artisan::call('config:clear');
        Artisan::call('cache:clear');
        \Request::session()->flash('alert-success', 'System Cache has been cleared!');
        return back();
    })->name('clear-cache');


});

