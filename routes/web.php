<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\DocumentController;


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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/tickets/new', [TicketController::class, 'create'])->name('ticket.new');
Route::get('/tickets/consulta', [TicketController::class, 'consulta'])->name('ticket.consulta');
Route::post('/tickets', [TicketController::class, 'store'])->name('ticket.nuevo_ticket');
Route::get('/tickets/show/{ticket}', [TicketController::class, 'show'])->name('ticket.show');

// documentos
Route::get('/documentos', [DocumentController::class, 'index'])->name('documents.index');
Route::get('/resultados', [DocumentController::class, 'results'])->name('documents.index');
Route::post('/documentos',[DocumentController::class, 'store'])->name('documentos.subirarchivos');
