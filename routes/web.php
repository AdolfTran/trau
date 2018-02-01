<?php
Auth::routes();

Route::get('/home', 'HomeController@index');
Route::get('/', 'HomeController@index');
Route::any('/profile', 'HomeController@profile');
Route::any('/change_pass', 'HomeController@change');

Route::resource('homes', 'homeController');

Route::resource('customers', 'CustomerController');

Route::resource('machines', 'MachineController');

Route::resource('employees', 'EmployeeController');