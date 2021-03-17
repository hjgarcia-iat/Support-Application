<?php

use App\Http\Controllers\CalculatorController;

Route::get('/', function () {
    return redirect('https://activatelearning.com');
});

Route::get('/access-request', 'AccessRequestController@create')->name('access_request.create');
Route::post('/access-request', 'AccessRequestController@store')->name('access_request.store');

Route::get('/digital-setup-request', 'DigitalSetupController@create')->name('digital_setup_request.create');
Route::post('/digital-setup-request', 'DigitalSetupController@store')->name('digital_setup_request.store');

Route::get('/return-request', 'ReturnRequestController@create')->name('return_request.create');
Route::post('/return-request', 'ReturnRequestController@store')->name('return_request.store');

//Route::get('/next-gen-pet-request', 'NextGenPetRequestController@create')->name('nextgen_pet.create');
//Route::post('/next-gen-pet-request', 'NextGenPetRequestController@store')->name('nextgen_pet.store');

Route::get('/remote-learning-support','RemoteSupportRequestController@create')->name('remote_support.create');
Route::post('/remote-learning-support','RemoteSupportRequestController@store')->name('remote_support.store');

Route::get('/remote-learning-request', 'RemoteLearningRequestController@create')->name('remote_learning_request.create');
Route::post('/remote-learning-request', 'RemoteLearningRequestController@store')->name('remote_learning_request.store');

Route::get('/contact-request', 'ContactRequestController@create')->name('contact_request.create');
Route::post('/contact-request', 'ContactRequestController@store')->name('contact_request.store');

Route::post('/contact-request/{id}/mail', 'ContactRequestMailController@store')->name('contact_request.mail.store');

Route::get('calculator',[CalculatorController::class,'show'])->name("calculator.show");

Route::post('/files', 'FilesController@store')->name('files.store');
