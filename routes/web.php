<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\ProfileController;






# Clear Cache
Artisan::call('cache:clear');
Artisan::call('route:clear');
Artisan::call('view:clear');
Artisan::call('config:clear');


Route::get('/', function () {
    // return view('welcome');
    return redirect(route('login'));
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth','admin'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    # Company
    Route::resource('/companies',CompanyController::class);

    # Employee
    Route::resource('/employees',EmployeeController::class);
});





# Dashboard
Route::get('/dashboard',[DashboardController::class,'dashboardData'])->name('dashboard');


require __DIR__.'/auth.php';
