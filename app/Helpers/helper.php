<?php

use App\Models\Attendance;
use App\Models\Employee;
use App\Models\Expense;
use App\Models\Leave;
use Carbon\Carbon;

function totalEmployee(){
    return  Employee::count();
}

function totalAbsent(){
    $date = Carbon::today();
    return Attendance::where('date',$date)->where('check_in_status','present')->count();
}

function totalLeave(){
    $today = Carbon::today()->toDateString();

    $leaveCount = Leave::where('status', 'approved')
        ->where(function ($query) use ($today) {
            $query->whereDate('start_date', $today)
                  ->orWhere(function ($q) use ($today) {
                      $q->whereDate('start_date', '<=', $today)
                        ->whereDate('end_date', '>=', $today);
                  });
        })
        ->count();

    return $leaveCount;
}

function expenses(){
    $today = Carbon::today()->toDateString();
    return Expense::where('status', 'approved')->whereDate('approved_at', $today)->sum('amount');
}

function allExpenses(){
    return Expense::where('status', 'approved')->latest()->take(6)->get();
}