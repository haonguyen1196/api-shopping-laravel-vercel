<?php

use App\Http\Controllers\Admincontroller;
use App\Http\Controllers\AdminPermissionController;
use App\Http\Controllers\AdminProductController;
use App\Http\Controllers\AdminRolesController;
use App\Http\Controllers\AdminSettingController;
use App\Http\Controllers\AdminSliderController;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\MenuController;
use Illuminate\Support\Facades\Route;

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

Route::get('/admin', [Admincontroller::class, 'loginAdmin']);
Route::post('/admin', [Admincontroller::class, 'postLoginAdmin']);

Route::get('/home', function () {
    return view('home');
})->name('home');

Route::prefix('admin')->as('admin.')->group(function () {
    Route::prefix('categories')->as('categories.')->group(function () {
        Route::get('/', [CategoryController::class, 'index']
        )->name('index')->middleware('can:category-list');
    
        Route::get('create', [CategoryController::class, 'create']
        )->name('create')->middleware('can:category-add');
    
        Route::post('store', [CategoryController::class, 'store']
        )->name('store')->middleware('can:category-add');
    
        Route::get('edit/{id}', [CategoryController::class, 'edit']
        )->name('edit')->middleware('can:category-edit');

        Route::post('update/{id}', [CategoryController::class, 'update']
        )->name('update')->middleware('can:category-edit');
    
    
        Route::get('delete/{id}', [CategoryController::class, 'delete']
        )->name('delete')->middleware('can:category-delete');
    });
    
    Route::prefix('menus')->as('menus.')->group(function () {
        Route::get('/', [MenuController::class, 'index']
        )->name('index')->middleware('can:menu-list');
    
        Route::get('create', [MenuController::class, 'create']
        )->name('create')->middleware('can:menu-add');
    
        Route::post('store', [MenuController::class, 'store']
        )->name('store')->middleware('can:menu-add');
    
        Route::get('edit/{id}', [MenuController::class, 'edit']
        )->name('edit')->middleware('can:menu-edit');
    
        Route::post('update/{id}', [MenuController::class, 'update']
        )->name('update')->middleware('can:menu-edit');
    
        Route::get('delete/{id}', [MenuController::class, 'delete']
        )->name('delete')->middleware('can:menu-delete');
    });

    Route::prefix('product')->as('product.')->group(function () {
        Route::get('/', [AdminProductController::class, 'index']
        )->name('index')->middleware('can:product-list');

        Route::get('create', [AdminProductController::class, 'create']
        )->name('create')->middleware('can:product-add');

        Route::post('store', [AdminProductController::class, 'store']
        )->name('store')->middleware('can:product-add');

        Route::get('edit/{id}', [AdminProductController::class, 'edit']
        )->name('edit')->middleware('can:product-edit,id');

        Route::post('update/{id}', [AdminProductController::class, 'update']
        )->name('update')->middleware('can:product-edit,id');

        Route::get('delete/{id}', [AdminProductController::class, 'delete']
        )->name('delete')->middleware('can:product-delete');
    });

    Route::prefix('slider')->name('slider.')->group(function () {
        Route::get('/', [AdminSliderController::class, 'index']
        )->name('index')->middleware('can:slider-list');

        Route::get('create', [AdminSliderController::class, 'create']
        )->name('create')->middleware('can:slider-add');

        Route::post('store', [AdminSliderController::class, 'store']
        )->name('store')->middleware('can:slider-add');

        Route::get('edit/{id}', [AdminSliderController::class, 'edit']
        )->name('edit')->middleware('can:slider-edit');

        Route::post('update/{id}', [AdminSliderController::class, 'update']
        )->name('update')->middleware('can:slider-edit');

        Route::get('delete/{id}', [AdminSliderController::class, 'delete']
        )->name('delete')->middleware('can:slider-delete');
    });

    Route::prefix('setting')->name('setting.')->group(function () {
        Route::get('/', [AdminSettingController::class, 'index']
        )->name('index')->middleware('can:setting-list');

        Route::get('create', [AdminSettingController::class, 'create']
        )->name('create')->middleware('can:setting-add');

        Route::post('store', [AdminSettingController::class, 'store']
        )->name('store')->middleware('can:setting-add');

        Route::get('edit/{id}', [AdminSettingController::class, 'edit']
        )->name('edit')->middleware('can:setting-edit');

        Route::post('update/{id}', [AdminSettingController::class, 'update']
        )->name('update')->middleware('can:setting-edit');

        Route::get('delete/{id}', [AdminSettingController::class, 'delete']
        )->name('delete')->middleware('can:setting-delete');
    });

    Route::prefix('user')->name('user.')->group(function () {
        Route::get('/', [AdminUserController::class, 'index']
        )->name('index')->middleware('can:user-list');

        Route::get('create', [AdminUserController::class, 'create']
        )->name('create')->middleware('can:user-add');

        Route::post('store', [AdminUserController::class, 'store']
        )->name('store')->middleware('can:user-add'); 

        Route::get('edit/{id}', [AdminUserController::class, 'edit']
        )->name('edit')->middleware('can:user-edit');

        Route::post('update/{id}', [AdminUserController::class, 'update']
        )->name('update')->middleware('can:user-edit'); 

        Route::get('delete/{id}', [AdminUserController::class, 'delete']
        )->name('delete')->middleware('can:user-delete');
    });

    Route::prefix('role')->name('role.')->group(function () {
        Route::get('/', [AdminRolesController::class, 'index']
        )->name('index')->middleware('can:role-list');
        
        Route::get('create', [AdminRolesController::class, 'create']
        )->name('create')->middleware('can:role-add');
        
        Route::post('store', [AdminRolesController::class, 'store']
        )->name('store')->middleware('can:role-add');
        
        Route::get('edit/{id}', [AdminRolesController::class, 'edit']
        )->name('edit')->middleware('can:role-edit');
        
        Route::post('update/{id}', [AdminRolesController::class, 'update']
        )->name('update')->middleware('can:role-edit');
        
        Route::get('delete/{id}', [AdminRolesController::class, 'delete']
        )->name('delete')->middleware('can:role-delete');
    });

    Route::prefix('permission')->name('permission.')->group(function () {
        Route::get('/create', [AdminPermissionController::class, 'create']
        )->name('create');

        Route::post('/store', [AdminPermissionController::class, 'store']
        )->name('store');
    });
});

