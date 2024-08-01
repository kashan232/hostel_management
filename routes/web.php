<?php

use App\Http\Controllers\FloorController;
use App\Http\Controllers\GuestController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\ServiceController;
use Illuminate\Support\Facades\Route;

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
// Github Connected
Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', [HomeController::class, 'home'])->middleware(['auth'])->name('home');

Route::get('/floor-create', [FloorController::class, 'floor_create'])->name('floor-create');
Route::get('/floors', [FloorController::class, 'floors'])->name('floors');


Route::get('/room-create', [RoomController::class, 'room_create'])->name('room-create');
Route::get('/rooms', [RoomController::class, 'rooms'])->name('rooms');



Route::get('/guest-create', [GuestController::class, 'guest_create'])->name('guest-create');
Route::get('/guests', [GuestController::class, 'guests'])->name('guests');

Route::get('/services-create', [ServiceController::class, 'services_create'])->name('services-create');
Route::get('/services', [ServiceController::class, 'services'])->name('services');



Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
