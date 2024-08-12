<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\FloorController;
use App\Http\Controllers\GuestController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\StaffController;
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

// Staff
Route::get('/staff', [StaffController::class, 'staff'])->middleware(["auth"])->name('staff');
Route::post('/store-staff', [StaffController::class, 'store_staff'])->name('store-staff');
Route::get('/staff-salary', [StaffController::class, 'staff_salary'])->middleware(["auth"])->name('staff-salary');
Route::post('/store-staff-salary', [StaffController::class, 'store_staff_salary'])->name('store-staff-salary');

Route::get('/services-create', [ServiceController::class, 'services_create'])->name('services-create');
Route::post('/store-services', [ServiceController::class, 'store_services'])->name('store-services');
Route::get('/services', [ServiceController::class, 'services'])->name('services');


Route::get('/floor-create', [FloorController::class, 'floor_create'])->name('floor-create');
Route::post('/store-floor', [FloorController::class, 'store_floor'])->name('store-floor');
Route::get('/floors', [FloorController::class, 'floors'])->name('floors');


Route::get('/room-create', [RoomController::class, 'room_create'])->name('room-create');
Route::post('/store-room', [RoomController::class, 'store_room'])->name('store-room');
Route::get('/rooms', [RoomController::class, 'rooms'])->name('rooms');



Route::get('/guest-create', [GuestController::class, 'guest_create'])->name('guest-create');
Route::get('/guests', [GuestController::class, 'guests'])->name('guests');


Route::get('/expense-create', [ExpenseController::class, 'expense_create'])->name('expense-create');
Route::post('/store-expense', [ExpenseController::class, 'store_expense'])->name('store-expense');
Route::get('/expense', [ExpenseController::class, 'expense'])->name('expense');


Route::get('/inventory-create', [InventoryController::class, 'inventory_create'])->name('inventory-create');
Route::post('/store-inventory', [InventoryController::class, 'store_inventory'])->name('store-inventory');
Route::get('/inventory', [InventoryController::class, 'inventory'])->name('inventory');



Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';


// Muhammad Soban Here