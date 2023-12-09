<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Hashtar | APPROVE mail</title>
    <!-- Latest compiled and minified CSS -->

</head>
<style>
    *{
        padding:5px;
    }
    body{
        background-image:linear-gradient(orangered,pink);
        background-size:cover;
    }
    b{
        color:rgb(243, 79, 19);
    }
    .text-info,span{
        color: blue;
    }
    .footer{
        padding:10px;
        display: flex;
        justify-content:center;
        width: 100%;
    }
    .footer a{
        padding: 5px;
        background: #08f74f;
        color: white;
        border-radius: 12px;

    }
    .footer a:active{
        transition: 120ms;
        background: #28f164;
    }
</style>
<body>
        <div class="container">
            <div class="header" style="border-bottom:1px solid grey">
                Dear , {{$data['name']}}
            </div>
            <div class="body">
                <b class="text-info">Welcome To Hashstar Family.</b><br>
                <p style="text-indent: 10px"> Your details have been verified and approved by our HR.</p>
                <p style="text-indent: 10px"> Here's your Login Credentials of Employee Dashboard.</p>
                <div class="username">
                    <b>UserName :</b><span>{{$data['company_email']}}</span>
                </div>
                <div class="password">
                    <b>Password :</b><span>{{$data['password']}}</span>
                </div>
            </div>
            <div class="footer" style="border-top:1px solid grey">
                <a href="{{url('/')}}"> Click to Login</a>
            </div>
             <br>
        </div>
</body>
</html>
