<?php

use App\Http\Controllers\Backend\AssetController;
use App\Http\Controllers\Backend\AttendanceController;
use App\Http\Controllers\Backend\BankDetailController;
use App\Http\Controllers\Backend\BranchController;
use App\Http\Controllers\Backend\CashRegisterController;
use App\Http\Controllers\Backend\DepartmentController;
use App\Http\Controllers\Backend\EmployeeController;
use App\Http\Controllers\Backend\EmployeeSalaryController;
use App\Http\Controllers\Backend\ExpenseController;
use App\Http\Controllers\Backend\LeaveController;
use App\Http\Controllers\Backend\PayrollController;
use App\Http\Controllers\Backend\PermissionController;
use App\Http\Controllers\Backend\PositionController;
use App\Http\Controllers\Backend\RoleController;
use App\Http\Controllers\Backend\UserController;
use App\Http\Controllers\Backend\LeaveTypeController;
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

    // Positions routes
    Route::group(['prefix' => 'positions'], function(){ 
        Route::get('/', [PositionController::class, 'index'])->middleware('permission:view position')->name('position.index');
        Route::get('/create', [PositionController::class, 'create'])->middleware('permission:create position')->name('position.create');
        Route::post('/', [PositionController::class, 'store'])->middleware('permission:create position')->name('position.store');
        Route::get('/{position}/edit', [PositionController::class, 'edit'])->middleware('permission:update position')->name('position.edit');
        Route::put('/{position}', [PositionController::class, 'update'])->middleware('permission:update position')->name('position.update');
        Route::delete('/{position}', [PositionController::class, 'destroy'])->middleware('permission:delete position')->name('position.destroy');
    });

    // Employee routes
    Route::group(['prefix' => 'employees'], function(){ 
        Route::get('/', [EmployeeController::class, 'index'])->middleware('permission:view employee')->name('employee.index');
        Route::get('/create', [EmployeeController::class, 'create'])->middleware('permission:create employee')->name('employee.create');
        Route::post('/', [EmployeeController::class, 'store'])->middleware('permission:create employee')->name('employee.store');
        Route::get('/{employee}', [EmployeeController::class, 'show'])->middleware('permission:view employee')->name('employee.show');
        Route::get('/{employee}/edit', [EmployeeController::class, 'edit'])->middleware('permission:update employee')->name('employee.edit');
        Route::put('/{employee}', [EmployeeController::class, 'update'])->middleware('permission:update employee')->name('employee.update');
        Route::delete('/{employee}', [EmployeeController::class, 'destroy'])->middleware('permission:delete employee')->name('employee.destroy');
    });

    // Bank Details routes
    Route::group(['prefix' => 'bank-details'], function(){ 
        Route::get('/', [BankDetailController::class, 'index'])->middleware('permission:view bank_detail')->name('bank_detail.index');
        Route::get('/create', [BankDetailController::class, 'create'])->middleware('permission:create bank_detail')->name('bank_detail.create');
        Route::post('/', [BankDetailController::class, 'store'])->middleware('permission:create bank_detail')->name('bank_detail.store');
        Route::get('/{bank_detail}', [BankDetailController::class, 'show'])->middleware('permission:view bank_detail')->name('bank_detail.show');
        Route::get('/{bank_detail}/edit', [BankDetailController::class, 'edit'])->middleware('permission:update bank_detail')->name('bank_detail.edit');
        Route::put('/{bank_detail}', [BankDetailController::class, 'update'])->middleware('permission:update bank_detail')->name('bank_detail.update');
        Route::delete('/{bank_detail}', [BankDetailController::class, 'destroy'])->middleware('permission:delete bank_detail')->name('bank_detail.destroy');
    });

    // Leave Type routes
    Route::group(['prefix' => 'leave-types'], function(){ 
        Route::get('/', [LeaveTypeController::class, 'index'])->middleware('permission:view leave_type')->name('leave_type.index');
        Route::get('/create', [LeaveTypeController::class, 'create'])->middleware('permission:create leave_type')->name('leave_type.create');
        Route::post('/', [LeaveTypeController::class, 'store'])->middleware('permission:create leave_type')->name('leave_type.store');
        Route::get('/{leave_type}/edit', [LeaveTypeController::class, 'edit'])->middleware('permission:update leave_type')->name('leave_type.edit');
        Route::put('/{leave_type}', [LeaveTypeController::class, 'update'])->middleware('permission:update leave_type')->name('leave_type.update');
        Route::delete('/{leave_type}', [LeaveTypeController::class, 'destroy'])->middleware('permission:delete leave_type')->name('leave_type.destroy');
    });

    // Leave routes
    Route::group(['prefix' => 'leaves'], function(){ 
        Route::get('/', [LeaveController::class, 'index'])->middleware('permission:view leave')->name('leave.index');
        Route::get('/create', [LeaveController::class, 'create'])->middleware('permission:create leave')->name('leave.create');
        Route::post('/', [LeaveController::class, 'store'])->middleware('permission:create leave')->name('leave.store');
        Route::get('/{leave}/edit', [LeaveController::class, 'edit'])->middleware('permission:update leave')->name('leave.edit');
        Route::put('/{leave}', [LeaveController::class, 'update'])->middleware('permission:update leave')->name('leave.update');
        Route::delete('/{leave}', [LeaveController::class, 'destroy'])->middleware('permission:delete leave')->name('leave.destroy');
        Route::post('/{leave}/change-status', [LeaveController::class, 'changeStatus'])->name('leave.changeStatus');
    });

    // Employee Salary routes
    Route::group(['prefix' => 'employee-salaries'], function(){ 
        Route::get('/', [EmployeeSalaryController::class, 'index'])->middleware('permission:view employee_salary')->name('employee_salary.index');
        Route::get('/create', [EmployeeSalaryController::class, 'create'])->middleware('permission:create employee_salary')->name('employee_salary.create');
        Route::post('/', [EmployeeSalaryController::class, 'store'])->middleware('permission:create employee_salary')->name('employee_salary.store');
        Route::get('/{employee_salary}/edit', [EmployeeSalaryController::class, 'edit'])->middleware('permission:update employee_salary')->name('employee_salary.edit');
        Route::put('/{employee_salary}', [EmployeeSalaryController::class, 'update'])->middleware('permission:update employee_salary')->name('employee_salary.update');
        Route::delete('/{employee_salary}', [EmployeeSalaryController::class, 'destroy'])->middleware('permission:delete employee_salary')->name('employee_salary.destroy');
    });

    // Payroll routes
    Route::group(['prefix' => 'payrolls'], function(){ 
        Route::get('/', [PayrollController::class, 'index'])->middleware('permission:view payroll')->name('payroll.index');
        Route::get('/create', [PayrollController::class, 'create'])->middleware('permission:create payroll')->name('payroll.create');
        Route::post('/', [PayrollController::class, 'store'])->middleware('permission:create payroll')->name('payroll.store');
        Route::get('/{payroll}/edit', [PayrollController::class, 'edit'])->middleware('permission:update payroll')->name('payroll.edit');
        Route::put('/{payroll}', [PayrollController::class, 'update'])->middleware('permission:update payroll')->name('payroll.update');
        Route::delete('/{payroll}', [PayrollController::class, 'destroy'])->middleware('permission:delete payroll')->name('payroll.destroy');
    });

    // Attendance routes
    Route::group(['prefix' => 'attendances'], function(){ 
        Route::post('/check-in', [AttendanceController::class, 'checkIn'])->middleware('permission:create check_in')->name('attendance.checkIn');
        Route::post('/check-out', [AttendanceController::class, 'checkOut'])->middleware('permission:create check_out')->name('attendance.checkOut');
        Route::get('/', [AttendanceController::class, 'index'])->middleware('permission:view attendance')->name('attendance.index');
        Route::get('/{attendance}', [AttendanceController::class, 'show'])->middleware('permission:view attendance')->name('attendance.show');
        // Route::get('/create', [AttendanceController::class, 'create'])->middleware('permission:create attendance')->name('attendance.create');
        // Route::post('/', [AttendanceController::class, 'store'])->middleware('permission:create attendance')->name('attendance.store');
        // Route::get('/{attendance}/edit', [AttendanceController::class, 'edit'])->middleware('permission:update attendance')->name('attendance.edit');
        // Route::put('/{attendance}', [AttendanceController::class, 'update'])->middleware('permission:update attendance')->name('attendance.update');
        // Route::delete('/{attendance}', [AttendanceController::class, 'destroy'])->middleware('permission:delete attendance')->name('attendance.destroy');
    });

        // Asset routes
        Route::group(['prefix' => 'assets'], function(){ 
            Route::get('/', [AssetController::class, 'index'])->middleware('permission:view asset')->name('asset.index');
            Route::get('/create', [AssetController::class, 'create'])->middleware('permission:create asset')->name('asset.create');
            Route::post('/', [AssetController::class, 'store'])->middleware('permission:create asset')->name('asset.store');
            Route::get('/{asset}/edit', [AssetController::class, 'edit'])->middleware('permission:update asset')->name('asset.edit');
            Route::put('/{asset}', [AssetController::class, 'update'])->middleware('permission:update asset')->name('asset.update');
            Route::delete('/{asset}', [AssetController::class, 'destroy'])->middleware('permission:delete asset')->name('asset.destroy');
        });

        // Cash Register routes
        Route::group(['prefix' => 'cash-registers'], function(){ 
            Route::get('/', [CashRegisterController::class, 'index'])->middleware('permission:view cash_register')->name('cash_register.index');
            Route::get('/create', [CashRegisterController::class, 'create'])->middleware('permission:create cash_register')->name('cash_register.create');
            Route::post('/', [CashRegisterController::class, 'store'])->middleware('permission:create cash_register')->name('cash_register.store');
            Route::get('/{cash_register}/edit', [CashRegisterController::class, 'edit'])->middleware('permission:update cash_register')->name('cash_register.edit');
            Route::put('/{cash_register}', [CashRegisterController::class, 'update'])->middleware('permission:update cash_register')->name('cash_register.update');
            Route::delete('/{cash_register}', [CashRegisterController::class, 'destroy'])->middleware('permission:delete cash_register')->name('cash_register.destroy');
        });
        
        // Expense routes
        Route::group(['prefix' => 'expenses'], function(){
            Route::get('/', [ExpenseController::class, 'index'])->middleware('permission:view expense')->name('expense.index');
            Route::get('/create', [ExpenseController::class, 'create'])->middleware('permission:create expense')->name('expense.create');
            Route::post('/', [ExpenseController::class, 'store'])->middleware('permission:create expense')->name('expense.store');
            Route::get('/{expense}/edit', [ExpenseController::class, 'edit'])->middleware('permission:update expense')->name('expense.edit');
            Route::put('/{expense}', [ExpenseController::class, 'update'])->middleware('permission:update expense')->name('expense.update');
            Route::delete('/{expense}', [ExpenseController::class, 'destroy'])->middleware('permission:delete expense')->name('expense.destroy');
        });

    // // Home/Dashboard
    Route::get('/', [HomeController::class, 'index'])->name('home')->middleware('permission:view dashboard');
});
