<?php

namespace App\View\Components;

use App\Models\Attendance;
use Carbon\Carbon;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\Component;

class CheckIn extends Component
{
    /**
     * Create a new component instance.
     */

    public $checkIn;

    public function __construct()
    {
        $employeeId = Auth::user()->employee->id ?? null;
        $today = Carbon::today()->toDateString();

        $this->checkIn = Attendance::where('employee_id', $employeeId)
            ->where('date', $today)
            ->exists();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.check-in', [
            'checkIn' => $this->checkIn
        ]);
    }
}
