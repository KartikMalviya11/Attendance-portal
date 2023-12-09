<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use Session;
class employeeController extends Controller
{
    public function showLogin(){
       if(Session::get("employee")){
           Session::flush();
       }
        return view('employee.login');
    }
    public function index()
    {
        if(Session::get('employee')){
            return view("employee.employee_dashboard");
        }else{
            return back()->with("error","Please Login First .");
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        $pass= md5($request->pass);
        for($i=0 ;$i< strlen($pass);$i++){
             $p[$i] =$pass[$i].strlen($pass)*$i;
        }
        $password =implode("",$p);
           $data =  Employee::where(['company_email'=> $request->username , 'password'=>$password])->first();
        if($data){
            Session::put('employee',$data);
            return redirect ('/employee/dashboard')->with('success',"Logged In Successfully");
        }else{
            return redirect ('/')->with('error',"Invalid Credentials");
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return "yash";
        // $this -> validate($request ,[
        //     'email' => 'unique:employee,email',
        // ]);

        //  $data =  Employee::create([
        //     "name" => $request->name,
        //     'email' => $request->email,
        //     'contact'=>$request ->contact,
        //     'dob' =>$request->dob,
        //     'address' =>$request->address,

        //  ]);
        //  return $data;
    }
    public function logout()
    {
        Session::flush();
        return redirect("/");
    }

}
