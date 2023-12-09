<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hr extends Model
{
    use HasFactory;
    protected $table ="hr";
    protected $fillable =['name','email','contact','dob','address','password'];
}
