<?php

use App\Http\Controllers\TicketController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('index');
// });
// Route::resource('/ticket',TicketController::class)->names('ticket');
Route::get('/create',[TicketController::class,'create'])->name('ticket.create');
Route::post('/store',[TicketController::class,'store'])->name('ticket.store');
Route::get('/',[TicketController::class,'index'])->name('index');

