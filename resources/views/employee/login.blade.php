<!DOCTYPE html>
<html lang="en">
<head>
	<title>Hashstar | Employee Login</title>
	<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
<!--===============================================================================================-->
	<link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
<!--===============================================================================================-->
</head>
<style>
    body{
        padding: 0;
        margin: 0;
    }
    .login100-form-btn:active{
        transition: 110ms;
        transform:scale(1.01);
        box-shadow: 1px 1px 2px black,-1px -1px 3px gray;
}
.backgr{
    height: 100%;
    width: 100%;
    z-index: 11 !important;
    position: absolute;
    top: 0;
    left: 0;
    bottom: 0;
    right: 0;
    background: rgba(0,0,0,0.5);
}

.alert-box h3{
    text-shadow:1px 1px 1px blue ;
}
.alert-box{
    border-radius: 18px;
    animation: shadoww 1s infinite linear;
    background: white;
    font-family:Cambria, Cochin, Georgia, Times, 'Times New Roman', serif;
}
#register_employee_form input , textarea{
    border: 0.5px solid grey !important;
}
@keyframes shadoww{
    0%{
        box-shadow: 2px 2px 5px red,-2px -2px 5px red;
    }
    50%{
        box-shadow: 2px 2px 15px red,-2px -2px 15px red;
    }
    100%{
        box-shadow: 2px 2px 5px red,-2px -2px 5px red;
    }
}
#forgot span:hover{
    transition: 120ms;
    transform: scale(1.02);
    transform-origin: center;
    text-decoration: underline;
}
 .error{
     color: red !important; 
 }
</style>
<body>
 

	<div class="limiter">
		<div class="container-login100" style="background-image: url('images/bg-01.jpg');">
			<div class="p-t-30 p-b-50">
				
                {{-- @include('sweetalert::alert') --}}
                <div id="msg">

                </div>
                @if (Session::get("success"))
                        <div class="err-msg alert alert-success animate__animated animate__fadeInUpBig p-3">{{Session::get("success")}}</div>
                    @endif
                    @if (Session::get("error"))
                        <div class="err-msg alert alert-danger animate__animated animate__fadeInUpBig p-3" >{{Session::get("error")}}</div>
                    @endif
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                
                <div class="row  ">
                    <div id="login_employee" class="row  col-12" style="margin:auto">
                        <span class="login100-form-title p-b-41" style="margin: auto">
                            Employee Login
                        </span>
                        <form  action="/login" method="post" style="margin:auto;"   class="col-lg-9 bg-white    validate-form p-b-33 p-t-5">
                            @csrf
                            <div class="wrap-input100 validate-input" data-validate = "Enter username">
                                <input class="input100" type="email" name="username" placeholder="User name">
                                <span class="focus-input100" data-placeholder="&#xe82a;"></span>
                            </div>
        
                            <div class="wrap-input100 validate-input" data-validate="Enter password">
                                <input class="input100" type="password" name="pass" placeholder="Password">
                                <span class="focus-input100" data-placeholder="&#xe80f;"></span>
                            </div>
                            <div class="row m-4  ">
                                <a id="forgot" href="/forgot" class="text-info col-12 " style="font-size: 15px;text-align:end"><span>Forgot Password ?</span></a>
                            </div>
                            <div class="container-login100-form-btn m-t-32">
                                <input style="cursor: pointer"  class="login100-form-btn" type="submit" value="Login">
                            </div>
                             <a id="clickToRegisterBtn" class="d-flex justify-content-center text-info pt-3" href="#">New Employee | Register ?</a>
                        </form>
                    </div>
                    <div  id="Register_employee" style="width: 100%;display:none"  class="row col-md-12  px-0 col-lg-12">
                        <span class="login100-form-title px-0 p-b-41" style="margin: auto">
                            Employee  Register
                        </span>
                        <form  id="register_employee_form" action="route_path"  method="post"  class="form card bg-white w-100 p-b-33 p-t-5">
                         
                            <div class="card-body">
                                <div class="form-group row">
                                    <div class="col-lg-6 ">
                                        <label>Full Name:</label>
                                        <input type="text" class="form-control" onkeypress="return isNumberKey(event)" name="name" value="{{old('name')}}" placeholder="Enter full name" required/>
                                    </div>
                                    <div class="col-lg-6 ">
                                        <label>Contact Number:</label>
                                        <input type="text" onChange="checkInput(this)" onKeyup="checkInput(this)" name="contact" maxlength="10" class="form-control" value="{{old('contact')}}" placeholder="Enter contact number" required/>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-lg-6 ">
                                        <label>Email Address:</label>
                                        <input type="email" name="email" class="form-control" value="{{old('email')}}"  placeholder="Enter your address" required/>
                                    </div>
                                    <div class="col-lg-6 ">
                                        <label>Date Of Birth:</label>
                                        <input type="date" name="dob" class="form-control" value="{{old('dob')}}" placeholder="Enter your postcode" required/>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-lg-12 ">
                                        <label>Address:</label>
                                        <textarea style=" border: 0.5px solid grey !important;" rows="6" type="text" name="address" class="form-control" value="{{old('address')}} " placeholder="Enter your postcode" required>   </textarea>
                                    </div>
                                </div>
                               
                            </div>
                            <div class="container-login100-form-btn">
                                <input type="submit" value="Register" class="login100-form-btn " style="cursor: pointer">
                            </div>
                            <a id="clickToLoginBtn" style="cursor:pointer" class="d-flex justify-content-center text-info pt-3">Already Registered ? Login Here</a>
                        </form>
                    </div>
                </div>
                
                
			</div>
		</div>
    </div>

 

<!--===============================================================================================-->
	{{-- <script src="vendor/jquery/jquery-3.2.1.min.js"></script> --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
     
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/jquery.validate.min.js" 
            integrity="sha512-UdIMMlVx0HEynClOIFSyOrPggomfhBKJE28LKl8yR3ghkgugPnG6iLfRfHwushZl1MOPSY6TsuBDGPK2X4zYKg==" crossorigin="anonymous"></script>
<!--===============================================================================================-->
	<script src="vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
	<script src="js/main.js"></script>

    <script>
        $(document).ready(()=>{ 
            $("#clickToRegisterBtn").on("click",(e)=>{
                e.preventDefault();
                $("#login_employee").fadeOut();
                $("#login_employee").css('display','none');
                $("#Register_employee").fadeIn();
                setTimeout(() => {
                }, 200);
            });
            $("#clickToLoginBtn").on("click",(e)=>{
                e.preventDefault();
                $("#Register_employee").fadeOut();
                $("#Register_employee").css('display','none');
                setTimeout(() => {
                    $("#login_employee").fadeIn();
                }, 200);
            });
        });
        function checkInput(ob){
            var invalidChars = /[^0-9]/gi;
            if(invalidChars.test(ob.value)) {
                    ob.value = ob.value.replace(invalidChars,"");
                    alert("characters not allowed");
          }
        };
        function isNumberKey(evt)
            {
                var charCode = (evt.which) ? evt.which : evt.keyCode;
                if (charCode != 46 && charCode > 31
                    && (charCode < 48 || charCode > 57))
                    {
                        return true;
                    }else{
                        return false;
                    }
            }


  
    </script>
	<script src="js/Employee_login.js"></script>
</body>
</html>
