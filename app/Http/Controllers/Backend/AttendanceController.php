<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\Employee;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AttendanceController extends Controller
{
    public function index()
    {
        $employees = Employee::with('user:id,name')->get();
        return view('backend.attendances.index', compact('employees'));
    }

    //     public function create()
    //     {
    //         return view('backend.attendances.form');
    //     }

    //     public function store(Request $request)
    //     {
    // //
    //     }

    public function checkIn(Request $request)
    {
        $employeeId = Auth::user()->employee->id;
        $today = Carbon::today()->toDateString();
        $attendance = Attendance::where('employee_id', $employeeId)->where('date', $today)->first();

        if ($attendance) {
            return response()->json([
                'message' => 'You have already checked in today',
            ], 400);
        }

        $attendance = Attendance::create([
            'employee_id' => $employeeId,
            'date' => $today,
            'check_in' => Carbon::now(),
            'check_in_status' => 'present',
            'ip_address' => $request->ip(),
            'location' => json_encode($request->location),
        ]);

        return response()->json([
            'message' => 'You have successfully checked in',
            'attendance' => $attendance,
        ], 200);
    }

    public function checkOut(Request $request)
    {
        $employeeId = Auth::user()->employee->id;
        $today = Carbon::today()->toDateString();
        $attendance = Attendance::where('employee_id', $employeeId)->where('date', $today)->first();

        if (!$attendance) {
            return response()->json([
                'message' => 'You have not checked in today',
            ], 400);
        }

        if ($attendance->check_out) {
            return response()->json([
                'message' => 'You have already checked out today',
            ], 400);
        }

        $attendance->update([
            'check_out' => Carbon::now()->toTimeString(),
            'check_out_status' => 'out',
        ]);
        return response()->json([
            'message' => 'You have successfully checked out',
            'attendance' => $attendance,
        ], 200);
    }

    public function show(Request $request, $id)
    {
        $month = $request->query('month', Carbon::now()->month);
        $year = $request->query('year', Carbon::now()->year);
    
        $dates = $this->generateDates($month, $year);
    
        // Get specific employee attendance only
        $attendances = Attendance::with('employee.user:id,name')
            ->where('employee_id', $id)
            ->whereMonth('date', $month)
            ->whereYear('date', $year)
            ->get();
    
        $grouped = [];
    
        foreach ($attendances as $att) {
            $employeeId = $att->employee_id;
            $employeeName = $att->employee?->user?->name ?? 'N/A';
            $date = $att->date;
    
            $grouped[$employeeId]['name'] = $employeeName;
            $grouped[$employeeId]['records'][$date] = [
                'status' => 'Present',
                'check_in' => $att->check_in ? Carbon::parse($att->check_in)->format('H:i') : 'N/A',
                'check_out' => $att->check_out ? Carbon::parse($att->check_out)->format('H:i') : 'N/A',
            ];
        }
    
        return view('backend.attendances.show', compact('month', 'year', 'dates', 'grouped'));
    }    

    private function generateDates($month, $year)
    {
        $dates = [];
        $start = Carbon::create($year, $month, 1);
        $daysInMonth = $start->daysInMonth;

        for ($day = 1; $day <= $daysInMonth; $day++) {
            $dates[] = Carbon::create($year, $month, $day)->toDateString();
        }

        return $dates;
    }
    // public function edit(Attendance $attendance)
    // {
    //     return view('backend.attendances.form');
    // }

    // public function update(Request $request, Attendance $attendance)
    // {
    //     dd($request->all());
    // }

    // public function destroy(Attendance $attendance)
    // {
    //     $attendance->delete();
    //     return redirect()->route('attendances.index');
    // }
}
