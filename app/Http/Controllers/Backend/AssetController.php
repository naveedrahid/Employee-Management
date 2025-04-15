<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Asset;
use App\Models\Employee;
use Illuminate\Http\Request;

class AssetController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $assets = Asset::with(['employee' => function ($q) {
            $q->select('id', 'user_id');
        }, 'employee.user:id,name'])->get();
        return view('backend.assets.index', compact('assets'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $asset = new Asset();
        $lastAsset = Asset::select('asset_code')->orderByDesc('asset_code')->first();

        if ($lastAsset) {
            $nextCode = (int) $lastAsset->asset_code + 1;
        } else {
            $nextCode = 1;
        }
        $formattedCode = sprintf('%04d', $nextCode);
        $employees = Employee::select('id', 'user_id')->with('user:id,name')->get();

        return view('backend.assets.form', compact('asset', 'employees', 'formattedCode'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = validator($request->all(), [
            'employee_id' => 'required',
            'asset_name' => 'required|string|max:255',
            'asset_code' => 'required|unique:assets,asset_code',
            'assigned_date' => 'nullable|date',
            'return_date' => 'nullable|date',
            'status' => 'required|in:assigned,not assigned,return',
            'condition' => 'nullable|in:new,used,broken',
            'description' => 'nullable|string|max:1000',
            'serial_number' => 'nullable|numeric',
            'model' => 'nullable|string|max:100',
            'brand' => 'nullable|string|max:100',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ])->validate();

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = 'asset_code_(' . $validatedData['asset_code'] . ')_' . time() . '_' . date('Ymd') . '_' . $image->getClientOriginalName();
            $imagePath = $image->storeAs('asset_image', $imageName, 'public');
            $validatedData['image'] = 'storage/' . $imagePath;
        }

        $asset = new Asset();
        $asset->employee_id = $validatedData['employee_id'];
        $asset->asset_name = $validatedData['asset_name'];
        $asset->asset_code = $validatedData['asset_code'];
        $asset->assigned_date = $validatedData['assigned_date'];
        $asset->return_date = $validatedData['return_date'];
        $asset->status = $validatedData['status'];
        $asset->condition = $validatedData['condition'];
        $asset->description = $validatedData['description'];
        $asset->serial_number = $validatedData['serial_number'];
        $asset->model = $validatedData['model'];
        $asset->brand = $validatedData['brand'];
        $asset->image = $validatedData['image'] ?? null;

        $asset->save();
        return response()->json(['status' => 'success', 'message' => 'Asset created successfully.'], 201);
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
    public function edit(Asset $asset)
    {
        $employees = $asset->employee()->select('id', 'user_id')->with('user:id,name')->get();
        return view('backend.assets.form', compact('asset', 'employees'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Asset $asset)
    {
        $request->except('asset_code');

        $validatedData = validator($request->all(), [
            'employee_id' => 'required',
            'asset_name' => 'required|string|max:255',
            'assigned_date' => 'nullable|date',
            'return_date' => 'nullable|date',
            'status' => 'required|in:assigned,not assigned,return',
            'condition' => 'nullable|in:new,used,broken',
            'description' => 'nullable|string|max:1000',
            'serial_number' => 'nullable|numeric',
            'model' => 'nullable|string|max:100',
            'brand' => 'nullable|string|max:100',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ])->validate();

        if ($request->hasFile('image')) {
            if ($asset->image && file_exists(public_path($asset->image))) {
                unlink(public_path($asset->image));
            }

            $image = $request->file('image');
            $imageName = 'asset_code_(' . $asset->asset_code . ')_' . time() . '_' . date('Ymd') . '_' . $image->getClientOriginalName();
            $imagePath = $image->storeAs('asset_image', $imageName, 'public');
            $validatedData['image'] = 'storage/' . $imagePath;
        }

        $asset->update($validatedData);

        return response()->json(['status' => 'success', 'message' => 'Asset updated successfully.'], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Asset $asset)
    {
        if ($asset->image && file_exists(public_path($asset->image))) {
            unlink(public_path($asset->image));
        }

        $asset->delete();
        return response()->json(['message' => 'Asset deleted successfully.'], 200);
    }
}
