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
        $expenses = Expense::with(['employee:id,user_id', 'user:id,name'])->get();
        return view('backend.expenses.index', compact('expenses'));
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
        $data = $request->validate([
            'employee_id' => 'required',
            'cash_register_id' => 'required',
            'amount' => 'required|numeric|min:0',
            'description' => 'required|string|max:255',
            'status' => 'required|in:pending,approved,rejected',
            'approved_by' => 'required',
            'receipt' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'remaining_balance' => 'required|numeric|min:0',
        ]);

        $lastExpense = Expense::where('cash_register_id', $data['cash_register_id'])
            ->orderBy('id', 'desc')
            ->first();

        $previousBalance = $lastExpense ? $lastExpense->remaining_balance : 0;
        $data['remaining_balance'] = $previousBalance - $data['amount'];
        $data['approved_at'] = now();

        $expense = Expense::create($data);

        if ($request->hasFile('receipt')) {
            $file = $request->file('receipt');
            $filename = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
            $extension = $file->getClientOriginalExtension();
            $timestamp = now()->format('YmdHis');
            $newFilename = "{$filename}_{$timestamp}_expense-{$expense->id}.{$extension}";
            $path = $file->storeAs('receipts/expense', $newFilename, 'public');
            $expense->update(['receipt' => $path]);
        }

        return response()->json(['message' => 'Expense created successfully.'], 201);
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
