<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\DocumentController;
use App\Http\Livewire\CreateUser;
use App\Http\Livewire\EditUser;
use App\Http\Livewire\TicketDetail;
use App\Http\Livewire\Users;

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




Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
    'role:Administrator|Worker',
])->group(function () {
    Route::get('/', function () {
        return view('welcome');
    })->name('panel');

    Route::prefix('users')->group(function (){
        Route::get('/', Users::class)->name('users');
        Route::get('/create', CreateUser::class)->name('users.create');
        Route::get('/edit/{id}', EditUser::class)->name('users.edit');
    });

    Route::prefix('tickets')->group(function (){
        Route::get('/details/{id}', TicketDetail::class)->name('ticket.detail');
    });

    Route::get('/tickets/new', [TicketController::class, 'create'])->name('ticket.new');
    Route::get('/tickets/consulta', [TicketController::class, 'consulta'])->name('ticket.consulta');
    Route::post('/tickets', [TicketController::class, 'store'])->name('ticket.nuevo_ticket');
    Route::get('/tickets/show/{ticket}', [TicketController::class, 'show'])->name('ticket.show');

    // documentos
    Route::get('/documentos', [DocumentController::class, 'index'])->name('documents.index');
    Route::get('/resultados', [DocumentController::class, 'results'])->name('documents.results');
    Route::post('/documentos', [DocumentController::class, 'store'])->name('documentos.subirarchivos');
});




Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
