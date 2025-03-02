<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OwnerProfileController;
use App\Http\Controllers\ChaletController;






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

Route::get('/', function () {
    return view('auth.login&reg');
});




Route::get('/Owner', [OwnerProfileController::class, 'index'])->name('Owner.index');
Route::get('/Owner/create', [OwnerProfileController::class, 'create'])->name('Owner.create');
Route::post('/Owner/store', [OwnerProfileController::class, 'store'])->name('Owner.store');
Route::get('/Owner/edit/{id}', [OwnerProfileController::class, 'edit'])->name('Owner.edit'); // يجب أن تكون GET هنا لعرض نموذج التعديل
Route::put('/owner/chalets/{id}', [OwnerProfileController::class, 'update'])->name('Owner.update');
Route::delete('/Owner/{id}', [OwnerProfileController::class, 'destroy'])->name('Owner.destroy'); // يجب أن تكون DELETE هنا لحذف الشاليه
Route::get('/Owner/chalet/{id}/booking', [OwnerProfileController::class, 'showChaletBooking'])->name('Owner.chalethBooking');

    

