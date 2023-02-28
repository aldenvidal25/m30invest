<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Backend\TransactionController as BackendTransactionController;
use App\Http\Controllers\Backend\InvestmentController;
use App\Http\Controllers\Frontend\TransactionController;
use App\Http\Controllers\Frontend\DashboardController;
use App\Http\Controllers\Frontend\DepositController;
use App\Http\Controllers\Frontend\GatewayController;
use App\Http\Controllers\Frontend\IndexController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Home\HomeSliderController;

// use App\Http\Controllers\TransactionController;
use App\Http\Middleware\RedirectIfAuthenticated;
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

// Route::get('/', function () {
//     return view('frontend.index');
// });

//Show Login Page - edit later
// Route::get('/', function () {
//     return view('auth.login');
// });1

//Guests
Route::get('/', [IndexController::class, 'Index']);

// Route::middleware(['auth'])->group(function () {

//     Route::get('/dashboard', [UserController::class, 'UserDashboard'])->name('dashboard');

//     Route::post('/user/profile/store', [UserController::class, 'UserProfileStore'])->name('user.profile.store');

//     Route::get('/user/logout', [UserController::class, 'UserLogout'])->name('user.logout');

//     Route::post('/user/update/password', [UserController::class, 'UserUpdatePassword'])->name('user.update.password');
// });
//END GUESTS                               


//////////////////////////////////////////////////////////////////
// USER ROUTES //                             
//////////////////////////////////////////////////////////////////////-->
Route::group(['middleware' => ['auth', 'role:user'], 'prefix' => 'user', 'as' => 'user.'], function () {

    Route::get('dashboard', [DashboardController::class, 'dashboard'])->name('dashboard'); //user dashboard

    Route::group(['prefix' => 'deposit', 'as' => 'deposit.'], function () {

        Route::get('', [DepositController::class, 'deposit'])->name('amount');

        Route::post('now', [DepositController::class, 'depositNow'])->name('now');
    });
});

Route::middleware(['auth', 'role:user'])->group(function () {
    Route::get('user/deposit-log', [DepositController::class, 'depositLog'])->name('log');
    Route::get('user/withdraw-log', [DepositController::class, 'withdrawLog'])->name('withdrawLog');
    // Route::get('/user/dashboard', [UserController::class, 'UserDashboard'])->name('user.dashboard'); //user dashboard

    Route::get('/user/logout', [UserController::class, 'UserDestroy'])->name('user.logout');

    Route::get('/user/profile', [UserController::class, 'UserProfile'])->name('user.profile');

    Route::post('/user/profile/store', [UserController::class, 'UserProfileStore'])->name('user.profile.store');

    Route::get('/user/change/password', [UserController::class, 'UserChangePassword'])->name('user.change.password');

    Route::post('/user/update/password', [UserController::class, 'UserUpdatePassword'])->name('user.update.password');

    //Deposit Group 'Add Money'
    Route::group(['prefix' => 'user', 'as' => 'user.'], function () {

        //deposit

        //transactions
        Route::get('transactions', [TransactionController::class, 'transactions'])->name('transactions');
    });
});
require __DIR__ . '/auth.php';
// END USERS //  

//Admin
Route::middleware(['auth', 'role:admin'])->group(function () {

    // Route::get('transactions/{id?}', [BackendTransactionController::class, 'transactions'])->name('admin.transactions');

    Route::get('/admin/dashboard', [AdminController::class, 'AdminDashboard'])->name('admin.dashboard');

    Route::get('/admin/logout', [AdminController::class, 'AdminDestroy'])->name('admin.logout');

    Route::get('/admin/profile', [AdminController::class, 'AdminProfile'])->name('admin.profile');

    Route::get('/admin/transactions', [BackendTransactionController::class, 'transactions'])->name('admin.transactions');

    Route::get('admin/depositlog', [InvestmentController::class, 'investlog'])->name('admin.depositlog');

    Route::get('admin/payouts', [InvestmentController::class, 'payouts'])->name('admin.payouts');

    // Route::get('admin/profile/edit', [AdminController::class, 'AdminEditProfile'])->name('admin.edit.profile'); // TO DELETE

    Route::get('/admin/profile/changepassword', [AdminController::class, 'AdminChangePassword'])->name('admin.change.password');

    Route::post('/store/profile', [AdminController::class, 'AdminProfileStore'])->name('admin.profile.store');

    Route::post('/admin/updatepassword', [AdminController::class, 'AdminUpdatePassword'])->name('admin.update.password');
});


Route::get('/admin/login', [AdminController::class, 'AdminLogin']);

Route::get('/user/login', [UserController::class, 'UserLogin'])->name('user.login');

// Route::post('/user/register', [UserController::class, 'UserRegister'])->name('user.register');
// Route::get('/user/login', [UserController::class, 'UserLogin'])->name('user.login');

// Home Slide All Route 
Route::controller(HomeSliderController::class)->group(function () {
    Route::get('/home/slide', 'HomeSlider')->name('home.slide');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

//Paypal Route
Route::post('paypal/payment', [GatewayController::class, 'payment'])->name('paypal.payment');

Route::get('paypal/success', [GatewayController::class, 'success'])->name('paypal.success');
Route::get('paypal/cancel', [GatewayController::class, 'cancel'])->name('paypal.cancel');
