<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\OwnerProfileController;
use App\Http\Controllers\AdminOwnerController;
use App\Http\Controllers\BookingController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomAuthController;
use App\Http\Controllers\Admin\UserController as AdminUserController; 
use App\Http\Controllers\Admin\ChaletController as AdminChaletController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;  
use App\Http\Controllers\Admin\BookingController as AdminBookingController;
use App\Http\Controllers\Admin\ReviewController as AdminReviewController;
use App\Http\Controllers\Admin\ReportsController as AdminReportsController;


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

// صفحة الـ login
Route::get('/', function () {
    return view('auth.login_reg'); 
})->name('login');

// صفحة التسجيل
Route::get('/register', function () {
    return view('auth.login_reg');
})->name('register');  

// الـ POST الخاص بتسجيل الدخول
Route::post('/login', [CustomAuthController::class, 'login']);

// الـ POST الخاص بالتسجيل
Route::post('/register', [CustomAuthController::class, 'register']);

// الـ GET الخاص بالـ logout
Route::get('/logout', [CustomAuthController::class, 'logout'])->name('logout');

// صفحة الـ contact
Route::get('/contact', function () {
    return view('component.contact');
})->name('contact');

// صفحات الـ Admin
Route::get('/admin/dashbord', [AdminOwnerController::class, 'index'])
    ->middleware('role:admin')
    ->name('admin.dashbord');

// صفحات الـ Owner
Route::get('/owner/dashbord', [OwnerProfileController::class, 'index'])
    ->middleware('role:owner')
    ->name('owner.dashbord');

// صفحات الـ User
Route::get('/user/index', [UserController::class, 'index'])
    ->middleware('role:user')
    ->name('user.index');


Route::get('/index', function () {
    return view('user.index');
});
Route::get('/detailse', function () {
    return view('user.details');
});
Route::get('/profaile', function () {
    return view('user.profaile');
});
Route::get('/chalets', function () {
    return view('user.chalets');}  
);
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


Route::get('admin/dashboard', [AdminDashboardController::class, 'index'])
    ->middleware('role:admin')
    ->name('admin.dashboard');



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
    
//hamzeh&omayma



Route::prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
    Route::get('/users', [AdminChaletController::class, 'index'])->name('admin.users.index');
    Route::put('/users/{id}', [AdminUserController::class, 'update'])->name('admin.users.update');
    Route::get('/users/index', [AdminUserController::class, 'index'])->name('admin.users.index');
    Route::get('/users/create', [AdminUserController::class, 'create'])->name('admin.users.create');
    Route::post('/users/store', [AdminUserController::class, 'store'])->name('admin.users.store');
    Route::get('/users/{id}', [AdminUserController::class, 'show'])->name('admin.users.show');
    Route::get('/users/index', [AdminUserController::class, 'index'])->name('admin.users.index');

    Route::get('/users/{id}/edit', [AdminUserController::class, 'edit'])->name('admin.users.edit');
    Route::put('/users/{id}', [AdminUserController::class, 'update'])->name('admin.users.edit');
    Route::delete('/users/{id}', [AdminUserController::class, 'destroy'])->name('admin.users.destroy');
    Route::post('/users/{id}/toggle-status', [AdminUserController::class, 'toggleStatus'])->name('admin.users.toggleStatus');

    Route::get('/reports', [AdminReportsController::class, 'index'])->name('admin.reports.index');

    Route::get('/bookings', [AdminBookingController::class, 'index'])->name('admin.bookings.index');
    Route::get('/bookings/{booking}/edit', [AdminBookingController::class, 'edit'])->name('admin.bookings.edit');
    Route::patch('/bookings/{booking}/status', [AdminBookingController::class, 'updateStatus'])->name('admin.bookings.updateStatus');
    Route::delete('/bookings/{booking}', [AdminBookingController::class, 'destroy'])->name('admin.bookings.destroy');

    Route::get('/reviews', [AdminReviewController::class, 'index'])->name('admin.reviews.index');
    Route::delete('/reviews/{id}', [AdminReviewController::class, 'destroy'])->name('admin.reviews.destroy');

    Route::get('/chalets', [AdminChaletController::class, 'index'])->name('admin.chalets.index');
    Route::get('/chalets/{id}/edit', [AdminChaletController::class, 'edit'])->name('admin.chalets.edit');
    Route::put('/chalets/{id}', [AdminChaletController::class, 'update'])->name('admin.chalets.update');
    Route::post('/chalets/{id}/toggle-status', [AdminChaletController::class, 'toggleStatus'])->name('admin.chalets.toggleStatus');
    Route::delete('/chalets/{id}', [AdminChaletController::class, 'destroy'])->name('admin.chalets.destroy');
    Route::get('chalets/{chalet}/approve', [AdminChaletController::class, 'approve'])->name('chalets.approve');
    Route::get('chalets/{chalet}/deactivate', [AdminChaletController::class, 'deactivate'])->name('chalets.deactivate');
});

    
