
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
</head>
<body>
    <p></p>
    
    <table border=1>
        <tr>
            <th>Brand</th>
            <th>Mobile Name</th>
            <th>Picture</th>
            <th>Market Price</th>
        </tr>
        <?php
            $id = 1;$row_present = 0;
            $query = $con->connect()->prepare("CALL get_cid_seca_secq(?)");
            $query->execute([$_SESSION['email']]);
            $res_cid = $query->fetchAll();
            $query = $con->connect()->prepare("SELECT  mobile_brands.b_Name,mobile_data.mobile_name,mobile_data.pic,mobile_data.mrp FROM mobile_data INNER JOIN orders ON mobile_data.m_id = orders.m_id INNER JOIN mobile_brands ON mobile_data.b_id = mobile_brands.b_id WHERE orders.c_id = ?"); 
            $query->execute([$res_cid[0]['c_id']]);
            while($res = $query->fetch()){
                $row_present = 1; //flag for query returning not null
                    echo"<tr>";
                    echo"<td name=brand>".$res['b_Name']."</td>";
                    echo"<td name=val>".$res['mobile_name']."</td>";
                    echo"<td name=pic> <img src=".$res['pic']." alt=?> </td>";
                    echo"<td name=mrp> &#8377;".$res['mrp']."</td>";
                    echo"</tr>";
                    $id++;
            }
            if(!$row_present){
                echo"<tr>";
                echo "<td colspan=10 align=center>You haven't ordered anything yet!! Buy some interesting mobiles, OR check the view all orders if you have bought already!! :)</td>";
                echo"</tr>";
            }
        ?>
    </table>
     
    
</body>
</html>     