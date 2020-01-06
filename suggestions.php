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
</head>
<body>
    <div class="container">
        <div class="row">
            <?php
            
            $query = $con->connect()->prepare("SELECT * FROM suggestion");
            $query->execute();
            $res = $query->fetchAll();
            foreach($res as $id){
           ?>
           <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                      <?php echo $id['subject']?>  
                    </div>
                    <div class="card-body">
                        <blockquote class="blockquote mb-0">
                        <p><?php echo $id['suggestion']?></p>
                        <footer class="blockquote-footer"><?php echo $id['email']?></footer>
                        </blockquote>
                    </div>
                </div>
           </div>
            <?php } ?>
        </div>
    </div>
</body>
</html>