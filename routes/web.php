<?php

use App\Http\Controllers\Admin\CustomerController as AdminCustomerController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\EventController as AdminEventController;
use App\Http\Controllers\Admin\OrganizerController as AdminOrganizerController;
use App\Http\Controllers\Admin\ReportController as AdminReportController;
use App\Http\Controllers\Auth\AdminAuthController;
use App\Http\Controllers\Auth\CustomerAuthController;
use App\Http\Controllers\Auth\OrganizerAuthController;
use App\Http\Controllers\Customer\BookingController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\Organizer\DashboardController as OrganizerDashboardController;
use App\Http\Controllers\Organizer\EventController as OrganizerEventController;
use Illuminate\Support\Facades\Route;

// Public: Browse events
Route::get('/', [EventController::class, 'index'])->name('events.index');
Route::get('/events/{event}', [EventController::class, 'show'])->name('events.show');

// Public: Legal pages
Route::view('/privacy-policy', 'legal.privacy')->name('privacy');
Route::view('/terms', 'legal.terms')->name('terms');

// Customer: Register / Login
Route::get('/register', [CustomerAuthController::class, 'showRegister'])->name('customer.register');
Route::post('/register', [CustomerAuthController::class, 'register']);
Route::get('/login', [CustomerAuthController::class, 'showLogin'])->name('customer.login');
Route::post('/login', [CustomerAuthController::class, 'login']);
Route::post('/logout', [CustomerAuthController::class, 'logout'])->name('customer.logout');

// Customer: Book Tickets / Make Payments / View Booking History / Cancel Booking
Route::middleware('role:customer,customer.login')->prefix('my')->name('customer.')->group(function () {
    Route::get('/bookings', [BookingController::class, 'index'])->name('bookings.index');
    Route::post('/bookings', [BookingController::class, 'store'])->name('bookings.store');
    Route::post('/bookings/{booking}/cancel', [BookingController::class, 'cancel'])->name('bookings.cancel');
});

// Organizer: Login
Route::get('/organizer/login', [OrganizerAuthController::class, 'showLogin'])->name('organizer.login');
Route::post('/organizer/login', [OrganizerAuthController::class, 'login']);
Route::post('/organizer/logout', [OrganizerAuthController::class, 'logout'])->name('organizer.logout');

// Organizer: Add Event / Update Event Details / View Booking For Their Events
Route::middleware('role:organizer,organizer.login')->prefix('organizer')->name('organizer.')->group(function () {
    Route::get('/dashboard', [OrganizerDashboardController::class, 'index'])->name('dashboard');
    Route::get('/events/create', [OrganizerEventController::class, 'create'])->name('events.create');
    Route::post('/events', [OrganizerEventController::class, 'store'])->name('events.store');
    Route::get('/events/{event}/edit', [OrganizerEventController::class, 'edit'])->name('events.edit');
    Route::put('/events/{event}', [OrganizerEventController::class, 'update'])->name('events.update');
    Route::get('/events/{event}/bookings', [OrganizerEventController::class, 'bookings'])->name('events.bookings');
});

// Admin: Login
Route::get('/admin/login', [AdminAuthController::class, 'showLogin'])->name('admin.login');
Route::post('/admin/login', [AdminAuthController::class, 'login']);
Route::post('/admin/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');

// Admin: Manage Events / Manage Users / View Reports / Assign Roles
Route::middleware('role:web,admin.login')->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
    Route::resource('events', AdminEventController::class)->except(['show']);
    Route::resource('customers', AdminCustomerController::class)->except(['show']);
    Route::resource('organizers', AdminOrganizerController::class)->except(['show']);
    Route::get('/reports', [AdminReportController::class, 'index'])->name('reports.index');
});
