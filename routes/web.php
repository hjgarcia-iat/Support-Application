<?php

Route::get('/', function () {
    return redirect('https://activatelearning.com');
});

Route::get('/access-request', 'AccessRequestController@create')->name('access_request.create');
Route::post('/access-request', 'AccessRequestController@store')->name('access_request.store');

Route::get('/digital-setup-request', 'DigitalSetupController@create')->name('digital_setup_request.create');
Route::post('/digital-setup-request', 'DigitalSetupController@store')->name('digital_setup_request.store');

Route::get('/return-request/{code?}', 'ReturnRequestController@create')->name('return_request.create');
Route::post('/return-request', 'ReturnRequestController@store')->name('return_request.store');