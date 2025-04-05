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
        $attendances = Attendance::all();
        return view('backend.attendances.index', compact('attendances'));
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

    public function show(Request $request)
    {
        $month = $request->query('month', Carbon::now()->month);
        $year = $request->query('year', Carbon::now()->year);

        $dates = $this->generateDates($month, $year);
        $statuses = [];
        $checkIns = [];
        $checkOuts = [];

        $attendance = Attendance::whereMonth('date', $month)
            ->whereYear('date', $year)
            ->get();

        foreach ($attendance as $att) {
            $statuses[$att->date] = 'Present';
            $checkIns[$att->date] = $att->check_in ?? '-';
            $checkOuts[$att->date] = $att->check_out ?? '-';
        }

        return view('backend.attendances.show', compact('month', 'year', 'dates', 'statuses', 'checkIns', 'checkOuts'));
    }

    private function generateDates($month, $year)
    {
        $dates = [];
        $start = Carbon::create($year, $month, 1);
        $daysInMonth = $start->daysInMonth;

        for ($day = 1; $day <= $daysInMonth; $day++) {
            $dates[] = $start->copy()->day($day)->toDateString();
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
