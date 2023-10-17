<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ServiceClientController;
use App\Http\Controllers\Auth\DashboardController;
use App\Http\Controllers\Admin\TechnicianController;
use App\Http\Controllers\AppointmentClientController;

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

    Route::middleware('role:admin')->group(function () {
        Route::resource('technician', TechnicianController::class)->parameters([
            'technician' => 'user'
        ]);
    });

    Route::middleware('role:client')->group(function () {
        Route::get('/service/list', [ServiceClientController::class, 'list'])->name('service.list');
        Route::resource('service', ServiceClientController::class)->except('index', 'destroy');

        Route::get('/appointment/list', [AppointmentClientController::class, 'list'])->name('appointment.list');
        Route::get('/appointment/{appointment}', [AppointmentClientController::class, 'show'])->name('appointment.show');

        Route::get('/profile/{user}', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile/{user}', [ProfileController::class, 'update'])->name('profile.update');
    });
});


require __DIR__ . '/auth.php';
