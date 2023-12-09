<?php

namespace App\Http\Controllers;

use App\Models\Leave;
use Illuminate\Http\Request;
use DateTime;
use Session;
class leavesController extends Controller
{
     public function apply(Request $request){
         $fdate = $request->from_date;
        $tdate = $request->to_date;
        $datetime1 = new DateTime($fdate);
        $datetime2 = new DateTime($tdate);
        $interval = $datetime1->diff($datetime2);
         $d = $interval->format('%a');//now do whatever you like with $days
         $days=$d+1;
            $data =   Leave::create([
            'employee_id' =>$request->employee_id,
            'leave_type'=>$request->leave_type,
            'apply_date'=> date("Y-m-d"),
            'from_date' =>$fdate,
            'to_date' =>$tdate,
            'reason' =>$request->reason,
            'no_of_days' => $days,
        ]);
        if($data){
            return back()->with('success','Your Request Has Been Set To the HR.');
        }else{
            return back()->with('error','OOps ! , something went wrong,please try again.');
        }
     }
     public function approvedLeave($id){
        $data = Leave::where(['id'=>$id])->update([
            'leave_status'=>1,
        ]);
        if($data){
            return back()->with("success","leave is approved");
        }else{
            return back()->with("error","OOps ! something went wrong.");

        }
     }
     public function rejectedLeave($id){
        $data = Leave::where(['id'=>$id])->update([
            'leave_status'=>2,
        ]);
        if($data){
            return back()->with("success","leave is rejected");
        }else{
            return back()->with("error","OOps ! something went wrong.");

        }
     }
     public function showLeaveStatusPage(){
         $id = Session::get('employee')['id'];
         $data = Leave::orderBy('apply_date','DESC')->where(['employee_id'=>$id])->get();
         Session::put("leaves",$data);
         return view('employee.employee_leave');
     }
}
