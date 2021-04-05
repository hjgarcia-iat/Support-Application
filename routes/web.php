<?php

use App\Http\Controllers\AccessRequestController;
use App\Http\Controllers\CalculatorController;
use App\Http\Controllers\ContactRequestController;
use App\Http\Controllers\DigitalSetupController;
use App\Http\Controllers\FilesController;
use App\Http\Controllers\RemoteLearningRequestController;
use App\Http\Controllers\RemoteSupportRequestController;
use App\Http\Controllers\RequestProductInformationController;
use App\Http\Controllers\ReturnRequestController;

Route::get('/', function () {
    return redirect('https://activatelearning.com');
});

Route::get('/access-request', [AccessRequestController::class, 'create'])->name('access_request.create');
Route::post('/access-request', [AccessRequestController::class, 'store'])->name('access_request.store');

Route::get('/digital-setup-request', [DigitalSetupController::class, 'create'])->name('digital_setup_request.create');
Route::post('/digital-setup-request', [DigitalSetupController::class, 'store'])->name('digital_setup_request.store');

Route::get('/return-request', [ReturnRequestController::class, 'create'])->name('return_request.create');
Route::post('/return-request', [ReturnRequestController::class,'store'])->name('return_request.store');

Route::get('/remote-learning-support', [RemoteSupportRequestController::class, 'create'])->name('remote_support.create');
Route::post('/remote-learning-support', [RemoteSupportRequestController::class,'store'])->name('remote_support.store');

Route::get('/remote-learning-request', [RemoteLearningRequestController::class, 'create'])->name('remote_learning_request.create');
Route::post('/remote-learning-request', [RemoteLearningRequestController::class,'store'])->name('remote_learning_request.store');

Route::get('/contact-request', [ContactRequestController::class, 'create'])->name('contact_request.create');
Route::post('/contact-request', [ContactRequestController::class,'store'])->name('contact_request.store');
Route::post('/files', [FilesController::class, 'store'])->name('files.store');

Route::get('/calculator', [CalculatorController::class, 'show'])->name("calculator.show");
Route::post('/calculator', [CalculatorController::class, 'store'])->name("calculator.store");


Route::get('/request-product-information', [RequestProductInformationController::class, 'create'])->name("request_product_info.create");
Route::post('/request-product-information', [RequestProductInformationController::class, 'store'])->name("request_product_info.store");
