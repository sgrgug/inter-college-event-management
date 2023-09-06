<?php 

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\OrganizationController;

Route::prefix('admin')->middleware(['admin'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'getDashboard'])->name('admin.dashboard');
});


Route::get('/organization', [OrganizationController::class, 'getOrganization'])->name('getOrganization');
Route::post('/organization', [OrganizationController::class, 'storeOrganization'])->name('storeOrganization');
Route::put('/organization/{id}', [OrganizationController::class, 'updateOrganization'])->name('updateOrganization');
Route::delete('/organization/{id}', [OrganizationController::class, 'deleteOrganization'])->name('deleteOrganization');