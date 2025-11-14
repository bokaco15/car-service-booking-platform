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
use App\Http\Middleware\OwnerAndAdminPermissionMiddleware;
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

    //reservations
    Route::get('/reservations', [BookingController::class, 'myReservations'])->name('booking.my');
    //booking insert
    Route::post('`/booking`/insert', [BookingController::class, 'insert'])->name('booking.insert')->middleware('auth');

});
require __DIR__.'/auth.php';


Route::prefix('services')->group(function() {
    Route::view('/search', 'service.search')->name('service.search.blade');
    Route::post('/search', [SearchServiceController::class, 'search'])->name('service.search');


    Route::middleware(OwnerAndAdminPermissionMiddleware::class)->group(function(){
        Route::view('/add', 'service.add')->name('service.add');
        Route::post('/add', [ServiceController::class, 'add'])->name('service.add');

        //Service [owner-admin]
        Route::get('/edit/{service}', [ServiceController::class, 'edit'])->name('service.edit')->can('view', 'service');
        Route::post('/update/{service}', [ServiceController::class, 'update'])->name('service.update')->can('update', 'service');
        Route::get('/delete/{service}', [ServiceController::class,'delete'])->name('service.delete')->can('delete', 'service');


        //SERVICE OFFERING CRUD [admin - service owner]
        Route::get('/offering/add/{service}', [ServiceOfferingController::class, 'add'])->name('serviceOffering.add')->can('view', 'service');
        Route::post('/offering/add/{service}', [ServiceOfferingController::class, 'insert'])->name('serviceOffering.insert');
            // delete offer-a
        Route::get('/offering/delete/{service}', [ServiceOfferingController::class, 'delete'])->name('serviceOffering.delete')->can('delete', 'service');
        Route::get('/offering/edit/{service}', [ServiceOfferingController::class, 'edit'])->name('serviceOffering.edit')->can('view', 'service');
        Route::post('/offering/update/{service}', [ServiceOfferingController::class, 'update'])->name('serviceOffering.update')->can('update', 'service');


        //WORKING HOURS [owner-admin]
        Route::get('/working-hours/add/{service}', [WorkingHoursController::class, 'add'])->name('workingHours.add')->can('view', 'service');
        Route::post('/working-hours/insert', [WorkingHoursController::class, 'insert'])->name('workingHours.insert')->can('update', 'service');
        Route::get('/working-hours/edit/{service}', [WorkingHoursController::class, 'edit'])->name('workingHours.edit')->can('view', 'service');
        Route::post('/working-hours/update/{service}', [WorkingHoursController::class, 'update'])->name('workingHours.update')->can('update', 'service');

        //Booking [owner - admin]
        Route::get('/booking/show/{service}', [BookingController::class, 'show'])->name('booking.show')->can('view', 'service');
        Route::get('/booking/edit/{booking}', [BookingController::class, 'edit'])->name('booking.edit')->can('view', 'booking');
        Route::post('/booking/update/{booking}', [BookingController::class, 'update'])->name('booking.update')->can('update', 'booking');
        Route::get('/booking/delete/{booking}', [BookingController::class, 'delete'])->name('booking.delete')->can('delete', 'booking');

    });



//all services/za admin crud
    Route::get('/all', [ServiceController::class, 'all'])->name('service.all');
//show / mogu svi da vide
    Route::get('/{service}', [ServiceController::class, 'show'])->name('service.show');

});


Route::get('/admin/service/pending', [ServicePendingController::class, 'index'])->name('service.pending')->middleware(AdminMiddleware::class);
Route::post('/admin/service/status/update/{service}', [ServicePendingController::class, 'update'])->name('service-status.update')->middleware(AdminMiddleware::class);


// service of service_owner
Route::get('/service-owner/my-services', [ServiceOwnerController::class, 'myServices'])->name('owner.services')->middleware(OwnerAndAdminPermissionMiddleware::class);




