<?php

use App\Http\Controllers\Auth\Admin\AdminController;
use App\Http\Controllers\Auth\User\UserController as UserUserController;
use App\Http\Controllers\SettingController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SliderController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use UniSharp\LaravelFilemanager\Lfm;

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

Auth::routes();

//Login Admin
Route::get('/', [AdminController::class, 'login'])->name('admin.login');
Route::post('/postlogin', [AdminController::class, 'postLogin'])->name('admin.postLogin');

//Logout Admin
Route::get('/logout', [AdminController::class, 'logout'])->name('admin.logout');


Route::prefix('/admin')->group(function () {
    Route::get('/', function () {
        return view('admin.home');
    })->middleware(['auth'])->name('admin.home');



    Route::prefix('/categories')->group(function () {
        Route::get('/index', [CategoryController::class, 'index'])->name('categories.index')->middleware('can:list_category');
        Route::get('/create', [CategoryController::class, 'create'])->name('categories.create')->middleware('can:add_category');
        Route::post('/store', [CategoryController::class, 'store'])->name('categories.store');
        Route::get('/edit/{id}', [CategoryController::class, 'edit'])->name('categories.edit')->middleware('can:edit_category');
        Route::post('/update/{id}', [CategoryController::class, 'update'])->name('categories.update');
        Route::get('/delete/{id}', [CategoryController::class, 'delete'])->name('categories.delete')->middleware('can:delete_category');
    });


    Route::prefix('/menus')->group(function () {
        Route::get('/index', [MenuController::class, 'index'])->name('menus.index')->middleware('can:list_menu');
        Route::get('/create', [MenuController::class, 'create'])->name('menus.create')->middleware('can:add_menu');
        Route::post('/store', [MenuController::class, 'store'])->name('menus.store');
        Route::get('/edit/{id}', [MenuController::class, 'edit'])->name('menus.edit')->middleware('can:edit_menu');
        Route::post('/update/{id}', [MenuController::class, 'update'])->name('menus.update');
        Route::get('/delete/{id}', [MenuController::class, 'delete'])->name('menus.delete')->middleware('can:delete_menu');
    });

    Route::prefix('/products')->group(function () {
        Route::get('/index', [ProductController::class, 'index'])->name('products.index')->middleware('can:list_product');
        Route::get('/create', [ProductController::class, 'create'])->name('products.create')->middleware('can:add_product');
        Route::post('/store', [ProductController::class, 'store'])->name('products.store');
        Route::get('/edit/{id}', [ProductController::class, 'edit'])->name('products.edit')->middleware('can:edit_product,id');
        Route::post('/update/{id}', [ProductController::class, 'update'])->name('products.update');
        Route::get('/delete/{id}', [ProductController::class, 'delete'])->name('products.delete')->middleware('can:delete_product');
    });


    Route::prefix('/sliders')->group(function () {
        Route::get('/index', [SliderController::class, 'index'])->name('sliders.index');
        Route::get('/create', [SliderController::class, 'create'])->name('sliders.create');
        Route::post('/store', [SliderController::class, 'store'])->name('sliders.store');
        Route::get('/edit/{id}', [SliderController::class, 'edit'])->name('sliders.edit');
        Route::post('/update/{id}', [SliderController::class, 'update'])->name('sliders.update');
        Route::get('/delete/{id}', [SliderController::class, 'delete'])->name('sliders.delete');
    });


    // Route::prefix('/settings')->group(function () {
    //     Route::get('/index', [SettingController::class, 'index'])->name('settings.index');
    //     Route::get('/create', [SettingController::class, 'create'])->name('settings.create');
    // Route::post('/store', [ProductController::class, 'store'])->name('products.store');
    // Route::get('/edit/{id}', [ProductController::class, 'edit'])->name('products.edit');
    // Route::post('/update/{id}', [ProductController::class, 'update'])->name('products.update');
    // Route::get('/delete/{id}', [ProductController::class, 'delete'])->name('products.delete');
    // });


    Route::prefix('/users')->group(function () {
        Route::get('/index', [UserController::class, 'index'])->name('users.index')->middleware('can:list_user');
        Route::get('/create', [UserController::class, 'create'])->name('users.create')->middleware('can:add_user');
        Route::post('/store', [UserController::class, 'store'])->name('users.store');
        Route::get('/edit/{id}', [UserController::class, 'edit'])->name('users.edit')->middleware('can:edit_user');
        Route::post('/update/{id}', [UserController::class, 'update'])->name('users.update');
        Route::get('/delete/{id}', [UserController::class, 'delete'])->name('users.delete')->middleware('can:delete_user');
    });

    Route::prefix('/roles')->group(function () {
        Route::get('/index', [RoleController::class, 'index'])->name('roles.index');
        Route::get('/create', [RoleController::class, 'create'])->name('roles.create');
        Route::post('/store', [RoleController::class, 'store'])->name('roles.store');
        Route::get('/edit/{id}', [RoleController::class, 'edit'])->name('roles.edit');
        Route::post('/update/{id}', [RoleController::class, 'update'])->name('roles.update');
        Route::get('/delete/{id}', [RoleController::class, 'delete'])->name('roles.delete');
    });

    Route::prefix('/permissions')->group(function () {
        // Route::get('/index', [PermissionController::class, 'index'])->name('permissions.index');
        Route::get('/create', [PermissionController::class, 'create'])->name('permissions.create');
        Route::post('/store', [PermissionController::class, 'store'])->name('permissions.store');
        // Route::get('/edit/{id}', [PermissionController::class, 'edit'])->name('permissions.edit');
        // Route::post('/update/{id}', [PermissionController::class, 'update'])->name('permissions.update');
        // Route::get('/delete/{id}', [PermissionController::class, 'delete'])->name('permissions.delete');
    });
});