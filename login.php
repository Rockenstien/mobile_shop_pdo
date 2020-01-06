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
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
   
    <script>
    $(document).ready(function (){
        $(".btn").click(function(){
            var email = $('#email').val();
            var password = $('#pass').val();
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
                        $("#loading").addClass("spinner-border");
                        setTimeout(function(){
                            $(location).attr('href', 'index.php');}, 1000);
                            }
                    else{
                        $("p").empty();
                        $("p").removeClass();
                        $("p").addClass("alert alert-danger");
                        $("p").append("Wrong credentials!!! Try Again");
                    }
                   
                }
            });
        });
    });
    </script>
</head>
<body>
    <p></p>
    <div class="container">
        <div class="card">
            <div class="card-header text-center">
                Login
            </div>
            <div class="card-body">
            <div class="form-group">
                <label for="email">Email address</label>
                <input type="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="Enter email">
                <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
            </div>
            <div class="form-group">
                <label for="pass">Password</label>
                <input type="password" class="form-control" id="pass" placeholder="Password">
            </div>
            <div class="form-group form-check">
                <input type="checkbox" class="form-check-input" id="check">
                <label class="form-check-label" for="check">Remember Password?</label>
            </div>
            <button type="submit" class="btn btn-primary ">Login!</button>
            <div id="loading" class="text-primary" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <div class="alert alert-warning fade show" role="alert">
            <strong>Holy guacamole!</strong> You should create an account if you don't have one, from <a class="alert-link" href="signup.php">here.</a>
        </div>
        <div class="card-footer text-muted">
            Created by Paras Kumar &copy; 
        </div>
    </div>
    
</body>
</html>