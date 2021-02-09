<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <title>Shipbay</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,400italic|Material+Icons">
   <style>                                                                    
        html,
        body {
            height: 100% !important;
            min-height: 100% !important;
            padding: 30px;
            background-color: #f0f2f5;
        }
        .container{
            font-family: 'Roboto';
            padding: 30px;
            margin: auto;
            max-width: 600px;
            box-shadow: 0 1px 2px #11111142;
            border-radius: 8px !important;
            background-color: #fff;
        }
        .heading{
            text-align: center;
        }
        .reset-button{
            padding: 14px 33px;
            border: 0;
            border-radius: 30px;
            background: #f97d4a;
            color: #fff;
            min-width: 174px;
            text-decoration: none;
            font-size: 14px;
        }
        .action{
            text-align: center;
        }
        .line{
            border-top: 1px solid #ddd;
        }
        .grading{
            font-size: 11px;
        }
        .email{
            font-size: 11px;
            color: #f97d4a;
        }
      
    </style>
</head>

<body>
    <div class="container">
       <div class="heading">
            <h1>ShipBay</h1>
       </div>
       <div class="content">
           <p>Hello there !</p>
           <p>You requested a link to change your password. You can do this through the button below.</p>
       </div><br><br>
        <div class="action">
            <!--<a class="reset-button" href="http://localhost:8000/#/reset-password/{{$token}}">Change my password</a>-->
           <a class="reset-button" href="http://35.184.16.20/#/reset-password/{{$token}}">Change my password</a>
        </div>

        <br><br>
        <p>If you didn't request this, please ignore this email. Your password will stay safe and won't be changed.</p>
        <div class="line"></div>
        <span class="grading">Yours, ShipBay Team</span><br>
        <span class="email">support@shipbay.com</span>
    </div>


</body>

</html>