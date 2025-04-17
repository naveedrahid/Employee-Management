<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\CashRegister;
use App\Models\Employee;
use App\Models\Expense;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CashRegisterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cash_registers = CashRegister::with(['employee:id,user_id', 'employee.user:id,name'])->get();
        return view('backend.cash_registers.index', compact('cash_registers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $cash_register = new CashRegister();
        $employees = Employee::select('id', 'user_id')->with('user:id,name')->get();

        return view('backend.cash_registers.form', compact('cash_register', 'employees'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = validator($request->all(), [
            'title' =>  'required|string|max:255',
            'employee_id' => 'required',
            'opening_balance' => 'required|numeric|min:0',
            'notes' => 'nullable|string|max:255',
        ])->validate();

        DB::beginTransaction();

        try {
            $cashRegister = CashRegister::create($validator);
    
            $lastExpense = Expense::orderBy('id', 'desc')->first();
            $lastRemainingBalance = $lastExpense ? $lastExpense->remaining_balance : 0;
            $newRemainingBalance = $lastRemainingBalance + $cashRegister->opening_balance;
            
            Expense::create([
                'cash_register_id' => $cashRegister->id,
                'amount' => $cashRegister->opening_balance,
                'type' => 'new_balance',
                'remaining_balance' => $newRemainingBalance,
            ]);
            
            DB::commit();
    
            return response()->json(['message' => 'Cash Register added successfully.'], 201);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => 'Something went wrong: ' . $e->getMessage()], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(CashRegister $cash_register)
    {
        //
    }
    
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CashRegister $cash_register)
    {
        $employees = Employee::select('id', 'user_id')->with('user:id,name')->get();
        return view('backend.cash_registers.form', compact('cash_register', 'employees'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, CashRegister $cash_register)
    {
        $validator = validator($request->all(), [
            'title' =>  'required|string|max:255',
            'employee_id' => 'required',
            'opening_balance' => 'required|numeric|min:0',
            'notes' => 'nullable|string|max:255',
        ])->validate();

        $cash_register->update($validator);
        return response()->json(['message' => 'Cash Register updated successfully.'], 201);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CashRegister $cash_register)
    {
        $cash_register->delete();
        return response()->json(['message' => 'Cash Register deleted successfully.'], 200);
    }
}
