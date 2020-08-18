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

Route::get('/', 'BookingsController@index')->name('dashboard');
Helper::routes( ['/bookings' , 'business/{business_id}/bookings'] );

// Route::get('/business', 'BusinessController@index')->name('business.index');
//Route::get('/business/create' , 'BusinessController@create')->name('business.create');
// Route::post('/business' , 'BusinessController@store')->name('business.store');
// Route::get('/business/{business_id}/edit' , 'BusinessController@edit')->name('business.edit');
// Route::put('/busines/{business_id}', 'BusinessController@update')->name('business.update');
// Route::delete('/business/{business_id}' , 'BusinessController@destroy')->name('business.destroy');

Helper::routes( ['/business','/business/{business_id}/service'] );

// Route::get('/business/{business_id}/service', 'ServiceController@index')->name('service.index');
// Route::get('/business/{business_id}/service/create', 'ServiceController@create')->name('service.create');
// Route::post('/business/{business_id}/service', 'ServiceController@store')->name('service.store');
// Route::get('/business/{business_id}/service/{service_id}/edit', 'ServiceController@edit')->name('service.edit'); 
// Route::put('/business/{business_id}/service/{service_id}', 'ServiceController@update')->name('service.update');
// Route::delete('/business/{business_id}/service/{service_id}', 'ServiceController@destroy')->name('service.destroy');

Route::get('/business/{business_id}/employee', 'EmployeeController@index')->name('employee.index');
Route::get('/business/{business_id}/employee/create', 'EmployeeController@create')->name('employee.create');
Route::post('/business/{business_id}/employee', 'EmployeeController@store')->name('employee.store');
Route::get('/business/{business_id}/employee/{employee_id}/edit', 'EmployeeController@edit')
		->name('employee.edit');
Route::put('/business/{business_id}/employee/{employee_id}' , 'EmployeeController@update')->name('employee.update');
Route::delete('/business/{business_id}/employee/{employee_id}', 'EmployeeController@destroy')->name('employee.destroy');

/* AJAX REQUESTS HANDLING */
Route::get('ajax_getEmpWorkingDays', 'AjaxController@getWorkingDays');
Route::get('ajax_getSlotsHtml', 'AjaxController@getSlotsHtml');

/* CUSTOM CONTROLLERS */
Route::get('business/{business_id}/booking' , 'FrontendBookingController@create');
// Route::post('business/{business_id}/booking/create' , 'FrontendBookingController@store')->name('frontendbooking');
Route::get('business/{business_id}/booking/create' , 'FrontendBookingController@store')->name('frontendbooking');
