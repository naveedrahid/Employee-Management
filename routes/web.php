<?php

use App\Http\Controllers\Backend\BranchController;
use App\Http\Controllers\Backend\DepartmentController;
use App\Http\Controllers\Backend\PermissionController;
use App\Http\Controllers\Backend\RoleController;
use App\Http\Controllers\Backend\UserController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;



// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

Route::group(['prefix' => 'backend', 'as' => 'backend.', 'middleware' => ['auth']], function () {

    // Permissions Routes
    Route::group(['prefix' => 'permissions'], function(){
        Route::get('/', [PermissionController::class, 'index'])->middleware('permission:view permission')->name('permissions.index');
        Route::get('/create', [PermissionController::class, 'create'])->middleware('permission:create permission')->name('permissions.create');
        Route::post('/', [PermissionController::class, 'store'])->middleware('permission:create permission')->name('permissions.store');
        Route::get('/{permission}/edit', [PermissionController::class, 'edit'])->middleware('permission:update permission')->name('permissions.edit');
        Route::put('/{permission}', [PermissionController::class, 'update'])->middleware('permission:update permission')->name('permissions.update');
        Route::delete('/{permission}', [PermissionController::class, 'destroy'])->middleware('permission:delete permission')->name('permissions.destroy');
        Route::get('/{permissionId}/delete', [PermissionController::class, 'destroy'])->middleware('permission:delete permission');
    });

    // Roles Routes

    Route::group(['prefix' => 'roles'], function () {
        Route::get('/', [RoleController::class, 'index'])->middleware('permission:view role')->name('roles.index');
        Route::get('/create', [RoleController::class, 'create'])->middleware('permission:create role')->name('roles.create');
        Route::post('/', [RoleController::class, 'store'])->middleware('permission:create role')->name('roles.store');
        Route::get('/{role}/edit', [RoleController::class, 'edit'])->middleware('permission:update role')->name('roles.edit');
        Route::put('/{role}', [RoleController::class, 'update'])->middleware('permission:update role')->name('roles.update');
        Route::delete('/{role}', [RoleController::class, 'destroy'])->middleware('permission:delete role')->name('roles.destroy');
        Route::get('/{roleId}/delete', [RoleController::class, 'destroy'])->middleware('permission:delete role');
        Route::get('/{roleId}/give-permissions', [RoleController::class, 'addPermissionToRole'])->middleware('permission:update role');
        Route::put('/{roleId}/give-permissions', [RoleController::class, 'givePermissionToRole'])->middleware('permission:update role');
    });
        

    // Users Routes
    Route::group(['prefix' => 'users'], function(){ 
        Route::get('/', [UserController::class, 'index'])->middleware('permission:view user')->name('users.index');
        Route::get('/create', [UserController::class, 'create'])->middleware('permission:create user')->name('users.create');
        Route::post('/', [UserController::class, 'store'])->middleware('permission:create user')->name('users.store');
        Route::get('/{user}/edit', [UserController::class, 'edit'])->middleware('permission:update user')->name('users.edit');
        Route::put('/{user}', [UserController::class, 'update'])->middleware('permission:update user')->name('users.update');
        Route::delete('/{user}', [UserController::class, 'destroy'])->middleware('permission:delete user')->name('users.destroy');

        Route::get('/{userId}/delete', [UserController::class, 'destroy'])->middleware('permission:delete user');
    });

    // branches routes
    Route::group(['prefix' => 'branches'], function(){ 
        Route::get('/', [BranchController::class, 'index'])->middleware('permission:view branch')->name('branches.index');
        Route::get('/create', [BranchController::class, 'create'])->middleware('permission:create branch')->name('branches.create');
        Route::post('/', [BranchController::class, 'store'])->middleware('permission:create branch')->name('branches.store');
        Route::get('/{branch}/edit', [BranchController::class, 'edit'])->middleware('permission:update branch')->name('branches.edit');
        Route::put('/{branch}', [BranchController::class, 'update'])->middleware('permission:update branch')->name('branches.update');
        Route::delete('/{branch}', [BranchController::class, 'destroy'])->middleware('permission:delete branch')->name('branches.destroy');
    });

    // Department routes
    Route::group(['prefix' => 'departments'], function(){ 
        Route::get('/', [DepartmentController::class, 'index'])->middleware('permission:view department')->name('department.index');
        Route::get('/create', [DepartmentController::class, 'create'])->middleware('permission:create department')->name('department.create');
        Route::post('/', [DepartmentController::class, 'store'])->middleware('permission:create department')->name('department.store');
        Route::get('/{department}/edit', [DepartmentController::class, 'edit'])->middleware('permission:update department')->name('department.edit');
        Route::put('/{department}', [DepartmentController::class, 'update'])->middleware('permission:update department')->name('department.update');
        Route::delete('/{department}', [DepartmentController::class, 'destroy'])->middleware('permission:delete department')->name('department.destroy');
    });

    // // Home/Dashboard
    Route::get('/', [HomeController::class, 'index'])->name('home')->middleware('permission:view dashboard');
});
