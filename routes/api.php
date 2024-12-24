<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\Api\AuthApiController;
use App\Http\Controllers\Api\CompanyApiController;
use App\Http\Controllers\Api\EmployeeApiController;


# Clear Cache
Artisan::call('cache:clear');
Artisan::call('route:clear');
Artisan::call('view:clear');
Artisan::call('config:clear');

Route::post('login', [AuthApiController::class, 'login']);

Route::middleware('auth:sanctum')->group(function(){

    # Company
    Route::apiResource('/companies', CompanyApiController::class);
    Route::post('/companies-update/{id}', [CompanyApiController::class,'updateCompany']);

    # Employees
    Route::apiResource('/employees', EmployeeApiController::class);
    Route::post('/employees-update/{id}', [EmployeeApiController::class,'updateEmployee']);

    # User
    Route::get('users', [AuthApiController::class,'getUsers']);
    Route::post('register', [AuthApiController::class, 'register']);
});
