<?php

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

Route::get('/', fn () => redirect()->to(route('login')));

Auth::routes();
Route::name('admin.')->prefix('admin')->middleware('auth')->group(function (): void {
    // Dashboard
    Route::get('/dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard');

    // User
    Route::resource('user', App\Http\Controllers\Admin\User\UserController::class);
    Route::get('users/activities', App\Http\Controllers\Admin\User\UserActivityController::class)->name('user.activity');

    Route::resource('categories', App\Http\Controllers\Admin\CategoryController::class)->except('show');

    Route::resource('category-attributes', App\Http\Controllers\Admin\CategoryAttributeController::class)->except('show');

    Route::resource('products', App\Http\Controllers\Admin\ProductController::class)->except('show');
    Route::post('products/category-attributes/{category}', [App\Http\Controllers\Admin\ProductController::class, 'categoryAttributes'])->name('products.category-attributes');

});
