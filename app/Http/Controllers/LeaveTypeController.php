<?php

namespace App\Http\Controllers;

use App\Models\LeaveType;
use Illuminate\Http\Request;

class LeaveTypeController extends Controller
{
    public function index(){
        $leave_types = LeaveType::get();
        return view('backend.leave_types.index', compact('leave_types'));
    }

    public function create()
    {
        $leave_type = new LeaveType();
        return view('backend.leave_types.form', compact('leave_type'));
    }

    public function store(Request $request)
    {
        $validatedData = validator($request->all(), [
            'name' => 'required|string|unique:leave_types,name',
            'category' => 'required|in:sick,casual,earned,unpaid,maternity,paternity,religious,annual',
            'max_days' => 'required|integer',
            'gender_specific' => 'required|boolean',
            'aplicable_for' => 'required|in:all,male,female',
        ]);

        if($validatedData->fails()){
            return response()->json(['message' => $validatedData->errors()->first()], 422);
        }
        $leave_type = new LeaveType();
        $leave_type->name = $request->name;
        $leave_type->category = $request->category;
        $leave_type->max_days = $request->max_days;
        $leave_type->gender_specific = $request->gender_specific;
        $leave_type->aplicable_for = $request->aplicable_for;
        $leave_type->save();
        return response()->json(['message' => 'Leave Type created successfully'], 200);
    }

    public function edit(LeaveType $leave_type){
        return view('backend.leave_types.form', compact('leave_type'));
    }

    public function update(Request $request, LeaveType $leave_type){
        $validatedData = validator($request->all(),[
            'name' => 'required|string|unique:leave_types,name,'.$leave_type->id,
            'category' => 'required|in:sick,casual,earned,unpaid,maternity,paternity,religious,annual',
            'max_days' => 'required|integer',
            'gender_specific' => 'required|boolean',
            'aplicable_for' => 'required|in:all,male,female',
        ]);

        if ($validatedData->fails()) {
            return response()->json(['message' => $validatedData->errors()->first()], 422);
        }
        $leave_type->name = $request->name;
        $leave_type->category = $request->category;
        $leave_type->max_days = $request->max_days;
        $leave_type->gender_specific = $request->gender_specific;
        $leave_type->aplicable_for = $request->aplicable_for;
        $leave_type->save();
        return response()->json(['message' => 'Leave Type updated successfully'], 200);
    }

    public function destroy(LeaveType $leave_type){
        $leave_type->delete();
        return response()->json(['message' => 'Leave Type deleted successfully'], 200);
    }
}
