<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Branch;
use App\Models\Department;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $departments = Department::with('branch')->get();
        return view('backend.departments.index', compact('departments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $department = new Department();
        $branches = Branch::with(['country', 'city'])->get();
        return view('backend.departments.form', compact('department', 'branches'));
    }
    
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = validator($request->all(), [
            'name' => 'required|string|max:255|unique:departments,name',
            'branch_id' => 'required|exists:branches,id',
        ]);

        if ($validatedData->fails()) {
            return response()->json(['errors' => $validatedData->errors()], 422);
        }
        
        $department = new Department();
        $department->name = $request->name;
        $department->branch_id = $request->branch_id;
        $department->save();

        return response()->json(['message' => 'Department created successfully', 200]);
    }
    
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }
    
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Department $department)
    {
        $branches = Branch::with(['country', 'city'])->get();
        return view('backend.departments.form', compact('department', 'branches'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Department $department)
    {
        $validatedData = validator($request->all(), [
            'name' => 'required|string|max:255|unique:departments,name',
            'branch_id' => 'required|exists:branches,id',
        ]);

        if ($validatedData->fails()) {
            return response()->json(['errors' => $validatedData->errors()], 422);
        }

        $department->name = $request->name;
        $department->branch_id = $request->branch_id;
        $department->save();

        return response()->json(['message' => 'Department updated successfully', 200]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Department $department)
    {
        $department->delete();
        return response()->json(['message' => 'Department deleted successfully', 200]);
    }
}
