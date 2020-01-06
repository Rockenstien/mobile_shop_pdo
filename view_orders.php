<?php
require_once('includes/dbconnect.php');
//Currently login bug
//if no or 0 user bug
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
</head>
<body>
    <table border=1>
        <th>Name</th>
        <th>Password</th>
        <th>Security Question</th>
        <th>Security answer</th>
        <?php
        $query = $con->connect()->prepare("SELECT email, pass, sec_question, sec_ans FROM credentials");
        $query->execute();
        //$query = mysqli_query($con,"CALL fetch_mobiles_brand");
        $query->fetch(); //to fetch out admin
        while($res = $query->fetch()){
            echo"<tr>";
            echo"<td>".$res['email']."</td>";
            echo"<td>".$res['pass']."</td>";
            echo"<td>".$res['sec_question']."</td>";
            echo"<td>".$res['sec_ans']."</td>";
            echo"</tr>";
        }
        ?>
    </table>
</body>
</html>