<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Holiday;
use Illuminate\Http\Request;

class HolidayController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $holidays = Holiday::all();
        return view('backend.holidays.index', compact('holidays'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $holiday = new Holiday();
        return view('backend.holidays.form', compact('holiday'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = validator($request->all(), [
            'name' => 'required|string|max:255',
            'date' => 'required',
            'description' => 'nullable|string|max:255',
        ])->validate();
        
        $validate['status'] = 'active';
        Holiday::create($validate);
        return response()->json(['message' => 'Holiday created successfully.'], 201);
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
    public function edit(Holiday $holiday)
    {
        return view('backend.holidays.form', compact('holiday'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Holiday $holiday)
    {
        $validate = validator($request->all(), [
            'name' => 'required|string|max:255',
            'date' => 'required',
            'description' => 'nullable|string|max:255',
        ])->validate();
        
        $holiday->update($validate);
        return response()->json(['message' => 'Holiday created successfully.'], 201);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Holiday $holiday)
    {
        $holiday->delete();
        return response()->json(['message' => 'Holiday deleted successfully.'], 200);
    }

    public function status(Holiday $holiday, Request $request)
    {
        $holiday->status = $request->status;
        $holiday->save();
        return response()->json(['message' => 'Holiday status updated successfully.'], 200);
    }
}
