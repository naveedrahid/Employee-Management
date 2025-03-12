<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\BankDetail;
use App\Models\Employee;
use App\Models\User;
use Illuminate\Http\Request;

class BankDetailController extends Controller
{
    public function index()
    {
        $bank_details = BankDetail::with([
            'employee' => function($q)
            {
                $q->select('id', 'user_id')->with([
                    'user' => function($q){
                        $q->select('id', 'name');
                    }
                ]);
            }
        ])->get();

        return view('backend.bank_details.index', compact('bank_details'));
    }

    public function create()
    {
        $bank_detail = new BankDetail();

        $employees = Employee::with('user:id,name')->get()->map(function ($employee) {
            return [
                'id' => $employee->id,
                'name' => $employee->user->name ?? '',
            ];
        });

        return view('backend.bank_details.form', compact('bank_detail', 'employees'));
    }

    public function store(Request $request)
    {
        $validatedData = validator($request->all(), [
            'employee_id' => 'required|exists:employees,id|unique:bank_details,employee_id',
            'bank_name' => 'required|string|max:255',
            'account_number' => 'required|unique:bank_details,account_number|regex:/^\d+$/',
            'account_title' => 'required|string|max:255',
            'branch_code' => 'required|numeric',
            'branch_name' => 'required|string|max:255',
        ]);

        if (BankDetail::where('employee_id', $request->employee_id)->exists()) {
            return response()->json(['message' => 'Bank Detail already exists for this employee'], 422);
        }

        if ($validatedData->fails()) {
            return response()->json(['errors' => $validatedData->errors()], 422);
        }


        $bank_detail = new BankDetail();
        $bank_detail->employee_id = $request->employee_id;
        $bank_detail->bank_name = $request->bank_name;
        $bank_detail->account_number = $request->account_number;
        $bank_detail->account_title = $request->account_title;
        $bank_detail->branch_code = $request->branch_code;
        $bank_detail->branch_name = $request->branch_name;
        $bank_detail->save();

        return response()->json(['message' => 'Bank Detail created successfully'], 200);
    }

    public function edit(BankDetail $bank_detail)
    {
        $employee = Employee::with('user:id,name')->where('id', $bank_detail->employee_id)->first();
    
        $employees = Employee::with('user:id,name')->get()->map(function ($employee) {
            return [
                'id' => $employee->id,
                'name' => $employee->user->name ?? '',
            ];
        });
    
        return view('backend.bank_details.form', compact('bank_detail', 'employees', 'employee'));
    }
    
    public function update(Request $request, BankDetail $bank_detail)
    {
        $validatedData = validator($request->all(), [
            'bank_name' => 'required|string|max:255',
            'account_number' => 'required|regex:/^\d+$/|unique:bank_details,account_number,' . $bank_detail->id,
            'account_title' => 'required|string|max:255',
            'branch_code' => 'required|numeric',
            'branch_name' => 'required|string|max:255',
        ]);
    
        if ($validatedData->fails()) {
            return response()->json(['errors' => $validatedData->errors()], 422);
        }
    
        $bank_detail->update([
            'bank_name' => $request->bank_name,
            'account_number' => $request->account_number,
            'account_title' => $request->account_title,
            'branch_code' => $request->branch_code,
            'branch_name' => $request->branch_name,
        ]);
    
        return response()->json(['message' => 'Bank Detail updated successfully'], 200);
    }

    public function destroy(BankDetail $bank_detail){
        $bank_detail->delete();

        return response()->json(['message' => 'Bank Detail deleted successfully'], 200);
    }
    
}
