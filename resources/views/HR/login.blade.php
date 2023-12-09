<!DOCTYPE html>
<html lang="en">
<head>
	<title>HR | Login</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
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
	<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
<!--===============================================================================================-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"  crossorigin="anonymous"></script>

</head>
<style>
    .mm{
        scroll-behavior: smooth !important;
    }
    .form-control:focus{
        border: 1px solid gray !important;
    }
    .error{

        color: red;
    }
    .login100-form-btn:active{
        transition: 110ms;
        transform:scale(1.01);
        box-shadow: 1px 1px 2px black,-1px -1px 3px gray;
}
</style>
<body>
    <div class="">
        <div id="login" class="limiter">
            <div class="container-login100" style="">
                <div class="wrap-login100 p-t-30 p-b-50">
                    <span class="login100-form-title p-b-41">
                        HR | Login
                    </span>
                    @if (Session::get("success"))
                        <div class="err-msg alert alert-success animate__animated animate__fadeInUpBig p-3">{{Session::get("success")}}</div>
                    @endif
                    @if (Session::get("error"))
                    <div class="err-msg alert alert-danger animate__animated animate__fadeInUpBig p-3" >{{Session::get("error")}}</div>
                @endif
                    <form action="/hr/login" method="post" class="login100-form validate-form p-b-33 p-t-5">
                        @csrf
                        <div class="wrap-input100 validate-input" data-validate = "Enter username">
                            <input class="input100" type="text" name="username" placeholder="User name">
                            <span class="focus-input100" data-placeholder="&#xe82a;"></span>
                        </div>

                        <div class="wrap-input100 validate-input" data-validate="Enter password">
                            <input class="input100" type="password" name="pass" placeholder="Password">
                            <span class="focus-input100" data-placeholder="&#xe80f;"></span>
                        </div>

                        <div class="container-login100-form-btn m-t-32">
                            <input style="cursor: pointer"  class="login100-form-btn" type="submit" value="Login">
                        </div>
                        <a class="d-flex justify-content-center text-info pt-3 " href="#register"><u>Click to Register</u></a>
                    </form>
                </div>
            </div>
        </div>

        <div id="register" class="limiter animate__animated  animate__fadeInDown">
            <div class="container-login100" style="background-image:linear-gradient(#2d194d,#78db92)">
                <div class=" p-t-30 p-b-50 col-lg-6" style="min-height:max-content !important">
                    <span class="login100-form-title p-b-41">
                        HR | Register
                    </span>

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
                    {{-- @include('sweetalert::alert') --}}
                    <form id="register_hr" action="/hr/register" method="post" class="form card bg-white col-lg-12  p-b-33 p-t-5">
                        @csrf
                        <div class="card-body">
                            <div class="form-group row">
                                <div class="col-lg-6 ">
                                    <label>Full Name:</label>
                                    <input type="text" class="form-control" onkeypress="return isNumberKey(event)" name="name" value="{{old('name')}}" placeholder="Enter full name"/>
                                </div>
                                <div class="col-lg-6 ">
                                    <label>Contact Number:</label>
                                    <input type="text" onChange="checkInput(this)" onKeyup="checkInput(this)" name="contact" maxlength="10" class="form-control" value="{{old('contact')}}" placeholder="Enter contact number"/>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-lg-6 ">
                                    <label>Email Address:</label>
                                    <input type="email" name="email" class="form-control" value="{{old('email')}}"  placeholder="Enter your address"/>
                                </div>
                                <div class="col-lg-6 ">
                                    <label>Date Of Birth:</label>
                                    <input type="date" name="dob" class="form-control" value="{{old('dob')}}" placeholder="Enter your postcode"/>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-lg-12 ">
                                    <label>Address:</label>
                                    <textarea type="text" name="address" class="form-control" value="{{old('address')}} " placeholder="Enter your postcode">   </textarea>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-lg-6 ">
                                    <label>Password:</label>
                                    <input id="regPass" type="password" name="password" class="form-control"  placeholder="********"/>
                                </div>
                                <div class="col-lg-6 ">
                                    <label>Confirm Password:</label>
                                    <input type="password" name="password_confirmation" class="form-control" placeholder="********" />
                                </div>
                            </div>
                        </div>
                        <div class="container-login100-form-btn">
                            <input type="submit" value="Register" class="login100-form-btn " style="cursor: pointer">
                        </div>
                        <a class="d-flex justify-content-center text-info pt-3" href="#login">Login Here</a>
                    </form>
                </div>
            </div>
        </div>
    </div>

<!--===============================================================================================-->
{{-- <script src="vendor/jquery/jquery-3.2.1.min.js"></script> --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/jquery.validate.min.js" crossorigin="anonymous"></script>
<!--===============================================================================================-->
	<script src="vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/bootstrap/js/popper.js"></script>
<!--===============================================================================================-->
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/daterangepicker/moment.min.js"></script>
	<script src="vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
	<script src="vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
	<script src="js/main.js"></script>
    <script>
        function checkInput(ob){
        var invalidChars = /[^0-9]/gi
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
    <script src="js/Hr_login.js"></script>
</body>
</html>
