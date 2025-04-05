<?php

namespace App\View\Components;

use Carbon\Carbon;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class CalendarGrid extends Component
{
    /**
     * Create a new component instance.
     */
    public $month;
    public $year;
    public $dates;
    public $statuses;
    public $checkIns;
    public $checkOuts;

    public function __construct($month, $year, $dates, $statuses = [], $checkIns = [], $checkOuts = [])
    {
        $this->month = $month;
        $this->year = $year;
        $this->dates = $dates;
        $this->statuses = $statuses;
        $this->checkIns = $checkIns;
        $this->checkOuts = $checkOuts;
    }

    public function render()
    {
        return view('components.calendar-grid');
    }
}