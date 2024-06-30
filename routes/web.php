<?php

use App\Livewire\ContactCreateUpdate;
use Illuminate\Support\Facades\Route;
use App\Livewire\ContactList;
use App\Livewire\AuditTrail;
use App\Livewire\WebSocket;
use App\Livewire\RestoreContact;
use App\Http\Controllers\WebSocketController;
use App\Http\Controllers\AuthController;


// Route::get('/LogIn', [AuthController::class, 'LogIn']);
Route::post('/Registers', [AuthController::class, 'Register']);

Route::post('/login', [AuthController::class, 'login']);
Route::get('/logout', [AuthController::class, 'logout']);

Route::get('/', function () {
    return view('pages/login');
})->name('login');




Route::middleware('auth:sanctum')->group(function () {
    Route::get('/CreateUpdateContact/{action}/{id?}', ContactCreateUpdate::class);
    Route::get('/ContactList', ContactList::class);
    Route::get('/AuditTrail', AuditTrail::class);
    Route::get('/WebSocket', WebSocket::class);
    Route::get('/RestoreContact', RestoreContact::class);
    Route::get('/processEvent', [WebSocketController::class, 'processEvent']);
});
