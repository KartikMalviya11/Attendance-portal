<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Mail;
use App\Mail\ApprovalMail;
use App\Models\Employee;
use Illuminate\Http\Request;
use App\Models\Hr;
use App\Models\Attendance;
use Session;
use Illuminate\Support\Facades\DB;
class hrController extends Controller
{
    public function showDashboard(){
         $date = date("Y-m-d");
        $d = Attendance::where("date",$date)
                ->join('employee','employee.id','=','attendance.employee_id')
                ->select('employee.name','attendance.*')
                ->get();
                session::put("todayAttendance",$d);

       $data= Employee::orderBy('created_at','DESC')->where("approve_flag","0")->get();
        Session::put('approve',$data);
         return view ("HR.hr_dashboard");
    }
    public function showEmployeeDetails(){
        $data= Employee::orderBy('created_at','DESC')->get();
         Session::put('employeeDetails',$data);
          return view ("HR.employeeDetails");
     }
     public function showPendingLeaves(){
         $data = DB::table('employee')
        ->join('leaves', 'employee.id', '=', 'leaves.employee_id')
        ->where(["leaves.leave_status"=>0])
        ->select('employee.name', 'leaves.*')
        ->get();

        Session::put('pendingLeaves',$data);
        return view ("HR.pending_leaves");

     }
    public function showEmployeeEod(){
        $date=date("Y-m-d");
         $data = DB::table('employee')
            ->join('attendance', 'employee.id', '=', 'attendance.employee_id')
            ->where(["attendance.attendance_status"=>0])
            ->whereNotNull("attendance.out_time")
            ->select('employee.name', 'attendance.*')
            ->get();

        Session::put("attendancePending",$data);

        //  Session::put('approve',$data);
         return view ("HR.pendingEod");
     }
    public function login(Request $request)
    {
        $pass= md5($request->pass);
        for($i=0 ;$i< strlen($pass);$i++){
             $p[$i] =$pass[$i].strlen($pass)*$i;
        }
        $password =implode("",$p);
           $data =  Hr::where(['email'=> $request->username , 'password'=>$password])->first();
        if($data){
            Session::put('hr',$data);
            return redirect ('/hr/dashboard')->with('success',"Logged In Successfully");
        }else{
            return back ()->with('error',"Invalid Credentials");
        }
    }
    public function store(Request $request)
    {
        echo $request->dob;
        $this -> validate($request ,[
            'email' => 'unique:Hr,email',
            'address' => 'required',
        ]);
          $pass= md5($request->password);
           for($i=0 ;$i< strlen($pass);$i++){
                $p[$i] =$pass[$i].strlen($pass)*$i;
           }
             $password =implode("",$p);
         $data =  Hr::create([
            "name" => $request->name,
            'email' => $request->email,
            'contact'=>$request ->contact,
            'dob' =>$request->dob,
            'address' =>$request->address,
            'password' =>$password
         ]);
        if($data){
            return redirect('/hr-login#login')->with('success','Registered Successfully.');
        }else{
            return redirect('/hr-login#Register')->with('error','Unable to register,please try again.');
        }
    }
    public function approveEod($id){
         Attendance::where("id",$id)->update([
             "attendance_status" =>1
         ]);
         return redirect()->back();
    }
    public function approve(Request $request){

        $company_email = $request->company_email;
        $pass= md5($request->password);
        for($i=0 ;$i< strlen($pass);$i++){
             $p[$i] =$pass[$i].strlen($pass)*$i;
        }
          $password =implode("",$p);
       $data= Employee::where("id",$request->employee_id)->update([
           'approve_flag' => 1,
           'company_email'=>$company_email,
           'password'=>$password
       ]);
       $approveData = Employee::where("id",$request->employee_id)->get();

        $approveArray =[
            'name' =>$approveData[0]['name'],
            'company_email'=> $company_email,
            'password' => $request->password,
        ];

       if($data){
        echo $d =   Mail::to($approveData[0]['email'])->send(new ApprovalMail($approveArray));

        return redirect('/hr/dashboard')->with('success','Approved Successfully.');
       }else{
           echo "wr";
        // return redirect('/hr/dashboard')->with('error','something went wrong, please try again.');
       }
    }
    public function logout(){
        Session::flush();
        return redirect("/hr-login");
    }
}
