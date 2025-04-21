<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Expense extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = ['id'];

    public function cashRegister()
    {
        return $this->belongsTo(CashRegister::class);
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    public function approvedByUser()
    {
        return $this->belongsTo(Employee::class, 'approved_by');
    }
}
