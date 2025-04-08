<?php

namespace App\View\Components;

use Carbon\Carbon;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class CalendarGrid extends Component
{
    public $month;
    public $year;
    public $dates;
    public $grouped;

    public function __construct($month, $year, $dates, $grouped)
    {
        $this->month = $month;
        $this->year = $year;
        $this->dates = $dates;
        $this->grouped = $grouped;
    }

    public function render()
    {
        return view('components.calendar-grid');
    }
}