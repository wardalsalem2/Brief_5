<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\OwnerProfileController;
use App\Http\Controllers\AdminOwnerController;
use App\Http\Controllers\BookingController;
use Illuminate\Support\Facades\Route;

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

// Route::get('/', function () {
//     return view('auth.login&reg');
// })->name('login');




// Route::get('/detailse', function () {
//     return view('user.details');
// });

// Route::get('/chalets', function () {
//     return view('user.chalets');
// });
//---------------------------------------------------------------------------

//ward + sondos //

Route::middleware(['role:user'])
->group(function () {

Route::get('/chalets/{chaletId}/book', [BookingController::class, 'showBookingForm'])->name('bookings.create');
Route::post('/chalets/{chaletId}/book', [BookingController::class, 'createBooking'])->name('bookings.store');

Route::resource('profile_user', UserController::class)->only(['index', 'update']);    //for profail user
Route::delete('profile_user/cancelBooking/{id}', [UserController::class, 'cancelBooking'])
    ->name('profile_user.cancelBooking');

Route::post('/add-comment', [StoreController::class, 'addComment'])->name('add.comment');   //for user pages 
Route::get('/chalets', [StoreController::class, 'showingAllChalets'])->name('showingAllChalets');
Route::get('/chalets/{chalet}', [StoreController::class, 'showDetails'])->name('showChalet');
Route::get('/contact', [StoreController::class, 'contact'])->name('contact');
Route::post('/contact', [StoreController::class, 'storeContact'])->name('contact.store');


Route::get('/payment', [BookingController::class, 'showPaymentPage'])->name('payment.page');  //for payment
Route::post('/confirm-payment', [BookingController::class, 'confirmPayment'])->name('confirm.payment');
Route::get('/chalets/{chaletId}', [StoreController::class, 'showChalet'])->name('chalet.show');

});
//---------------------------------------------------------------------------
// raghad //

Route::get('/', function () {
    return view('auth.login_reg'); 
})->name('login');
Route::get('/register', function () {
    return view('auth.login_reg');
})->name('register');  
Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


Route::get('/admin/dashbord', [AdminOwnerController::class, 'index'])
    ->middleware('role:admin')
    ->name('admin.dashbord');



Route::get('/home', [UserController::class, 'showhome'])    
    ->middleware('role:user')
    ->name('user.home');


    Route::middleware(['role:owner'])
        ->group(function () {
           
            Route::get('/owner/dashboard', [OwnerProfileController::class, 'index'])->name('Owner.dashboard');
            Route::get('/Owner', [OwnerProfileController::class, 'index'])->name('Owner.index');
            Route::get('/Owner/create', [OwnerProfileController::class, 'create'])->name('Owner.create');
            Route::post('/Owner/store', [OwnerProfileController::class, 'store'])->name('Owner.store');
            Route::get('/Owner/edit/{id}', [OwnerProfileController::class, 'edit'])->name('Owner.edit');
            Route::put('/owner/chalets/{id}', [OwnerProfileController::class, 'update'])->name('Owner.update');
            Route::delete('/Owner/{id}', [OwnerProfileController::class, 'destroy'])->name('Owner.destroy');
            Route::get('/owner/chalets{id}', [OwnerProfileController::class, 'show'])->name('Owner.show');
            Route::get('/Owner/chalet/{id}/booking', [OwnerProfileController::class, 'showChaletBooking'])->name('Owner.chaletBooking');
        });

    