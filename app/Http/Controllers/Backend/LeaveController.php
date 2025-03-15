<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Leave;
use Illuminate\Http\Request;

class LeaveController extends Controller
{
    public function create()
    {
        $leave = new Leave();
        return view('backend.leaves.form', compact('leave'));
    }
}
