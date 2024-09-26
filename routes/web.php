<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TicketController;

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



Auth::routes();

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::middleware(['auth'])->group(function () {
    Route::get('/get-tickets', [HomeController::class, 'getTickets'])->name('get_tickets');
    Route::get('/closed-tickets', [HomeController::class, 'closedTicket'])->name('home.closed_ticket');

    Route::group(array('prefix' => '/admin', 'middleware' => ['admin']), function () {
        Route::post('/update/ticket-status', [TicketController::class, 'updateTicketStatus'])->name('update_ticket_status');
        Route::get('/customers', [HomeController::class, 'customers'])->name('home.customers');
    });
    Route::group(array('prefix' => '/customer', 'middleware' => ['customer']), function () {
        Route::resource('ticket', TicketController::class);
    });
});


