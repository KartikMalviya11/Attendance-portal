<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Hashtar | Credentials mail</title>
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
        color: White;
    }


</style>
<body>
        <div class="container">
            <div class="header" style="border-bottom:1px solid grey">
                Dear , {{$data['name']}}
            </div>
            <div class="body">
                This is Password Reset Mail.
                Your OTP :
                <h2 class="text-info">{{$data['otp']}}</h2><br>

            </div>

             <br>
        </div>
</body>
</html>
