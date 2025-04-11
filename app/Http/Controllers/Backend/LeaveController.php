<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\Leave;
use App\Models\LeaveType;
use Illuminate\Http\Request;

class LeaveController extends Controller
{
    public function index()
    {
        if (auth()->user()->hasRole('super-admin')) {
            $leaves = Leave::with('employee.user')->get();
        }else{
            $leaves = Leave::where('employee_id', auth()->user()->employee->id)->with('employee.user')->get();
        }
        return view('backend.leaves.index', compact('leaves'));
    }
    public function create()
    {
        $leave = new Leave();

        $leave_type_id = LeaveType::select('id', 'category', 'gender_specific')->get();

        if (auth()->user()->hasRole('super-admin')) {
            $users = Employee::with('user:id,name')->get();
        } else {
            $employee = Employee::select('id', 'user_id')->where('user_id', auth()->id())->with('user:id,name')->first();

            if ($employee) {
                $users = collect([$employee]);
            } else {
                $users = collect();
            }
        }

        return view('backend.leaves.form', compact('leave', 'users', 'leave_type_id'));
    }

    // public function store(Request $request)
    // {
    //     $validatedDate = validator($request->all(), [
    //         'employee_id' => 'required',
    //         'leave_type_id' => 'required',
    //         'leave_status' => 'required',
    //         'start_date' => 'nullable',
    //         'end_date' => 'nullable',
    //         'total_days' => 'required|numeric',
    //         'status' => 'required',
    //         'reason' => 'required|string|max:255',
    //     ]);

    //     if ($validatedDate->fails()) {
    //         return response()->json(['errors' => $validatedDate->errors()], 422);
    //     }

    //     $employee = Employee::find($request->employee_id);
    //     if (!$employee) {
    //         return response()->json(['error' => 'Employee not found'], 404);
    //     }

    //     $leaveType = LeaveType::find($request->leave_type_id);
    //     if (!$leaveType) {
    //         return response()->json(['error' => 'Leave type not found'], 404);
    //     }

    //     $employeeGender = strtolower(trim($employee->gender));
    //     $genderSpecific = $leaveType->gender_specific;

    //     if ($genderSpecific == 1) {
    //         if ($employeeGender !== strtolower(trim($leaveType->applicable_for))) {
    //             return response()->json(['error' => 'This leave type is not applicable for your gender'], 403);
    //         }
    //     }


    //     $leave = new Leave();
    //     $leave->employee_id = $request->employee_id;
    //     $leave->leave_type_id = $request->leave_type_id;
    //     $leave->leave_status = $request->leave_status;
    //     $leave->start_date = $request->start_date;
    //     $leave->end_date = $request->end_date;
    //     $leave->total_days = $request->total_days;
    //     $leave->reason = $request->reason;
    //     $leave->save();

    //     return response()->json(['message' => 'Leave created successfully'], 200);
    // }

    public function store(Request $request)
    {
        // Agar super-admin hai toh employee_id required hai
        // Agar nahi hai, toh request mein employee_id ignore karenge
        if (auth()->user()->hasRole('super-admin')) {
            $validatedData = $request->validate([
                'employee_id' => 'required|exists:employees,id',
            ]);
            $employee_id = $request->employee_id;
        } else {
            // Logged-in user ka employee record lo
            $employee = Employee::where('user_id', auth()->id())->first();
    
            if (!$employee) {
                return response()->json(['error' => 'Employee not found'], 404);
            }
    
            $employee_id = $employee->id;
        }
    
        // Baaki validation
        $validatedData = $request->validate([
            'leave_type_id' => 'required|exists:leave_types,id',
            'leave_status' => 'required',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date',
            'total_days' => 'required|numeric',
            'status' => 'required|in:pending,approved,rejected',
            'reason' => 'required|string|max:255',
        ]);
    
        // Gender validation
        $employee = Employee::find($employee_id);
        $leaveType = LeaveType::find($request->leave_type_id);
    
        if ($leaveType->gender_specific == 1) {
            $employeeGender = strtolower(trim($employee->gender));
            $applicableFor = strtolower(trim($leaveType->applicable_for));
    
            if ($employeeGender !== $applicableFor) {
                return response()->json(['error' => 'This leave type is not applicable for your gender'], 403);
            }
        }
    
        // Save leave
        $leave = new Leave();
        $leave->employee_id = $employee_id;
        $leave->leave_type_id = $request->leave_type_id;
        $leave->leave_status = $request->leave_status;
        $leave->start_date = $request->start_date;
        $leave->end_date = $request->end_date;
        $leave->total_days = $request->total_days;
        $leave->status = $request->status;
        $leave->reason = $request->reason;
        $leave->save();
    
        return response()->json(['message' => 'Leave created successfully'], 200);
    }
    
}
