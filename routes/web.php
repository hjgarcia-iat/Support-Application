<?php

use App\Http\Controllers\AccessRequestController;
use App\Http\Controllers\CalculatorController;
use App\Http\Controllers\SupportTicketController;
use App\Http\Controllers\DigitalSetupController;
use App\Http\Controllers\FilesController;
use App\Http\Controllers\RequestProductInformationController;
use App\Http\Controllers\ReturnRequestController;
use Spatie\Honeypot\ProtectAgainstSpam;

Route::get('/', function () {
    return redirect('https://activatelearning.com');
});

Route::get('/access-request', [AccessRequestController::class, 'create'])->name('access_request.create');
Route::post('/access-request', [AccessRequestController::class, 'store'])->name('access_request.store');

Route::get('/digital-setup-request', [DigitalSetupController::class, 'create'])->name('digital_setup_request.create');
Route::post('/digital-setup-request', [DigitalSetupController::class, 'store'])->name('digital_setup_request.store');

Route::get('/return-request', [ReturnRequestController::class, 'create'])->name('return_request.create');
Route::post('/return-request', [ReturnRequestController::class,'store'])->name('return_request.store');

Route::get('/support-ticket', [SupportTicketController::class, 'create'])->name('support_ticket.create');
Route::post('/support-ticket', [SupportTicketController::class,'store'])->name('support_ticket.store');
Route::post('/support-ticket/files', [FilesController::class, 'store'])->name('support_ticket.files.store');

Route::get('/calculator', [CalculatorController::class, 'show'])->name("calculator.show");
Route::post('/calculator', [CalculatorController::class, 'store'])->name("calculator.store");


Route::get('/request-product-information', [RequestProductInformationController::class, 'create'])->name("request_product_info.create");
Route::post('/request-product-information', [RequestProductInformationController::class, 'store'])->name("request_product_info.store")->middleware(ProtectAgainstSpam::class);;
