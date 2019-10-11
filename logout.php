<?php
    session_start();
    session_destroy();

    setcookie("email", null, time()-100000, '/'); //generating cookie for "Remember me"
    echo"logged out";
    header("location:login.php");
?>