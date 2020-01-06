
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
    <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
   <script>
    $(document).ready(function(){
        $( function(){
            $("#cart").addClass("active");
        });
        $("#checkout").click(function(){
            $.ajax({
                method : 'post',
                url : 'cart/checkout.php',
                success:function(data){
                    location.reload();
                    //$("p").append(data);
                }
            });
        });
    });
   </script>
</head>
<body>
    <p></p>
    <div class="container">
                <div class="row">
        <?php
        
            $id = 1;$row_present = 0;$each_device_money = 0;$total_money = 0;
            $query = $con->connect()->prepare("CALL get_cid_seca_secq(?)");
            $query->execute([$_SESSION['email']]);
            $res_cid = $query->fetchAll();
            $query = $con->connect()->prepare("SELECT mobile_data.*, mobile_brands.b_Name FROM mobile_data INNER JOIN cart on mobile_data.m_id = cart.m_id JOIN mobile_brands on mobile_data.b_id = mobile_brands.b_id where cart.c_id = ?"); 
            $query->execute([$res_cid[0]['c_id']]);
            while($res = $query->fetch()){ $row_present = 1;
                $each_device_money = str_replace( ',', '', $res['mrp'] );
                $each_device_discount = str_replace(',','', $res['discount']);
                $after_discount_money = (int)$each_device_money*((int)$each_device_discount/100);
            ?>
                
                <form action="cart/add2cart.php?control=remove&m=rm_v" method="post">
                    <div class="card mr-2" style="width: 20em;">
                        <img src="<?php echo $res['pic']?>" class="card-img-top" alt="photo of <?php echo $res['mobile_name']?>">
                        <div class="card-body">
                        <h5 class="card-title"><?php echo $res['b_Name']." - ".$res['mobile_name'];?></h5>
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item"><b>Warranty - </b><?php echo $res['warranty'];?> months</li>
                        <li class="list-group-item"><b>Stock - </b><?php echo $res['stock'];?> left!</li>
                        <li class="list-group-item"><b>Discount - </b><?php echo $res['discount'];?>%</li>
                        <li class="list-group-item"><b>M.R.P - &#8377;</b><span class="disabled" style="text-decoration:line-through"><?php echo $res['mrp'];?></span>
                        <span style="margin-left:10px;">-  <b>&#8377;</b><?php echo number_format($after_discount_money);?></span></li>
                    </ul>
                    <input type="hidden" name=val value="<?php echo $res['mobile_name'];?>">
                    <div class="card-body">
                        <input class="btn btn-primary centre" type="submit" value=Remove>
                    </div>
                    </form>
                

                
</div>
            <?php     //flag for query returning not null
                    $total_money +=$after_discount_money;
                    $id++;
            }
            
            if(!$row_present){
                echo "<div class=\"alert alert-danger\" role=\"alert\">Your Cart is empty!! Buy some interesting mobiles, OR check the view all orders if you have bought already!! :)</div>";
            }else{
                ?>
                </div>
                </div>
                <div class="card text-white bg-success mb-3 text-center">
                <div class="card-header ">Total Bill</div>
                <div class="card-body">
                <h5 class="card-title">Items - <?php echo --$id;?></h5>
                <p class="card-text"><?php echo " &#8377;". number_format($total_money);?></p>
                </div>
                
                <?php
                
                echo "<button class=\"btn btn-primary\" id=\"checkout\">Checkout All</button>";
            }
            
        ?>
    
        
    

</body>
</html>     