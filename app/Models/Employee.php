<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Employee extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function branch(){
        return $this->belongsTo(Branch::class);
    }

    public function department(){
        return $this->belongsTo(Department::class);
    }

    public function attendances(){
        return $this->hasMany(Attendance::class);
    }

    public function salary(){
        return $this->hasOne(Salary::class);
    }

    public function bankDetails()
    {
        return $this->hasOne(BankDetail::class);
    }

    public function leaves(){
        return $this->hasMany(Leave::class);
    }

    public function performanceReviews(){
        return $this->hasMany(PerformanceReview::class);
    }

    public function assets()
    {
        return $this->hasMany(Asset::class);
    }

    public function resignation()
    {
        return $this->hasOne(Resignation::class);
    }

    public function expenses()
    {
        return $this->hasMany(Expense::class);
    }

    public function position()
    {
        return $this->belongsTo(Position::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

}