<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\Position;
use Illuminate\Http\Request;

class PositionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $positions = Position::with('department')->get();
        return view('backend.positions.index', compact('positions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $position = new Position();
        $departments = Department::pluck('name', 'id')->toArray();
        return view('backend.positions.form', compact('position', 'departments'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = validator($request->all(), [
            'name' => 'required|string|max:255',
            'department_id' => 'required|exists:departments,id',
            'position_status' => 'required',
        ]);
        
        if ($validatedData->fails()) {
            return response()->json(['errors' => $validatedData->errors()], 422);
        }

        $position = new Position();
        $position->name = $request->name;
        $position->department_id = $request->department_id;
        $position->position_status = $request->position_status;
        $position->save();

        return response()->json(['message' => 'Position created successfully', 200]);
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
    public function edit(Position $position)
    {
        $departments = Department::pluck('name', 'id')->toArray();
        return view('backend.positions.form', compact('position', 'departments'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Position $position)
    {
        $validatedData = validator($request->all(), [
            'name' => 'required|string|max:255',
            'department_id' => 'required|exists:departments,id',
            'position_status' => 'required',
        ]);
        
        if ($validatedData->fails()) {
            return response()->json(['errors' => $validatedData->errors()], 422);
        }

        $position->name = $request->name;
        $position->department_id = $request->department_id;
        $position->position_status = $request->position_status;

        $position->save();

        return response()->json(['message' => 'Position Update successfully'], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Position $position)
    {
        $position->delete();

        return response()->json(['message' => 'Delete Position successfully'], 200);
    }
}
