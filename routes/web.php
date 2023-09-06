<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\OrgProfileController;
use App\Http\Controllers\EsewaController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\VolunteerController;
use App\Http\Controllers\ReviewController;

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


    //user interest update
    Route::get('/add-interest', function(){
        return redirect()->route('home');
    });
    Route::post('/add-interest', [HomeController::class, 'add_interest']);


    // events
    Route::resource('/events', EventController::class);
    Route::get('/events-{cat}', [EventController::class, 'getDataByCat'])->name('events.getDataByCat');
    // Route::get('/events-{id}', [EventController::class, 'getDataByCat'])->name('events.getDataByCat');
    Route::post('/event-join/{id}', [EventController::class, 'joinEvent'])->name('event.join');
    Route::get('/event/my-join-event', [EventController::class, 'myJoinEvent'])->name('event.myJoinEvent');
    Route::get('/event/my-create-event', [EventController::class, 'myCreateEvent'])->name('event.myCreateEvent');


    // Pro Subscription
    Route::get('/pro-subscription', function(){
        return view('prosubscription');
    })->name('proSubscription');

    //esewa controller
    Route::get('/esewa', [EsewaController::class, 'esewaPay'])->name('esewa');
    Route::get('/success', [EsewaController::class, 'esewaSuccess'])->name('success');
    Route::get('/failure', [EsewaController::class, 'esewaFailure'])->name('failure');

    // dashboard
    Route::get('/org-dashboard', [DashboardController::class, 'index'])->name('orgdashboard');

    // Volunteer
    Route::post('/volunteer/{id}', [VolunteerController::class, 'store'])->name('volunteer');
    Route::get('/volunteer-approve/{id}', [VolunteerController::class, 'approve'])->name('volunteer.approve');
    Route::get('/volunteer-reject/{id}', [VolunteerController::class, 'reject'])->name('volunteer.reject');

    // Review 
    Route::post('/events/{id}/reviews', [ReviewController::class, 'store'])->name('events.reviews.store');
    
});

require __DIR__.'/auth.php';
require __DIR__.'/admin.php';
