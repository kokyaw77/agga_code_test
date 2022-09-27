<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TicketBoxController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [TicketBoxController::class, 'index'])->name('ticket.box');

Route::post('/tickets/store', [TicketBoxController::class, 'store'])->name('tickets.store');

Route::middleware('auth:web')->group(function() {

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::resource('users', UserController::class)->except('show');

    Route::resource('tickets', TicketController::class)->except('show', 'create', 'store');

});

require __DIR__.'/auth.php';
