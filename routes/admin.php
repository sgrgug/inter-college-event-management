<?php 

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\OrganizationController;
use App\Http\Controllers\Admin\EventController;

Route::prefix('admin')->middleware(['admin'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'getDashboard'])->name('admin.dashboard');

    // User 
    Route::get('/user', [DashboardController::class, 'getUser'])->name('getUser');
    Route::delete('/user/{id}', [DashboardController::class, 'deleteUser'])->name('deleteUser');

    // Organization
    Route::get('/organization', [OrganizationController::class, 'getOrganization'])->name('getOrganization');
    Route::post('/organization', [OrganizationController::class, 'storeOrganization'])->name('storeOrganization');
    Route::put('/organization/{id}', [OrganizationController::class, 'updateOrganization'])->name('updateOrganization');
    Route::delete('/organization/{id}', [OrganizationController::class, 'deleteOrganization'])->name('deleteOrganization');

    // Event
    Route::get('/event', [EventController::class, 'getEvent'])->name('getEvent');
    Route::post('/event', [EventController::class, 'storeEvent'])->name('storeEvent');
    Route::put('/event/{id}', [EventController::class, 'updateEvent'])->name('updateEvent');
    Route::delete('/event/{id}', [EventController::class, 'deleteEvent'])->name('deleteEvent');

    // Volunteer 
    Route::get('/volunteer', [EventController::class, 'getVolunteer'])->name('getVolunteer');
    Route::get('/review', [EventController::class, 'getReview'])->name('getReview');

    // Category
    Route::get('/category', [EventController::class, 'getCategory'])->name('getCategory');
    Route::put('/category/{id}', [EventController::class, 'updateCategory'])->name('updateCategory');
    Route::post('/category', [EventController::class, 'storeCategory'])->name('storeCategory');
    Route::delete('/category/{id}', [EventController::class, 'deleteCategory'])->name('deleteCategory');

});