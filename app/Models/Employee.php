<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'job_title',
        'phone',
        'hire_date',
        'salary',
        'user_id',
        'department_id',
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function department() {
        return $this->belongsTo(Department::class);
    }
    
    public function attendances() 
    {
        return $this->hasMany(Attendance::class);
    }

    public function sickLeaves() 
    {
        return $this->hasMany(SickLeave::class);
    }

    public function vacationLeaves() 
    {
        return $this->hasMany(VacationLeave::class);
    }

}
