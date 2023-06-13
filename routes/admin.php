<?php

use App\Http\Controllers\Admin\AssetController;
use App\Http\Controllers\Admin\AssetModelController;
use App\Http\Controllers\Admin\AssetSetsController;
use App\Http\Controllers\Admin\AssetTypeController;
use App\Http\Controllers\Admin\BranchController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\DetailsInputController;
use App\Http\Controllers\Admin\DetailsOutputController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\InputController;
use App\Http\Controllers\Admin\OutputController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ProductTypeController;
use App\Http\Controllers\Admin\ProviderController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Livewire\Admin\DetailsInputsIndex;
use App\Http\Livewire\Admin\DetailsOutputsIndex;
use App\Http\Livewire\Admin\InputCreate;
use App\Http\Livewire\Admin\StockBranchIndex;

Route::get('', [HomeController::class, 'index']);

Route::resource('users', UserController::class)->names('admin.users');
Route::resource('branches', BranchController::class)->names('admin.branches'); 
Route::resource('providers', ProviderController::class)->names('admin.providers'); 
Route::resource('customers', CustomerController::class)->names('admin.customers');
Route::resource('asset_types', AssetTypeController::class)->names('admin.asset_types');
Route::resource('asset_models', AssetModelController::class)->names('admin.asset_models');
Route::resource('assets', AssetController::class)->names('admin.assets');
Route::resource('product_types', ProductTypeController::class)->names('admin.product_types'); 
Route::resource('products', ProductController::class)->names('admin.products');
Route::resource('inputs', InputController::class)->names('admin.inputs');
Route::resource('outputs', OutputController::class)->names('admin.outputs');
Route::resource('detalles-inputs', DetailsInputController::class)->names('admin.detalles-inputs');
Route::resource('detalles-outputs', DetailsOutputController::class)->names('admin.detalles-outputs');
Route::resource('asset_sets', AssetSetsController::class)->names('admin.asset_sets');


Route::view('products_branch', 'admin.products_branch.index')->name('products_branch');

Route::get('details-inputs/{input_id}', DetailsInputsIndex::class)->name('details_inputs');
Route::get('details-outputs/{output_id}', DetailsOutputsIndex::class)->name('details_outputs');

Route::get('qrcode/{url}', [AssetController::class, 'qrcode'])->name('qrcode');
