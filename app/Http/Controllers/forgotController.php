<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Session;
use App\Mail\otp;

class forgotController extends Controller
{
    public function sendHr(Request $request)
    {
        $email = $request->username;
        $check = Employee::where('company_email', $email)->first();
        if ($check) {
            $otp = rand(10005, 99998);
            Session::put("otp", $otp);
            $arr = [
                "otp" => $otp,
                'name' => $check['name']
            ];

            Mail::to($email)->send(new otp($arr));
            Session::put("username", $email);

            return redirect('/reset')->with("success", "otp Sent.");
        } else {
            return redirect()->back()->with("error", "Username Doesn't exists in our record.");
        }
    }
    public function showreset()
    {
        return view('employee.employee_reset');
    }
    public function verify(Request $request)
    {
        if (Session::get('username')) {
            $num = $request->otp;
            $otp = Session::get('otp');
            if ($num == $otp) {
                $request->session()->forget("otp");
                return redirect()->back()->with('success', 'otp verified successfully.');
            } else {
                return redirect()->back()->with('error', 'Incorrect OTP.');
            }
        } else {
            return redirect('/');
        }
    }
    public function  reset(Request $request)
    {
        if (Session::get('username')) {

            $email = Session::get("username");
            $this->validate($request, [
                'password' => 'required |confirmed'
            ]);
            $pass = md5($request->password);
            for ($i = 0; $i < strlen($pass); $i++) {
                $p[$i] = $pass[$i] . strlen($pass) * $i;
            }
            $password = implode("", $p);

            echo  $d = Employee::where('company_email', $email)->update([
                'password' => $password
            ]);

            if ($d) {
                $request->session()->forget("reset");
                return redirect("/")->with('success', 'Password Reset Successfull.');
            } else {
                return redirect("/")->with('error', 'Unable to reset password,please try again.');
            }
        } else {
            return redirect("/");
        }
    }
}
