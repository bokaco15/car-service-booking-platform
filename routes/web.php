<?php

use App\Http\Controllers\BookingController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\SerachServiceController;
use App\Http\Controllers\ServiceOfferingController;
use App\Http\Controllers\ServicePendingController;
use App\Http\Controllers\WorkingHoursController;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\OwnerAndAdminPermissionMiddleware;
use App\Http\Middleware\ServiceRoleMiddleware;
use App\Http\Middleware\ServiceShowMiddleware;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

//Route::get('/dashboard', function () {
//    return view('welcome');
//})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';



Route::view('/search', 'service.search')->name('service.search.blade');
Route::post('/search', [SerachServiceController::class, 'search'])->name('service.search');

//CRUD FOR SERVICES / samo owner moze da doda servis!
    //add
Route::view('/service/add', 'service.add')->name('service.add')->middleware(OwnerAndAdminPermissionMiddleware::class);
Route::post('/service/add', [ServiceController::class, 'add'])->name('service.add');
    //all services/za admine crud
Route::get('/service/all', [ServiceController::class, 'all'])->name('service.all');
    //show / mogu svi da vide
Route::get('/service/{service}', [ServiceController::class, 'show'])->name('service.show')->middleware(ServiceShowMiddleware::class);
// update / admin crud
Route::get('/service/edit/{service}', [ServiceController::class, 'edit'])->name('service.edit')->middleware(ServiceRoleMiddleware::class);
Route::post('/service/update/{service}', [ServiceController::class, 'update'])->name('service.update');
// delete/admin/crud
Route::get('/service/delete/{service}', [ServiceController::class,'delete'])->name('service.delete')->middleware(ServiceRoleMiddleware::class);;



//SERVICE OFFERING CRUD
    //owner-admin moze da radi!
    //add offers
Route::get('/service/offering/add/{service}', [ServiceOfferingController::class, 'add'])->name('serviceOffering.add')->middleware(ServiceRoleMiddleware::class);
Route::post('/service/offering/add/{service}', [ServiceOfferingController::class, 'insert'])->name('serviceOffering.insert')->middleware(ServiceRoleMiddleware::class);
    // delete offer-a
Route::get('service/offering/delete/{offer}', [ServiceOfferingController::class, 'delete'])->name('serviceOffering.delete')->middleware(ServiceRoleMiddleware::class);
Route::get('service/offering/edit/{offer}', [ServiceOfferingController::class, 'edit'])->name('serviceOffering.edit')->middleware(ServiceRoleMiddleware::class);
Route::post('service/offering/update/{offer}', [ServiceOfferingController::class, 'update'])->name('serviceOffering.update')->middleware(ServiceRoleMiddleware::class);


//WORKING HOURS
    //OWNER-ADMIN
Route::get('/service/working-hours/add/{service}', [WorkingHoursController::class, 'add'])->name('workingHours.add')->middleware(ServiceRoleMiddleware::class);
Route::post('/service/working-hours/insert', [WorkingHoursController::class, 'insert'])->name('workingHours.insert');
Route::get('/service/working-hours/edit/{service}', [WorkingHoursController::class, 'edit'])->name('workingHours.edit')->middleware(ServiceRoleMiddleware::class);
Route::post('/service/working-hours/update/{service}', [WorkingHoursController::class, 'update'])->name('workingHours.update');


//Bookings
Route::post('/service/booking/insert', [BookingController::class, 'insert'])->name('booking.insert');
Route::get('/service/booking/show/{service}', [BookingController::class, 'show'])->name('booking.show')->middleware(ServiceRoleMiddleware::class);
Route::get('/service/booking/edit/{booking}', [BookingController::class, 'edit'])->name('booking.edit')->middleware(ServiceRoleMiddleware::class);
Route::post('/service/booking/update/{booking}', [BookingController::class, 'update'])->name('booking.update')->middleware(ServiceRoleMiddleware::class);
Route::get('/service/booking/delete/{booking}', [BookingController::class, 'delete'])->name('booking.delete')->middleware(ServiceRoleMiddleware::class);


//admin service pending
Route::get('/admin/service/pending', [ServicePendingController::class, 'index'])->name('service.pending')->middleware(AdminMiddleware::class);
Route::post('/admin/service/status/update/{service}', [ServicePendingController::class, 'update'])->name('service-status.update')->middleware(AdminMiddleware::class);
