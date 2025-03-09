<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Branch;
use App\Models\City;
use App\Models\Country;
use App\Models\Department;
use App\Models\Employee;
use App\Models\Position;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $employees = Employee::with([
            'user:id,name,email',
        ])->select('id', 'user_id', 'gender', 'image', 'status')->where('status', 'active')->get();

        return view('backend.employees.index', compact('employees'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $employee = new Employee();

        $employeeData = [
            'users' => User::select('id', 'name')->get(),
            'branches' => Branch::select('id', 'name')->get(),
            'departments' => Department::select('id', 'name')->get(),
            'positions' => Position::select('id', 'name')->get(),
            'cities' => City::select('id', 'name', 'country_id')->get(),
            'countries' => Country::select('id', 'name')->get(),
        ];

        return view('backend.employees.form', compact('employee', 'employeeData'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = validator($request->all(), [
            'user_id' => 'required|exists:users,id|unique:employees,user_id',
            'branch_id' => 'required|exists:branches,id',
            'department_id' => 'required|exists:departments,id',
            'position_id' => 'required|exists:positions,id',
            'country_id' => 'required|exists:countries,id',
            'city_id' => 'required|exists:cities,id',
            'employment_type' => 'required|in:full-time,part-time,contract,probationary',
            'position_status' => 'required|in:intern,junior,senior,lead',
            'joining_date' => 'required|date',
            'dob' => 'nullable|date',
            'address' => 'required|string|max:255',
            'gender' => 'required|in:male,female',
            'marital_status' => 'required|in:married,single,divorced,widowed',
            'status' => 'required|in:active,inactive',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ])->validate();

        if (Employee::where('user_id', $validatedData['user_id'])->exists()) {
            return response()->json(['error' => 'User already exists as an employee'], 409);
        }

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $originalName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
            $extension = $file->getClientOriginalExtension();
            $timestamp = now()->format('YmdHis');
            $fileName = $originalName . '-' . $timestamp . '.' . $extension;
            $imagePath = $file->storeAs('employees', $fileName, 'public');
            $validatedData['image'] = $imagePath;
        }

        Employee::create($validatedData);

        return response()->json(['message' => 'Employee created successfully'], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(Employee $employee)
    {
        $employee->load([
            'user:id,name,email',
            'branch:id,name,city_id,country_id',
            'department:id,name,branch_id',
            'position:id,name,department_id',
            'city:id,name,country_id',
            'country:id,name',
        ])->where('status', 'active')->get();

        return view('backend.employees.show', compact('employee'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Employee $employee)
    {
        $employeeData = [
            'users' => User::select('id', 'name')->get(),
            'branches' => Branch::select('id', 'name')->get(),
            'departments' => Department::select('id', 'name')->get(),
            'positions' => Position::select('id', 'name')->get(),
            'cities' => City::select('id', 'name', 'country_id')->get(),
            'countries' => Country::select('id', 'name')->get(),
        ];

        return view('backend.employees.form', compact('employee', 'employeeData'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Employee $employee)
    {
        $validatedData = validator($request->all(), [
            'user_id' => 'required|exists:users,id|unique:employees,user_id,' . $employee->id,
            'branch_id' => 'required|exists:branches,id',
            'department_id' => 'required|exists:departments,id',
            'position_id' => 'required|exists:positions,id',
            'country_id' => 'required|exists:countries,id',
            'city_id' => 'required|exists:cities,id',
            'employment_type' => 'required|in:full-time,part-time,contract,probationary',
            'position_status' => 'required|in:intern,junior,senior,lead',
            'joining_date' => 'required|date',
            'dob' => 'nullable|date',
            'address' => 'required|string|max:255',
            'gender' => 'required|in:male,female',
            'marital_status' => 'required|in:married,single,divorced,widowed',
            'status' => 'required|in:active,inactive',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ])->validate();

        if (Employee::where('user_id', $validatedData['user_id'])->where('id', '!=', $employee->id)->exists()) {
            return response()->json(['error' => 'User already exists as an employee'], 409);
        }

        if ($request->hasFile('image')) {
            if (!empty($employee->image) && Storage::disk('public')->exists($employee->image)) {
                Storage::disk('public')->delete($employee->image);
            }

            $file = $request->file('image');
            $fileName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME) . '-' . now()->format('YmdHis') . '.' . $file->getClientOriginalExtension();
            $imagePath = $file->storeAs('employees', $fileName, 'public');

            $validatedData['image'] = $imagePath;
        } else {
            $validatedData['image'] = $employee->image;
        }

        $employee->update($validatedData);

        return response()->json(['message' => 'Employee updated successfully'], 200);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Employee $employee)
    {
        $employee->delete();
        return response()->json(['message' => 'Employee deleted successfully'], 200);
    }
}
