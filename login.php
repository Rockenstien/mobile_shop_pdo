<?php

//require_once("includes/dbconnect.php");
require_once('includes/session.php');
if($cs->redirect()) header("location:index.php");   //true, because can find session so redirect
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="css/stylelogin.css">
    <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
    <script>
    $(document).ready(function (){
        $("#btn").click(function(){
            var email = $('#t1').val();
            var password = $('#t2').val();
            if ($("#check").is(":checked")) {  
                var check = "on";    
            } else {
                var check = "off";
            }
            
            $.ajax({
                method:'post',
                url: 'login/validate.php?email='+email+'&pass='+password+'&check='+check+'&control=login',
                success:function(data){
                    if(data){
                        $("p").empty();
                        $("p").append("Loggin you in");
                        setTimeout(function(){
                            $(location).attr('href', 'index.php');}, 1000);
                            }
                    else{
                        $("p").empty();
                        $("p").append("Wrong credentials");
                    }
                   
                }
            });
        });
    });
    </script>
</head>
<body>

    <p></p>
    <div>
        <input type="text" name="email" id="t1" placeholder="Email">
        <input type="password" name="pass" id="t2" placeholder="pass">
        <input type="checkbox" name="check" id="check">Remember Me?
       <div id=bottom>
            <input type="button" id="btn" value="login">
            <a href="signup.php">New User?</a>
        </div>
    </div>
</body>
</html>