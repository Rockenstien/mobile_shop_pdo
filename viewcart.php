
<?php
    require_once('includes/dbconnect.php');
    require_once('includes/session.php');
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
    <form action="cart/add2cart.php?control=remove&m=rm_v" method="post">
    <table border=1>
        <tr>
            <th>Brand</th>
            <th>Mobile Name</th>
            <th>Preview</th>
            <th>Description</th>
            <th>Manufacturing Date</th>
            <th>Warranty (Months)</th>
            <th>Stock</th>
            <th>Discount</th>
            <th>Market Price</th>
            <th>Remove?</th>
        
        </tr>
        <?php
            $id = 1;$row_present = 0;
            $query = $con->connect()->prepare("CALL get_cid_seca_secq(?)");
            $query->execute([$_SESSION['email']]);
            $res_cid = $query->fetchAll();
            $query = $con->connect()->prepare("SELECT mobile_data.*, mobile_brands.b_Name FROM mobile_data INNER JOIN cart on mobile_data.m_id = cart.m_id JOIN mobile_brands on mobile_data.b_id = mobile_brands.b_id where cart.c_id = ?"); 
            $query->execute([$res_cid[0]['c_id']]);
            while($res = $query->fetch()){
                $row_present = 1; //flag for query returning not null
                    echo"<tr>";
                    echo"<td name=brand>".$res['b_Name']."</td>";
                    echo"<td name=val>".$res['mobile_name']."</td>";
                    echo"<td name=pic> <img src=".$res['pic']." alt=?> </td>";
                    echo"<td name=des>".$res['description']."</td>";
                    echo"<td name=mdate>".$res['man_date']."</td>";
                    echo"<td name=wnty>".$res['warranty']." months</td>";
                    echo"<td name=stck> ".$res['stock']." left!</td>";
                    echo"<td name=discount>".$res['discount']."%</td>";
                    echo"<td name=mrp> &#8377;".$res['mrp']."</td>";
                    echo"<input type=hidden name=val value='".$res['mobile_name']."'>";
                    echo"<td> <input type=submit value=Remove></td>";
                    echo"</tr>";
                    $id++;
            }
            if(!$row_present){
                echo"<tr>";
                echo "<td colspan=10 align=center>Your Cart is empty!! Buy some interesting mobiles, OR check the view all orders if you have bought already!! :)</td>";
                echo"</tr>";
            }
        ?>
    </table>
        </form>
    <button id="checkout">Checkout All</button>
</body>
</html>     