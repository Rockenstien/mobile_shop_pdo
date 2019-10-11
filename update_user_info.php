<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    
    <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
    <script>
    $(document).ready(function(){
        $("#btn0").click(function(){
            var email = $('#t1').val();
            $.ajax({
                method:'post',
                url: 'login/validate.php?email='+email+'&control=spwnsecq&pass= ',
                success:function(data){
                    if(data)
                        {   
                            //$("p").empty();
                            //$("p").append(data);
                            $("#t2").css("display","block");
                            $("#ques").css("display","block");
                            $("#ques").val(data);
                            $("#t4").css("display","block");
                            $("#btn1").css("display","block");
                            $("#btn0").css("display","none");
                        }
                        else
                        $("p").append("wrong email address");
                }
            })
        })
        $("#btn1").click(function(){
            var email = $('#t1').val();
            var password = $('#t2').val();
            var secques = $('#t3').val();
            var secans = $('#t4').val();
           $.ajax({
               method:'post',
               url: 'login/validate.php?email='+email+'&pass='+password+'&secques='+secques+'&secans='+secans+'&control=uui',
               success:function(data){
                        
                        if(data){                      
                            setTimeout(function(){
                                $(location).attr('href', 'login.php');}, 2000);
                        }
                        else {
                            $("p").empty();
                            $("p").append("For some reason you can't sign up");
                        }
                    }
           }) 
        })
    })
    </script>
    <style>
        input,select,textarea{
            display:block
        }
        #ques,#t4,#t2,#btn1{
            display:none;
        }
    </style>
</head>
<body>
    <p></p>
    <input type="email" name="mail" id="t1" placeholder = "Enter your e-mail " required>
    <input type="password" name="pass" id="t2" placeholder="Enter new password" required>
    <input type="text" id="ques" readonly>
    <textarea name="secq" id="t4" cols="30" rows="10" required></textarea>
    <input type="button" value="Check Email!" id="btn0">
    <input type="button" value="Change"  id="btn1">
</body>
</html>