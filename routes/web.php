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

Route::get('/business', 'BusinessController@index')->name('Business');
Route::get('/business/configuration' , 'BusinessController@create')->name('configuration');
Route::get('/business/{business_id}' , 'BusinessController@edit')->name('editBusiness');
Route::put('/busines/{business_id}', 'BusinessController@update')->name('updateBusiness');
Route::get('/business/{page}' , 'BusinessController@create')->name('addBusiness');
Route::post('/business' , 'BusinessController@store');
Route::delete('/business/{business_id}' , 'BusinessController@destroy')->name('deleteBusiness');

Route::get('/business/{business_id}/services', 'ServiceController@index')->name('services');
Route::get('/business/{business_id}/service/add', 'ServiceController@create')->name('addService');
Route::post('/business/{business_id}/services/add', 'ServiceController@store')->name('storeService');
Route::get('/business/{business_id}/service/{service_id}', 'ServiceController@edit')->name('editService');
Route::put('/business/{business_id}/service/{service_id}', 'ServiceController@update')->name('updateService');
Route::delete('/business/{business_id}/services/{service_id}', 'ServiceController@destroy')->name('deleteService');

Route::get('/business/{business_id}/employee', 'EmployeeController@index')->name('employees');
Route::get('/business/{business_id}/employee/add', 'EmployeeController@create')->name('addEmployee');
Route::post('/business/{business_id}/employee/add', 'EmployeeController@store')->name('storeEmployee');
Route::get('/business/{business_id}/employee/{employee_id}', 'EmployeeController@edit')
		->name('editEmployee');
Route::put('/business/{business_id}/employee/{employee_id}' , 'EmployeeController@update')->name('updateEmployee');
Route::delete('/business/{business_id}/employee/{employee_id}', 'EmployeeController@destroy')->name('deleteEmployee');