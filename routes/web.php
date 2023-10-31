<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\InboxController;
use App\Http\Controllers\ServiceShowController;
use App\Http\Controllers\ServiceClientController;
use App\Http\Controllers\Auth\DashboardController;
use App\Http\Controllers\AppointmentShowController;
use App\Http\Controllers\Admin\TechnicianController;
use App\Http\Controllers\Admin\ActivityLogController;
use App\Http\Controllers\AppointmentClientController;
use App\Http\Controllers\Admin\ServiceAdminController;
use App\Http\Controllers\Admin\AppointmentAdminController;
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
        Route::get('admin/service/cancel', [ServiceAdminController::class, 'cancel'])->name('admin.service.cancel');
        Route::get('admin/service/pending', [ServiceAdminController::class, 'pending'])->name('admin.service.pending');
        Route::get('admin/service/progress', [ServiceAdminController::class, 'progress'])->name('admin.service.progress');
        Route::get('admin/service/complete', [ServiceAdminController::class, 'complete'])->name('admin.service.complete');
        Route::patch('admin/service/{service}', [ServiceAdminController::class, 'update'])->name('admin.service.update');
        Route::get('admin/appointment/pending', [AppointmentAdminController::class, 'pending'])->name('admin.appointment.pending');
        Route::get('admin/appointment/progress', [AppointmentAdminController::class, 'progress'])->name('admin.appointment.progress');
        Route::get('admin/appointment/complete', [AppointmentAdminController::class, 'complete'])->name('admin.appointment.complete');
        Route::patch('admin/appointment/{appointment}', [AppointmentAdminController::class, 'update'])->name('admin.appointment.update');
        Route::get('/admin/activity', ActivityLogController::class)->name('admin.activity');
        Route::get('/admin/inbox', [InboxController::class, 'index'])->name('admin.inbox.index');
        Route::post('inbox/read/{notifications?}', [InboxController::class, 'read'])->name('admin.inbox.read');
        Route::get('/admin/calender', CalenderController::class)->name('admin.calender');

        Route::middleware('role:admin')->group(function () {
            Route::get('/appointment/{appointment}/technician', [AppointmentAdminController::class, 'create'])->name('admin.appointment.technician');
            Route::post('/appointment/{appointment}/technician', [AppointmentAdminController::class, 'store']);
            Route::post('/appointment/{appointment}/reschedule', [AppointmentAdminController::class, 'reschedule'])->name('admin.appointment.reschedule');
            Route::resource('technician', TechnicianController::class)->parameters([
                'technician' => 'user'
            ]);
        });
    });

    Route::middleware('role:client')->group(function () {
        Route::get('/service/list', [ServiceClientController::class, 'list'])->name('service.list');
        Route::patch('/service/{service}/cancel', [ServiceClientController::class, 'cancel'])->name('service.cancel');
        Route::patch('/service/{service}/active', [ServiceClientController::class, 'active'])->name('service.active');
        Route::resource('service', ServiceClientController::class)->except('index', 'show', 'destroy');

        Route::get('/appointment/list', [AppointmentClientController::class, 'list'])->name('appointment.list');
        Route::get('/appointment/{service}/create', [AppointmentClientController::class, 'create'])->name('appointment.create');
        Route::post('/appointment/{service}', [AppointmentClientController::class, 'store'])->name('appointment.store');
        Route::get('/appointment/{appointment}/edit', [AppointmentClientController::class, 'edit'])->name('appointment.edit');
        Route::patch('/appointment/{appointment}', [AppointmentClientController::class, 'update'])->name('appointment.update');

        Route::get('/notification', [NotificationController::class, 'index'])->name('notification.index');
        Route::post('notification/read/{notifications?}', [NotificationController::class, 'read'])->name('notification.read');

        Route::get('/profile/{user}', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile/{user}', [ProfileController::class, 'update'])->name('profile.update');
    });

    Route::get('/service/{service}', ServiceShowController::class)->name('service.show');
    Route::get('/appointment/{appointment}', AppointmentShowController::class)->name('appointment.show');
});


require __DIR__ . '/auth.php';
