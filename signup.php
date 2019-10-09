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
</head>
<script src="https://code.jquery.com/jquery-3.4.1.js"></script>
<script>
    $(document).ready(function (){
        $("#btn").click(function(){
            var email = $('#t1').val();
            var password = $('#t2').val();
            var secpassword = $('#t3').val();
            var secques = $('#t4').val();
            var secans = $('#t5').val();
            if ($("#check").is(":checked")) {  
                var check = "on";    
            } else {
                var check = "off";
            }
            
            if(password == secpassword){
                $.ajax({
                    method:'post',
                    url: 'login/validate.php?email='+email+'&pass='+password+'&check='+check+'&secques='+secques+'&secans='+secans+'&control=signup',
                    success:function(data){
                        $("p").empty();
                        $("p").append("Logging you in !! wait");
                        //$("p").append(data);                        
                        setTimeout(function(){
                            $(location).attr('href', 'index.php');}, 2000);
                    }
                });
            }
            else{
                $("p").empty();
                    $("p").append("Password Mismatch");
            }
        });
    });
    </script>
<body>
    <div>
            <p></p>
            <input type="text" name="email" id="t1" placeholder="Email" required>
            <input type="password" name="pass" id="t2" placeholder="pass" required>
            <input type="password" name="pass2" id="t3" placeholder="pass" required>
            Security Question :
            <select name="" id="t4">
                <option >What is your pet name ?</option>
                <option >What is your birtplace ?</option>
                <option >What is your mother's birthplace ?</option>
                <option >Where was your first vacation ?</option>
            </select>
            <textarea name="secq" id="t5" cols="30" rows="10" required></textarea>
            <input type="checkbox" name="check" id="check"> Remember Me?
            <div id=bottom>
                <input type="button" value="Sign Up" name="sub" id="btn">
                <a href="login.php">Already have an account?</a>
            </div>
        
    </div>
</body>
</html>