<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\EmployeeSalary;
use Illuminate\Http\Request;

class EmployeeSalaryController extends Controller
{

    public function index()
    {
        $employee_salaries = EmployeeSalary::with([
            'employee' => function ($q) {
                $q->select('id', 'user_id')->with([
                    'user' => function ($q) {
                        $q->select('id', 'name');
                    }
                ]);
            }
        ])->get();

        return view('backend.employee_salaries.index', compact('employee_salaries'));
    }

    public function create()
    {
        $employee_salary = new EmployeeSalary();
        $employees = Employee::with(['user:id,name'])->get();
        return view('backend.employee_salaries.form', compact('employee_salary', 'employees'));
    }

    public function store(Request $request)
    {
        $validatedData = validator($request->all(), [
            'employee_id' => 'required|exists:employees,id|unique:employee_salaries,employee_id',
            'basic_salary' => 'required|numeric',
            'commission_type' => 'required|in:fixed,percentage,none',
        ]);

        if ($validatedData->fails()) {
            return response()->json(['errors' => $validatedData->errors()], 422);
        }

        $employee_salary = new EmployeeSalary();
        $employee_salary->employee_id = $request->employee_id;
        $employee_salary->basic_salary = $request->basic_salary;
        $employee_salary->commission_type = $request->commission_type;
        $employee_salary->save();

        return response()->json(['message' => 'Salary created successfully'], 200);
    }

    public function edit(EmployeeSalary $employee_salary)
    {
        $employees = Employee::with(['user:id,name'])->get();
        return view('backend.employee_salaries.form', compact('employee_salary', 'employees'));
    }

    public function update(Request $request, EmployeeSalary $employee_salary)
    {
        $validatedData = validator($request->all(), [
            'employee_id' => 'required|exists:employees,id|unique:employee_salaries,employee_id,' . $employee_salary->id,
            'basic_salary' => 'required|numeric|min:1',
            'commission_type' => 'required|in:fixed,percentage,none',
        ]);

        if ($validatedData->fails()) {
            return response()->json(['errors' => $validatedData->errors()], 422);
        }

        $employee_salary->employee_id = $request->employee_id;
        $employee_salary->basic_salary = $request->basic_salary;
        $employee_salary->commission_type = $request->commission_type;
        $employee_salary->save();

        return response()->json(['message' => 'Salary updated successfully'], 200);
    }

    public function destroy(EmployeeSalary $employee_salary)
    {
        $employee_salary->delete();
        return response()->json(['message' => 'Salary delete successfully'], 200);
    }
}
