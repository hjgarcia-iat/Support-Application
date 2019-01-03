<?php

Route::get('/', function () {
    return redirect('https://activatelearning.com');
});

Route::get('/access-request', 'AccessRequestController@create')->name('access_request.create');
Route::post('/access-request', 'AccessRequestController@store')->name('access_request.store');

Route::get('/digital-setup-request', 'DigitalSetupController@create')->name('digital_setup_request.create');
Route::post('/digital-setup-request', 'DigitalSetupController@store')->name('digital_setup_request.store');

Route::get('/conceptua-math/request-a-demo', 'RequestDemoController@create')->name('conceptua.request_demo.create');
Route::post('/conceptua-math/request-a-demo', 'RequestDemoController@store')->name('conceptua.request_demo.store');

Route::get('/conceptua-math/request-a-quote', 'RequestQuoteController@create')->name('conceptua.request_quote.create');
Route::post('/conceptua-math/request-a-quote', 'RequestQuoteController@store')->name('conceptua.request_quote.store');

Route::get('/conceptua-math/request-a-case-study', 'RequestCaseController@create')->name('conceptua.request_case.create');
Route::post('/conceptua-math/request-a-case-study', 'RequestCaseController@store')->name('conceptua.request_case.store');

Route::get('/return-request', 'ReturnRequestController@create')->name('return_request.create');
Route::post('/return-request', 'ReturnRequestController@store')->name('return_request.store');