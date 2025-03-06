<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Department extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    public function employees()
    {
        return $this->hasMany(Employee::class);
    }

    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }

    public function positions()
    {
        return $this->hasMany(Position::class);
    }

    public function country(){
        return $this->hasOneThrough(Country::class, Branch::class, 'id', 'id', 'branch_id', 'country_id');
    }

    public function city(){
        return $this->hasOneThrough(City::class, Branch::class, 'id', 'id', 'branch_id', 'city_id');
    }
}
