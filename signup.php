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
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <title>Document</title>
</head>
<script src="https://code.jquery.com/jquery-3.4.1.js"></script>
<script>
    $(document).ready(function (){
        $("#sbtn").click(function(){
            var email = $('#validationServer01').val();
            var password = $('#validationServer02').val();
            var secpassword = $('#validationServer03').val();
            var secques = $('#inputState').val();
            var secans = $('#validationServer03').val();
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
                            $(location).attr('href', 'index.php');}, 100);
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
    
    <div class="container">
    <div class="card">
    <div class="card-header text-center">
                Sign Up
            </div>
        <div class="card-body">
        <div class="form-row">
    <div class="col-md-4 mb-3">
      <label for="validationServer01">Enter Email</label>
      <input type="text" class="form-control" id="validationServer01" placeholder="Email" required>
      <div class="feed"></div>
    </div>
    <div class="col-md-4 mb-3">
      <label for="validationServer02">Enter New Password</label>
      <input type="password" class="form-control" id="validationServer02" placeholder="Password" required>
      <div class="feed"></div>
    </div>
    <div class="col-md-4 mb-3">
      <label for="validationServer03">Enter Password Again</label>
      <input type="password" class="form-control" id="validationServer03" placeholder="Password" required>
      <div class="feed"></div>
    </div>
  </div>
  <div class="form-row">
  <div class="col-md-6 mb-3">
      <label for="inputState">Security Question</label>
      <select id="inputState" class="form-control">
        <option >What is your pet name ?</option>
        <option >What is your birtplace ?</option>
        <option >What is your mother's birthplace ?</option>
        <option >Where was your first vacation ?</option>
      </select>
    </div>
      
    <div class="col-md-6 mb-3">
      <label for="validationServer04">Security Answer</label>
      <input type="text" class="form-control" id="validationServer04" placeholder="Security Answer" required>
      <div class="feed"></div>
    </div>
  </div>
  <div class="form-group">
    <div class="form-check">
      <input class="form-check-input" type="checkbox" value="" id="check" required>
      <label class="form-check-label" for="check">
        Remember you?
      </label>
      <div class="invalid-feedback">
        You must agree before submitting.
      </div>
    </div>
  </div>
  <button class="btn btn-primary" id="sbtn" type="submit">Submit form</button>
  </div>
        </div>
    </div>
</body>
</html>