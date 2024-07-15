<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\InboxController;
use App\Http\Controllers\ServiceShowController;
use App\Http\Controllers\ServiceClientController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AppointmentShowController;
use App\Http\Controllers\Admin\TechnicianController;
use App\Http\Controllers\Admin\ActivityLogController;
use App\Http\Controllers\AppointmentClientController;
use App\Http\Controllers\Admin\ServiceAdminController;
use App\Http\Controllers\Admin\AppointmentAdminController;
use App\Http\Controllers\Admin\AssignTechnicianController;
use App\Http\Controllers\Admin\CalenderController;
use App\Http\Controllers\NotificationController;

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

Route::get('/', fn () => view('home'))->name('home');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', DashboardController::class)->name('dashboard');

    Route::middleware('role:admin|technician')->group(function () {
        Route::prefix('admin')->as('admin.')->group(function () {

            Route::prefix('service')->controller(ServiceAdminController::class)->group(function () {
                Route::get('cancel', 'cancel')->name('service.cancel');
                Route::get('pending', 'pending')->name('service.pending');
                Route::get('progress', 'progress')->name('service.progress');
                Route::get('complete', 'complete')->name('service.complete');
                Route::patch('{service}', 'update')->name('service.update');
            });

            Route::prefix('appointment')->controller(AppointmentAdminController::class)->group(function () {
                Route::get('pending', 'pending')->name('appointment.pending');
                Route::get('progress', 'progress')->name('appointment.progress');
                Route::get('complete', 'complete')->name('appointment.complete');
                Route::patch('{appointment}', 'update')->name('appointment.update');
            });

            Route::get('activity', ActivityLogController::class)->name('activity');
            Route::get('inbox', [InboxController::class, 'index'])->name('inbox.index');
            Route::post('inbox/read/{notifications?}', [InboxController::class, 'read'])->name('inbox.read');
            Route::get('calender', CalenderController::class)->name('calender');
        });

        Route::middleware('role:admin')->group(function () {
            Route::prefix('appointment/{appointment}')->group(function () {
                Route::get('/technician', [AssignTechnicianController::class, 'index'])->name('admin.appointment.assign.technician');
                Route::post('/technician', [AssignTechnicianController::class, 'store']);
                Route::post('/reschedule', [AppointmentAdminController::class, 'reschedule'])->name('admin.appointment.reschedule');
            });

            Route::resource('technician', TechnicianController::class)->parameter('technician', 'user');
        });
    });

    Route::middleware('role:client')->group(function () {
        Route::prefix('service')->controller(ServiceClientController::class)->group(function () {
            Route::get('list', 'list')->name('service.list');
            Route::patch('{service}/cancel', 'cancel')->name('service.cancel');
            Route::patch('{service}/active', 'active')->name('service.active');
        });
        Route::resource('service', ServiceClientController::class)->except('index', 'show', 'destroy');

        Route::prefix('appointment')->controller(AppointmentClientController::class)->group(function () {
            Route::get('list', 'list')->name('appointment.list');
            Route::get('{service}/create', 'create')->name('appointment.create');
            Route::post('{service}', 'store')->name('appointment.store');
            Route::get('{appointment}/edit', 'edit')->name('appointment.edit');
            Route::patch('{appointment}', 'update')->name('appointment.update');
        });

        Route::get('/notification', [NotificationController::class, 'index'])->name('notification.index');
        Route::post('notification/read/{notifications?}', [NotificationController::class, 'read'])->name('notification.read');

        Route::get('/profile/{user}', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile/{user}', [ProfileController::class, 'update'])->name('profile.update');
    });

    Route::get('/service/{service}', ServiceShowController::class)->name('service.show');
    Route::get('/appointment/{appointment}', AppointmentShowController::class)->name('appointment.show');
});


require __DIR__ . '/auth.php';
