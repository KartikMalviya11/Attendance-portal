<!DOCTYPE html>
<html lang="en">
<head>
	<title>Hashstar | Employee Reset</title>
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
</style>
<body>
{{--
    <div class="backgr d-flex justify-content-center align-items-center">
        <div class="alert-box col-lg-5 p-3 h-25 text-center  col-md-10 col-sm-11">
            <br>
            <h3 class="m-2">Wait For the Approval From HR.</h3>
            <p>You will be notified by email with <b>USERNAME and PASSWORD</b></p>
        </div>
    </div> --}}

	<div class="limiter">
		<div class="container-login100" style="background-image: url('images/bg-01.jpg');">
			<div class="wrap-login100 p-t-30 p-b-50">
				<span class="login100-form-title p-b-41">
					Reset Password
                </span>
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
                  {{-- verify Form   --}}
                @if (Session::get("otp"))

				<form action="/verify" method="post" class="login100-form validate-form p-b-33 p-t-5">
                    @csrf
					<div class="wrap-input100 validate-input" data-validate = "Enter OTP">
						<input class="input100" type="text" name="otp" placeholder="Enter OTP">
						<span class="focus-input100" data-placeholder="&#xe82a;"></span>
					</div>

					<div class="container-login100-form-btn m-t-32">
                        <input style="cursor: pointer"  class="login100-form-btn" type="submit" value="Login">
					</div>
				</form>
                @else
                {{--  Reset Form   --}}
				<form action="/reset" method="post" class="login100-form validate-form p-b-33 p-t-5">
                    @csrf
					<div class="wrap-input100 validate-input" data-validate="Enter password">
						<input class="input100" type="password" name="password" placeholder="New Password">
						<span class="focus-input100" data-placeholder="&#xe80f;"></span>
					</div>
                    <div class="wrap-input100 validate-input" data-validate="Enter password">
						<input class="input100" type="password" name=password_confirmation placeholder="Confirm New Password">
						<span class="focus-input100" data-placeholder="&#xe80f;"></span>
					</div>
					<div class="container-login100-form-btn m-t-32">
                        <input style="cursor: pointer"  class="login100-form-btn" type="submit" value="Login">
					</div>
                     <a class="d-flex justify-content-center text-info pt-3" href="/register">New Employee | Register ?</a>
				</form>
                @endif
			</div>
		</div>
    </div>



	<div id="dropDownSelect1">

    </div>

<!--===============================================================================================-->
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
	<script src="js/main.js"></script>
	<script src="js/Employee_login.js"></script>


</body>
</html>
