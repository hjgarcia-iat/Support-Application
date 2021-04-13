<?php

use App\Http\Controllers\AccessRequestController;
use App\Http\Controllers\Admin\AccountController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\CalculatorController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RequestProductInformationController;
use App\Http\Controllers\SupportTicketController;
use App\Http\Controllers\DigitalSetupController;
use App\Http\Controllers\FilesController;
use App\Http\Controllers\ReturnRequestController;
use App\Http\Controllers\SystemStatusController;
use Spatie\Honeypot\ProtectAgainstSpam;


require __DIR__ . '/auth.php';



Route::get('/', [HomeController::class,'index'])->name('home');

Route::get('/access-request', [AccessRequestController::class, 'create'])->name('access_request.create');
Route::post('/access-request', [AccessRequestController::class, 'store'])->name('access_request.store');

Route::get('/digital-setup-request', [DigitalSetupController::class, 'create'])->name('digital_setup_request.create');
Route::post('/digital-setup-request', [DigitalSetupController::class, 'store'])->name('digital_setup_request.store');

Route::get('/return-request', [ReturnRequestController::class, 'create'])->name('return_request.create');
Route::post('/return-request', [ReturnRequestController::class,'store'])->name('return_request.store');

//Calculator
Route::get('/calculator', [CalculatorController::class, 'show'])->name("calculator.show");
Route::post('/calculator', [CalculatorController::class, 'store'])->name("calculator.store");

//Request product information form
Route::get('/request-product-information', [RequestProductInformationController::class, 'create'])->name("request_product_info.create");
Route::post('/request-product-information', [RequestProductInformationController::class, 'store'])->name("request_product_info.store")->middleware(ProtectAgainstSpam::class);;


/**
 * Help area
 */
Route::get('/support-ticket/create', [SupportTicketController::class, 'create'])->name('support_ticket.create');
Route::post('/support-tickets', [SupportTicketController::class,'store'])->name('support_ticket.store');
Route::post('/support-ticket/files', [FilesController::class, 'store'])->name('support_ticket.files.store');

Route::get('/system-status',[SystemStatusController::class,'index'])->name('system_status.index');


/**
 * Admin Routes
 */
Route::middleware(['auth'])->prefix('admin')->group(function () {
    Route::get('/dashboard',[DashboardController::class,'index'])
        ->name('dashboard');

    Route::get('/account',[AccountController::class, 'edit'])
        ->name('admin.account.edit');

    Route::post('/account',[AccountController::class, 'update'])
        ->name('admin.account.update');
});
