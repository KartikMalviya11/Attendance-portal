<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use Illuminate\Http\Request;
use Session;
class attendController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Session::get("employee")){
             $id= Session::get("employee")['id'];
            return $data = Attendance::orderBy("created_at","DESC")->where(["employee_id"=>$id])->take(10)->get();
        }else{
            return "wrong";
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {
         $employee_id=$request->employee_id;
           $date =$request->date;
           $status ='';
        if($request->late == 0){
           $late_hours = "not late";
        }else{
              $late_hours=$request->late;
        }
         echo $check =Attendance::where(['employee_id'=>$employee_id,'date'=>$date])->first();
        if($check){
            echo $check;
               return back()->with('error',"you Naughty ! you had alreay marked your attendance.");
        }else{

             $data= Attendance::create([
                'employee_id' =>$employee_id,
                'date'  =>$date,
                'late_hours' =>$late_hours,
                'in_time'   =>$request->time,
            ]);
            if($data){
                return back()->with('success',"your attendance has been marked.");
            }else{
                return back()->with('error',"OOps! something went wrong , please contact HR Immediately");
            }
    }

    }


    public function show($id)
    {
         $today = date('Y-m-d');
            $check =Attendance::where(['id'=>$id,'date'=>$today])->first();
            if($check !=""){
                return  $check;
            }else{
                 return 10;
            }

    }

    public function showmiss($id)
    {

             $check =Attendance::where(['id'=>$id])->first();
            if($check !=""){
                return  $check;
            }else{
                 return 0;
            }

    }



    public function markEod(Request $request)
    {
        // dd($request->all());
         $date =$request->date;
          $time =$request->time;
         $employee_id =$request->employee_id;
         $check =Attendance::where(['employee_id'=>$employee_id,'date'=>$date ,'out_time'=>null])
                    ->update([
                        'out_time'=>$time,
                        'extra_work' => $request->incentives
                         ]);
         if($check == 1){
            return back()->with('success',"End of Task is marked.");
         }else{
            return back()->with('error',"I think you had already mark you End of Day .");
         }

    }
    public function markMissEod(Request $request)
    {
         $date =$request->date;
          $time =$request->time;
         $employee_id =$request->employee_id;
         $check =Attendance::where(['employee_id'=>$employee_id,'date'=>$date ,'out_time'=>null])
                    ->update([
                        'out_time'=>$time,
                        'extra_work' => $request->incentives
                         ]);
         if($check == 1){
            return back()->with('success',"Your Missed Eod has been Marked .");
         }else{
            return back()->with('error',"I think you had already mark Eod of this day .");
         }

    }
}
