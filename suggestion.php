<?php
    require_once('includes/dbconnect.php');
    require_once('includes/session.php');
    require_once('login/usercheck.php');
    require_once('includes/navbar.php');
    if(!$cs->redirect())  header("location:login.php"); //got false, converted true to redirect to login because can't find any session
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        label,input,textarea{
            display: block;
            resize: none;
        }
        b{
            text-decoration: underline;
            margin-bottom:50px;
            display: block;
        }
    </style>
    <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
    <script>
        $(document).ready(function(){
            $("#sg").click(function(){
                var email = $("#email").val();
                var subject = $("#subject").val();
                var suggest = $("#suggest").val();
                $.ajax({
                    method:'post',
                    url: 'suggestion/suggest.php?em='+email+'&sub='+subject+'&sug='+suggest+'',
                    success:function(data){
                        //$("p").append(data);
                        $("p").append("Thanks for suggestion");
                    }
                });
            });
        });
    </script>
</head>
<body>
<form class="col-lg-10">
  <div class="form-group">
    <label for="email">Email address</label>
    <input type="email" class="form-control" id="email" value="<?php echo $cs->getUsername()?>" readonly>
  </div>
  <div class="form-group">
    <label for="Subject">Subject</label>
    <input type="text" class="form-control" id="Subject" placeholder="Enter Subject">
  </div>
  <div class="form-group">
        <label for="suggestion">Suggestion</label>
        <textarea class="form-control" id="suggestion" rows="3"></textarea>
  </div>
  <button class="btn btn-success" id="sg">Suggest!</button>
</form>




</body>
</html>