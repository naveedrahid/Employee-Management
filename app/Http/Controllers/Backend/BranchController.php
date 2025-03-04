<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Branch;
use App\Models\Country;
use Illuminate\Http\Request;

    class BranchController extends Controller
    {
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $branches = Branch::with('country', 'city')->get();
        return view('backend.branches.index', compact('branches'));
    }
    
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $branch = new Branch();
        $method = 'POST';
    
        $countries = Country::with('cities')->get();
    
        $countriesList = $countries->pluck('name', 'id')->toArray();
    
        $citiesList = [];
        foreach ($countries as $country) {
            $citiesList[$country->id] = $country->cities->pluck('name', 'id')->toArray();
        }
    
        return view('backend.branches.form', compact('branch', 'method', 'countriesList', 'citiesList'));
    }
    

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'country_id' => 'required|exists:countries,id',
            'city_id' => 'required|exists:cities,id',
            'address' => 'required|string|max:255',
        ]);
    
        Branch::create($validatedData);
    
        return redirect()->route('backend.branches.index')->with('success', 'Branch created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Branch $branch)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Branch $branch)
    {
        $method = 'PUT';
        $countries = Country::with('cities')->get();
    
        $countriesList = $countries->pluck('name', 'id')->toArray();
    
        $citiesList = [];
        foreach ($countries as $country) {
            $citiesList[$country->id] = $country->cities->pluck('name', 'id')->toArray();
        }
        return view('backend.branches.form', compact('branch', 'method', 'countriesList', 'citiesList'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Branch $branch)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'country_id' => 'required|exists:countries,id',
            'city_id' => 'required|exists:cities,id',
            'address' => 'required|string|max:255',
        ]);

        $branch->update($validatedData);
    
        return redirect()->route('backend.branches.index')->with('success', 'Branch created successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Branch $branch)
    {
        $branch->delete();
    
        return redirect()->route('backend.branches.index')->with('success', 'Branch deleted successfully');
    }
}
