<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\OrgProfileController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::get('/home', [HomeController::class, 'index'])->middleware(['auth', 'verified'])->name('home');


Route::get('/dashboard', function(){
    return redirect()->route('home');
});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    //update org profile
    Route::get('organization/org-profile-update', [OrgProfileController::class, 'index'])->middleware('can:isOrg')->name('organization.org_profile_update');
    Route::post('organization/org-profile-update', [OrgProfileController::class, 'update'])->middleware('can:isOrg')->name('organization.org_profile_update_update');
    // Route::get('/add', [OrgProfileController::class, 'update']);


    // events
    Route::resource('/events', EventController::class);

});

require __DIR__.'/auth.php';
