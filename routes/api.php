<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\BasketsController;
use App\Http\Controllers\BranchesController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\DiscountController;
use App\Http\Controllers\DiscountsController;
use App\Http\Controllers\DistrictsController;
use App\Http\Controllers\LocationsController;
use App\Http\Controllers\LoveliesController;
use App\Http\Controllers\OrderProductsController;
use App\Http\Controllers\OrdersController;
use App\Http\Controllers\PaymentsController;
use App\Http\Controllers\PayTypesController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\RegionsController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SubCategoriesController;
use App\Http\Controllers\UserRuleController;
use App\Http\Controllers\UsersController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post('/login', [UsersController::class, 'login']);
Route::post('/registration', [UsersController::class, 'registration']);




Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/user_for_admin', [AdminController::class, 'userForAdmin']);
    Route::get('/order_for_admin', [AdminController::class, 'orderForAdmin']);
    Route::get('/product_for_admin', [AdminController::class, 'productForAdmin']);
    Route::get('/category_for_admin', [AdminController::class, 'categoryForAdmin']);
    Route::resource('user', UsersController::class);
    Route::resource('category', CategoriesController::class);
    Route::resource('sub_category', SubCategoriesController::class);
    Route::resource('basket', BasketsController::class);
    Route::resource('branch', BranchesController::class);
    Route::resource('discount', DiscountsController::class);
    Route::resource('district', DistrictsController::class);
    Route::resource('location', LocationsController::class);
    Route::resource('lovely', LoveliesController::class);
    Route::resource('order_product', OrderProductsController::class);
    Route::resource('order', OrdersController::class);
    Route::resource('pay_type', PayTypesController::class);
    Route::resource('product', ProductsController::class);
    Route::resource('region', RegionsController::class);
    Route::resource('role', RoleController::class);
    Route::resource('user_rule', UserRuleController::class);
    Route::resource('payment', PaymentsController::class);
});
