<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\CashRegister;
use App\Models\Employee;
use App\Models\Expense;
use Illuminate\Http\Request;

class ExpenseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $expense = Expense::with(['employee:id,user_id', 'user:id,name' , 'cashRegister:id,opening_balance'])->get();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $expense = new Expense();
        $employees = Employee::with('user:id,name')->select('id', 'user_id')->get();
        $latestCashRegister = CashRegister::latest()->value('id');
        $lastExpense = Expense::orderBy('id', 'desc')->first();
        $latestBalance = $lastExpense ? $lastExpense->remaining_balance : 0;

        return view('backend.expenses.form', compact('expense', 'employees', 'latestCashRegister', 'latestBalance', 'lastExpense'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
