<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Leave extends Model
{
    use HasFactory;
    protected $table="leaves";
    protected $fillable =['employee_id','apply_date','leave_type','reason','from_date','to_date','no_of_days','leave_status'];
    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
