<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

   protected $table= "employee";
   protected $fillable =['name','email','contact','dob','address','joining_date','designation','company_email','approve_flag','password'];

   public function attendance()
   {
       return $this->hasMany(Attendance::class,'employee_id','id');
   }
}
