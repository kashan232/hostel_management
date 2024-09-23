<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ComplainController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\FloorController;
use App\Http\Controllers\GuestController;
use App\Http\Controllers\GuestDashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\NoticeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\SeatSetupController;
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
// all code deploy
// Github Connected
// code deploy
Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', [HomeController::class, 'home'])->middleware(['auth'])->name('home');

// Staff
Route::get('/staff', [StaffController::class, 'staff'])->middleware(["auth"])->name('staff');
Route::post('/store-staff', [StaffController::class, 'store_staff'])->name('store-staff');
Route::get('/staff-salary', [StaffController::class, 'staff_salary'])->middleware(["auth"])->name('staff-salary');
Route::post('/store-staff-salary', [StaffController::class, 'store_staff_salary'])->name('store-staff-salary');
Route::get('/staff-salary', [StaffController::class, 'staff_salary'])->middleware(["auth"])->name('staff-salary');
Route::get('/staff-update/{id}', [StaffController::class, 'staff_update'])->name('staff-update');
Route::get('/delete-staff/{id}', [StaffController::class, 'delete_staff'])->name('delete-staff');
Route::get('/update-staff-salary', [StaffController::class, 'update_staff_salary'])->name('update-staff-salary');
Route::get('/delete-staff-salary/{id}', [StaffController::class, 'delete_staff_salary'])->name('delete-staff-salary');



Route::get('/services-create', [ServiceController::class, 'services_create'])->name('services-create');
Route::post('/store-services', [ServiceController::class, 'store_services'])->name('store-services');
Route::get('/services', [ServiceController::class, 'services'])->name('services');
Route::get('/service-update/{id}', [ServiceController::class, 'service_update'])->name('service-update');
Route::get('/delete-service/{id}', [ServiceController::class, 'delete_service'])->name('delete-service');

Route::get('/floor-create', [FloorController::class, 'floor_create'])->name('floor-create');
Route::post('/store-floor', [FloorController::class, 'store_floor'])->name('store-floor');
Route::get('/floors', [FloorController::class, 'floors'])->name('floors');
Route::get('/floors-update/{id}', [FloorController::class, 'floors_update'])->name('floors-update');
Route::get('/delete-floors/{id}', [FloorController::class, 'delete_floors'])->name('delete-floors');


Route::get('/room-create', [RoomController::class, 'room_create'])->name('room-create');
Route::post('/store-room', [RoomController::class, 'store_room'])->name('store-room');
Route::get('/rooms', [RoomController::class, 'rooms'])->name('rooms');
Route::post('/update-room', [RoomController::class, 'updateRoom']);
Route::get('/delete-room/{id}', [RoomController::class, 'delete_room'])->name('delete-room');


Route::get('/seat-setup-create', [SeatSetupController::class, 'seat_setup_create'])->name('seat-setup-create');
Route::post('/store-seat-setup', [SeatSetupController::class, 'store_seat_setup'])->name('store-seat-setup');
Route::get('/seat-setup', [SeatSetupController::class, 'seat_setup'])->name('seat-setup');
Route::get('/get-rooms/{floorId}', [SeatSetupController::class, 'getRooms']);
Route::post('/update-seat', [SeatSetupController::class, 'updateSeat']);
Route::get('/delete-seat/{id}', [SeatSetupController::class, 'delete_seat'])->name('delete-seat');



Route::get('/guest-create', [GuestController::class, 'guest_create'])->name('guest-create');
Route::get('/guests', [GuestController::class, 'guests'])->name('guests');
Route::get('/get-rooms', [GuestController::class, 'get_rooms'])->name('get-rooms');
Route::get('/get-seats', [GuestController::class, 'getSeats'])->name('get-seats');
Route::post('/store-guest', [GuestController::class, 'store_guest'])->name('store-guest');
Route::post('/guest/add-service', [GuestController::class, 'addService'])->name('guest.addService');
Route::post('/end-booking', [GuestController::class, 'endBooking'])->name('endBooking');
Route::get('/edit-guest/{id}', [GuestController::class, 'edit_guest'])->name('edit-guest');
Route::post('/update-guest/{id}', [GuestController::class, 'update_guest'])->name('update-guest');


Route::get('/guest-invoice', [InvoiceController::class, 'guest_invoice'])->name('guest-invoice');
Route::get('/generate-invoice/{guest_id}', [InvoiceController::class, 'generateInvoice'])->name('generate-invoice');
Route::post('/store-payment/{invoice}', [InvoiceController::class, 'store_payment'])->name('store-payment');
Route::get('/invoices-paid', [InvoiceController::class, 'showPaidInvoices'])->name('invoices-paid');

Route::get('/admin-complains', [HomeController::class, 'admin_complains'])->name('admin-complains');
Route::get('/view-admin-complains/{id}', [HomeController::class, 'view_admin_complains'])->name('view-admin-complains');
Route::post('/action-on-complaint', [HomeController::class, 'action_on_complaint'])->name('action-on-complaint');


Route::get('/expense-create', [ExpenseController::class, 'expense_create'])->name('expense-create');
Route::post('/store-expense', [ExpenseController::class, 'store_expense'])->name('store-expense');
Route::get('/expense', [ExpenseController::class, 'expense'])->name('expense');
Route::post('/update-expense', [ExpenseController::class, 'update'])->name('expense.update');
Route::get('/delete-expense/{id}', [ExpenseController::class, 'delete_expense'])->name('delete-expense');


Route::get('/inventory-create', [InventoryController::class, 'inventory_create'])->name('inventory-create');
Route::post('/store-inventory', [InventoryController::class, 'store_inventory'])->name('store-inventory');
Route::get('/inventory', [InventoryController::class, 'inventory'])->name('inventory');
Route::post('/update-inventory', [InventoryController::class, 'update'])->name('inventory.update');
Route::get('/delete-inventory/{id}', [InventoryController::class, 'delete_inventory'])->name('delete-inventory');


Route::get('/notices-create', [NoticeController::class, 'notices_create'])->name('notices-create');
Route::post('/store-notices', [NoticeController::class, 'store_notices'])->name('store-notices');
Route::get('/notices', [NoticeController::class, 'notices'])->name('notices');


// Guest routes

Route::get('/invoice-of-guests', [GuestDashboardController::class, 'invoice_of_guests'])->name('invoice-of-guests');
Route::get('/view-invoice/{guest_id}', [GuestDashboardController::class, 'view_invoice'])->name('view-invoice');
Route::get('/invoices-paid-guest', [GuestDashboardController::class, 'invoices_paid_guest'])->name('invoices-paid-guest');

Route::get('/geust-notices', [GuestDashboardController::class, 'geust_notices'])->name('geust-notices');

Route::get('/complain-form', [ComplainController::class, 'complain_form'])->name('complain-form');
Route::post('/store-complain', [ComplainController::class, 'store_complain'])->name('store-complain');
Route::get('/complains', [ComplainController::class, 'complains'])->name('complains');



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