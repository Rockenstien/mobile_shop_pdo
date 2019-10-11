<?php
require_once('includes/dbconnect.php');
//Currently login bug
//if no or 0 user bug
require_once('includes/session.php');
require_once('login/usercheck.php');
if(!$cs->redirect())  header("location:login.php"); //got false, converted true to redirect to login because can't find any session
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Document</title>
    <style>
        table{
            text-align:center;
        }
    </style>
    <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
    <script>
    $(document).ready(function(){
        var numItems = $('.cart_change').length;
        //alert(numItems);
        $(function () {
            var i = 1;
            while (i <= numItems) {
                var vals = $("#m"+i).val();
                //alert(vals);
                var set = 0;
                (function(x,val){
                    $.ajax({
                        method:'post',
                        url:'cart/add2cart.php?val=Na&control=check ',
                        success:function(data){
                            //alert(val);
                            //$("#m"+x).text("Add");
                            //$("b").append(x);
                            var ar = data.split(',');
                            jQuery.each(ar, function(index, item) {
                                //alert(vals+"  "+item)
                                if(val == item){
                                    $("#m"+x).text("Remove");
                                    //alert("g");
                                }
                            });
                        }
                    });
                })(i,vals)
            i++;
    }
});
        
        $(".cart_change").click(function(){
            var mval = $(this).val();
            var txt = $(this).text();
           
            if(txt == "Add"){
                $(this).text("Remove");
                //alert($(this).text());
            $.ajax({
                    method:'post',
                    url:'cart/add2cart.php?val='+mval+'&control=add',
                    success:function(data){
                        //alert(data);
                        //alert($(this).text());
                    }
                });
            }
            else if(txt == "Remove"){
                $(this).text("Add");
                //alert($(this).text());
                $.ajax({
                    method:'post',
                    url:'cart/add2cart.php?val='+mval+'&control=remove',
                    success:function(data){
                        //alert($(this).text());
                    }
                });
            }     
        });
    });
    
    </script>
</head>
<body>
<b></b>
    <p align="right"><?php echo $cs->getUsername();?></p>
    <a href="logout.php">logout?</a>
    <div>
        <ul>
            <li><a href="index.php">Dashboard</a></li>
            <?php if($user->retUsertype() == "admin"){
                       echo "<li><a href=viewuserinfo.php>View User Info</a></li>";                
            }
            else{
                    echo "<li><a href=viewcart.php>View Cart</a></li>";
            }?>
            <li><a href="vieworders.php">View All orders</a></li>
            <li><a href="suggestion.html">Suggest</a></li>
        </ul>
    </div>
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
            <th>Add to cart?</th>
           
        </tr>
        <?php
            $id = 1;
            $query = $con->connect()->prepare("CALL fetch_mobiles_brand");
            $query->execute();
            //$query = mysqli_query($con,"CALL fetch_mobiles_brand");
            while($res = $query->fetch()){
                echo"<tr>";
                echo"<td>".$res['b_Name']."</td>";
                echo"<td>".$res['mobile_name']."</td>";
                echo"<td> <img src=".$res['pic']." alt=?> </td>";
                echo"<td>".$res['description']."</td>";
                echo"<td>".$res['man_date']."</td>";
                echo"<td>".$res['warranty']." months</td>";
                echo"<td>".$res['stock']." left!</td>";
                echo"<td>".$res['discount']."%</td>";
                echo"<td> &#8377;".$res['mrp']."</td>";
                echo"<td> <button class=cart_change id=m".$id." value='".$res['mobile_name']."'>Add</button></td>";
                echo"</tr>";
                $id++;
            }
            
        ?>
    </table>
</body>
</html>