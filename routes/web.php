<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
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

Route::get('/', function () {
    return redirect()->route('login');
})->name('/');


// Guest Users
Route::middleware(['guest', 'PreventBackHistory', 'firewall.all'])->group(function () {
    Route::get('login', [App\Http\Controllers\Admin\AuthController::class, 'showLogin'])->name('login');
    Route::post('login', [App\Http\Controllers\Admin\AuthController::class, 'login'])->name('signin');
    Route::get('register', [App\Http\Controllers\Admin\AuthController::class, 'showRegister'])->name('register');
    Route::post('register', [App\Http\Controllers\Admin\AuthController::class, 'register'])->name('signup');
});




// Authenticated users
Route::middleware(['auth', 'PreventBackHistory', 'firewall.all'])->group(function () {

    // Auth Routes
    Route::get('home', fn () => redirect()->route('dashboard'))->name('home');
    Route::get('dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard');
    Route::post('logout', [App\Http\Controllers\Admin\AuthController::class, 'Logout'])->name('logout');
    Route::get('change-theme-mode', [App\Http\Controllers\Admin\DashboardController::class, 'changeThemeMode'])->name('change-theme-mode');
    Route::get('show-change-password', [App\Http\Controllers\Admin\AuthController::class, 'showChangePassword'])->name('show-change-password');
    Route::post('change-password', [App\Http\Controllers\Admin\AuthController::class, 'changePassword'])->name('change-password');



    // Masters
    Route::resource('wards', App\Http\Controllers\Admin\Masters\WardController::class);
    Route::resource('departments', App\Http\Controllers\Admin\Masters\DepartmentController::class);
    Route::resource('rti', App\Http\Controllers\Admin\RTI\RTIController::class);

    // appeals routes
    Route::get('first-appeal/{id}', [App\Http\Controllers\Admin\RTI\RTIController::class, 'first_appeal'])->name('first_appeal');
    Route::post('first-appeal/store', [App\Http\Controllers\Admin\RTI\RTIController::class, 'store_first_appeal'])->name('store_first_appeal');
    Route::get('second-appeal/{id}', [App\Http\Controllers\Admin\RTI\RTIController::class, 'second_appeal'])->name('second_appeal');
    Route::post('second-appeal/store', [App\Http\Controllers\Admin\RTI\RTIController::class, 'store_second_appeal'])->name('store_second_appeal');

    Route::get('first-appeal', [App\Http\Controllers\Admin\RTI\RTIController::class, 'first_appeal_list'])->name('first_appeal_list');
    Route::get('second-appeal', [App\Http\Controllers\Admin\RTI\RTIController::class, 'second_appeal_list'])->name('second_appeal_list');

    // rti approve
    Route::post('/rti/approve', [App\Http\Controllers\Admin\RTI\RTIController::class, 'approve_rti'])->name('rti.approve');
    Route::post('/rti/transfer', [App\Http\Controllers\Admin\RTI\RTIController::class, 'transfer_rti'])->name('rti.transfer');
    Route::post('/rti/store/note', [App\Http\Controllers\Admin\RTI\RTIController::class, 'store_note'])->name('store.note');

    Route::get('/view-transfer-details/{rtiId}', [App\Http\Controllers\Admin\RTI\RTIController::class, 'view_transfer_Details'])->name('view_transfer_Details');

    Route::get('/view-note/{rtiId}', [App\Http\Controllers\Admin\RTI\RTIController::class, 'view_note'])->name('view_note');






    // Users Roles n Permissions
    Route::resource('users', App\Http\Controllers\Admin\UserController::class);
    Route::get('users/{user}/toggle', [App\Http\Controllers\Admin\UserController::class, 'toggle'])->name('users.toggle');
    Route::get('users/{user}/retire', [App\Http\Controllers\Admin\UserController::class, 'retire'])->name('users.retire');
    Route::put('users/{user}/change-password', [App\Http\Controllers\Admin\UserController::class, 'changePassword'])->name('users.change-password');
    Route::get('users/{user}/get-role', [App\Http\Controllers\Admin\UserController::class, 'getRole'])->name('users.get-role');
    Route::put('users/{user}/assign-role', [App\Http\Controllers\Admin\UserController::class, 'assignRole'])->name('users.assign-role');
    Route::resource('roles', App\Http\Controllers\Admin\RoleController::class);
});




Route::get('/php', function (Request $request) {
    if (!auth()->check())
        return 'Unauthorized request';

    Artisan::call($request->artisan);
    return dd(Artisan::output());
});
