<?php

use App\Http\Controllers\AccessRequestController;
use App\Http\Controllers\Admin\AccountController;
use App\Http\Controllers\Admin\ArticleController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\StatusController;
use App\Http\Controllers\Admin\TicketController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\CalculatorController;
use App\Http\Controllers\CategoriesArticlesController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\DigitalSetupController;
use App\Http\Controllers\FilesController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RequestProductInformationController;
use App\Http\Controllers\ReturnRequestController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\SupportTicketController;
use App\Http\Controllers\SystemStatusController;
use Spatie\Honeypot\ProtectAgainstSpam;


require __DIR__ . '/auth.php';


/**
 * Help area
 */
Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/search', [SearchController::class, 'index'])->name('search.index');

Route::get('/categories/{slug}/articles', [CategoriesController::class, 'show'])->name('categories.show');
Route::get('/categories/{slug}/articles/{articleSlug}', [CategoriesArticlesController::class, 'show'])->name('categories.articles.show');


Route::get('/support-ticket/create', [SupportTicketController::class, 'create'])->name('support_ticket.create');
Route::post('/support-tickets', [SupportTicketController::class, 'store'])->name('support_ticket.store');
Route::post('/support-ticket/files', [FilesController::class, 'store'])->name('support_ticket.files.store');
Route::get('/system-status', [SystemStatusController::class, 'index'])->name('system_status.index');


Route::get('/return-request', [ReturnRequestController::class, 'create'])->name('return_request.create');
Route::post('/return-request', [ReturnRequestController::class, 'store'])->name('return_request.store');

//Calculator
Route::get('/calculator', [CalculatorController::class, 'show'])->name("calculator.show");
Route::post('/calculator', [CalculatorController::class, 'store'])->name("calculator.store");

//Request product information form
Route::get('/request-product-information', [RequestProductInformationController::class, 'create'])->name("request_product_info.create");
Route::post('/request-product-information', [RequestProductInformationController::class, 'store'])->name("request_product_info.store")->middleware(ProtectAgainstSpam::class);;


/**
 * Admin Routes
 */
Route::middleware(['auth'])->prefix('admin')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])
        ->name('dashboard');

    Route::get('/categories', [CategoryController::class, 'index'])->name('admin.categories');
    Route::get('/categories/create', [CategoryController::class, 'create'])->name('admin.categories.create');
    Route::post('/categories', [CategoryController::class, 'store'])->name('admin.categories.store');
    Route::get('/categories/{category}', [CategoryController::class, 'edit'])->name('admin.categories.edit');
    Route::patch('/categories/{category}', [CategoryController::class, 'update'])->name('admin.categories.update');
    Route::delete('/categories/{category}', [CategoryController::class, 'delete'])->name('admin.categories.delete');

    Route::get('/articles', [ArticleController::class, 'index'])->name('admin.articles');
    Route::get('/articles/create', [ArticleController::class, 'create'])->name('admin.articles.create');
    Route::post('/articles', [ArticleController::class, 'store'])->name('admin.articles.store');
    Route::get('/articles/{article}', [ArticleController::class, 'edit'])->name('admin.articles.edit');
    Route::patch('/articles/{article}', [ArticleController::class, 'update'])->name('admin.articles.update');
    Route::delete('/articles/{article}', [ArticleController::class, 'delete'])->name('admin.articles.delete');

    Route::get('/account', [AccountController::class, 'edit'])->name('admin.account.edit');
    Route::post('/account', [AccountController::class, 'update'])->name('admin.account.update');

    Route::get('/tickets', [TicketController::class, 'index'])->name('admin.tickets');
    Route::get('/tickets/{ticket}/delete', [TicketController::class, 'delete'])->name('admin.tickets.delete');

    Route::get('/statuses', [StatusController::class, 'index'])->name('admin.statuses');
    Route::get('/statuses/create', [StatusController::class, 'create'])->name('admin.statuses.create');
    Route::post('/statuses', [StatusController::class, 'store'])->name('admin.statuses.store');
    Route::get('/statuses/{status}', [StatusController::class, 'edit'])->name('admin.statuses.edit');
    Route::post('/statuses/{status}', [StatusController::class, 'update'])->name('admin.statuses.update');
    Route::get('/statuses/{status}/delete', [StatusController::class, 'delete'])->name('admin.statuses.delete');

    Route::get('/users', [UserController::class, 'index'])->name('admin.users');
    Route::get('/users/create', [UserController::class, 'create'])->name('admin.users.create');
    Route::post('/users', [UserController::class, 'store'])->name('admin.users.store');
    Route::get('/users/{user}', [UserController::class, 'edit'])->name('admin.users.edit');
    Route::post('/users/{user}', [UserController::class, 'update'])->name('admin.users.update');
    Route::get('/users/{user}/delete', [UserController::class, 'delete'])->name('admin.users.delete');
});
