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
            $leaves = Leave::with([
                'employee' => function ($q) {
                    $q->select('id', 'user_id')->with('user:id,name');
                },
                'leaveType:id,category'
            ])->get();
        } else {
            $leaves = Leave::with([
                'employee' => function ($q) {
                    $q->select('id', 'user_id')->with('user:id,name');
                },
                'leaveType:id,category'
            ])->where('employee_id', auth()->user()->employee->id)->get();
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

    public function edit(Leave $leave)
    {
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

    public function update(Request $request, Leave $leave)
    {
        $validatedData = $request->validate([
            'employee_id'   => 'required',
            'leave_type_id' => 'required',
            'leave_status' => 'required',
            'start_date'     => 'nullable|date',
            'end_date'       => 'nullable|date',
            'total_days' => 'required|numeric',
            'reason'        => 'nullable|string|max:1000',
            'status'        => 'nullable|in:pending,approved,rejected',
        ]);

        if ($validatedData['leave_status'] === 'full day') {
            $validatedData['end_date'] = null;
        } elseif ($validatedData['leave_status'] === 'half day') {
            $validatedData['start_date'] = null;
            $validatedData['end_date'] = null;
        }

        $leave->update($validatedData);

        return response()->json(['message' => 'Leave updated successfully'], 200);
    }
    

    public function store(Request $request)
    {
        if (auth()->user()->hasRole('super-admin')) {
            $validatedData = $request->validate([
                'employee_id' => 'required',
            ]);
            $employee_id = $request->employee_id;
        } else {
            $employee = Employee::where('user_id', auth()->id())->first();

            if (!$employee) {
                return response()->json(['error' => 'Employee not found'], 404);
            }

            $employee_id = $employee->id;
        }
        $validatedData = $request->validate([
            'leave_type_id' => 'required',
            'leave_status' => 'required',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date',
            'total_days' => 'required|numeric',
            'status' => 'required',
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
        $leave->status = 'pending';
        $leave->reason = $request->reason;
        $leave->save();

        return response()->json(['message' => 'Leave created successfully'], 200);
    }

    public function changeStatus(Request $request, Leave $leave)
    {
        if (!auth()->user()->hasRole('super-admin')) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $validatedData = $request->validate([
            'status' => 'required|in:approved,rejected',
        ]);

        if ($leave->status == 'approved' && $validatedData['status'] == 'rejected') {
            return response()->json(['error' => 'Cannot change status from approved to rejected'], 403);
        }

        $leave->status = $validatedData['status'];
        $leave->save();

        return response()->json(['message' => 'Leave status updated successfully', 'status' => $leave->status], 200);
    }
}
