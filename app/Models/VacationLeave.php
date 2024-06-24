<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VacationLeave extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_id',
        'leave_date',
        'reason',
        'status'
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
