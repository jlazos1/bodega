<?php

use App\Http\Controllers\Admin\AssetTypeController;
use App\Http\Controllers\Admin\BranchController;
use App\Http\Controllers\Admin\CustomerController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\ProviderController;
use App\Http\Controllers\Admin\UserController;

Route::get('', [HomeController::class, 'index']);

Route::resource('users', UserController::class)->names('admin.users');
Route::resource('branches', BranchController::class)->names('admin.branches'); 
Route::resource('providers', ProviderController::class)->names('admin.providers'); 
Route::resource('customers', CustomerController::class)->names('admin.customers');
Route::resource('asset_types', AssetTypeController::class)->names('admin.asset_types'); 

