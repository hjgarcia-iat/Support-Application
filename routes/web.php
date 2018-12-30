<?php

Route::get('/', function () {
    return redirect('https://activatelearning.com');
});

Route::get('/access-request', 'AccessRequestController@create')->name('access_request.create');
Route::post('/access-request', 'AccessRequestController@store')->name('access_request.store');

Route::get('/digital-setup-request','DigitalSetupController@create')->name('digital_setup_request.create');
