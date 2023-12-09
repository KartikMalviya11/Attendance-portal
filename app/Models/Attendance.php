<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;
    protected $table="attendance";
    protected $fillable =['employee_id','date','late_hours','attendance_status','extra_work','in_time','out_time'];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
