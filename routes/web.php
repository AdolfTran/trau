<?php
Auth::routes();


Route::group(['middleware' => 'admin'], function () {
    Route::resource('homes', 'homeController');
    Route::resource('employees', 'EmployeeController');
});

Route::group(['middleware' => 'editor'], function () {
    Route::any('deleted/{id}', 'MachineController@deleted');
    Route::resource('customers', 'CustomerController');
});

Route::group(['middleware' => 'auth'], function () {
    Route::any('/profile', 'HomeController@profile');
    Route::any('/change_pass', 'HomeController@change');
});
Route::get('/home', 'HomeController@index');
Route::get('/', 'HomeController@index');
Route::resource('machines', 'MachineController');
Route::any('data_json', 'MachineController@getDataForDataTable');