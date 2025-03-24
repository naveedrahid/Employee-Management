<?php

namespace App\View\Components;

use App\Models\Attendance;
use Carbon\Carbon;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\Component;

class CheckOut extends Component
{
    /**
     * Create a new component instance.
     */

    public $checkOut;

    public function __construct()
    {
        $this->checkOut = false;

        $employee = Auth::user()->employee;

        if ($employee) {
            $employeeId = $employee->id;
            $today = Carbon::today()->toDateString();

            $this->checkOut = Attendance::where('employee_id', $employeeId)
                ->where('date', $today)->whereNotNull('check_in')
                ->first();
        }
    }
    
    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.check-out', [
            'checkOut' => $this->checkOut
        ]);
    }
}
