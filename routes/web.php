<?php

use App\Http\Controllers\BookingController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SearchServiceController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\ServiceOfferingController;
use App\Http\Controllers\ServiceOwnerController;
use App\Http\Controllers\ServicePendingController;
use App\Http\Controllers\WorkingHoursController;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\ServiceOwnerMiddleware;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';


Route::prefix('services')->group(function() {


    Route::view('/search', 'service.search')->name('service.search.blade');
    Route::post('/search', [SearchServiceController::class, 'search'])->name('service.search');

    //CRUD FOR SERVICES / samo owner moze da doda servis!
//add
    Route::view('/add', 'service.add')->name('service.add');
    Route::post('/add', [ServiceController::class, 'add'])->name('service.add');
//all services/za admin crud
    Route::get('/all', [ServiceController::class, 'all'])->name('service.all');
//show / mogu svi da vide
    Route::get('/{service}', [ServiceController::class, 'show'])->name('service.show');
// update / admin crud
    Route::get('/edit/{service}', [ServiceController::class, 'edit'])->name('service.edit');
    Route::post('/update/{service}', [ServiceController::class, 'update'])->name('service.update');
// delete/admin/crud
    Route::get('/delete/{service}', [ServiceController::class,'delete'])->name('service.delete');

    //SERVICE OFFERING CRUD
//owner-admin moze da radi!
//add offers
    Route::get('/offering/add/{offer}', [ServiceOfferingController::class, 'add'])->name('serviceOffering.add');
    Route::post('/offering/add/{offer}', [ServiceOfferingController::class, 'insert'])->name('serviceOffering.insert');
// delete offer-a
    Route::get('/offering/delete/{offer}', [ServiceOfferingController::class, 'delete'])->name('serviceOffering.delete');
    Route::get('/offering/edit/{offer}', [ServiceOfferingController::class, 'edit'])->name('serviceOffering.edit');
    Route::post('/offering/update/{offer}', [ServiceOfferingController::class, 'update'])->name('serviceOffering.update');



    //WORKING HOURS
//OWNER-ADMIN
    Route::get('/working-hours/add/{service}', [WorkingHoursController::class, 'add'])->name('workingHours.add');
    Route::post('/working-hours/insert', [WorkingHoursController::class, 'insert'])->name('workingHours.insert');
    Route::get('/working-hours/edit/{service}', [WorkingHoursController::class, 'edit'])->name('workingHours.edit');
    Route::post('/working-hours/update/{service}', [WorkingHoursController::class, 'update'])->name('workingHours.update');


//Bookings
    Route::post('/booking/insert', [BookingController::class, 'insert'])->name('booking.insert');
    Route::get('/booking/show/{service}', [BookingController::class, 'show'])->name('booking.show');
    Route::get('/booking/edit/{booking}', [BookingController::class, 'edit'])->name('booking.edit');
    Route::post('/booking/update/{booking}', [BookingController::class, 'update'])->name('booking.update');
    Route::get('/booking/delete/{booking}', [BookingController::class, 'delete'])->name('booking.delete');


});


Route::get('/admin/service/pending', [ServicePendingController::class, 'index'])->name('service.pending')->middleware(AdminMiddleware::class);
Route::post('/admin/service/status/update/{service}', [ServicePendingController::class, 'update'])->name('service-status.update')->middleware(AdminMiddleware::class);


// service of service_owner
Route::get('/service-owner/my-services', [ServiceOwnerController::class, 'myServices'])->name('owner.services');
//    ->middleware(ServiceOwnerMiddleware::class);


// my-reservations
Route::get('/reservations', [BookingController::class, 'myReservations'])->name('booking.my')->middleware('auth');

