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
            height:200px;
        }
        input[type="text"],textarea {
         width: 100%; 
         height:100%;
        }
        .tdispi{
            display:none;
        }
    </style>
    <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
    <script>
    $(document).ready(function(){
        
        //alert(numItems);
        $(function () {
            var numItems = $('.cart_change').length;
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
        $("#add_mob").click(function(){
            
            var bid = $("#selbid").val();
            var mname = $("#m_name").val();
            //var pic = $("#pic").val();
            var pic = "try";
            var desc = $("#desc").val();
            var mdate = $("#date").val();
            var wp = $("#wp").val();
            var stock = $("#stock").val();
            var discount = $("#discount").val();
            var mrp = $("#mrp").val();
            //$("b").text(bname);
            
            $.ajax({
                method:'post',
                url:'edash/edash.php?bid='+bid+'&mname='+mname+'&pic='+pic+'&desc='+desc+'&mdate='+mdate+'&wp='+wp+'&stock='+stock+'&disc='+discount+'&mrp='+mrp+'&control=add', 
                success:function(data){
                    //$("b").append(data);
                    location.reload();
                }                        
            });
        });
        //alert(numItems);
        $(function () {
            var numItems = $('.emc').length;
            for(let i = 1; i <= numItems; i++) {
                $('#edit_mob' + i).click( function(){
                    
                    //Assigning values to textarea to edit
                    $("#m_name" +i).val($("#m_namei" +i).text());
                    //var pic = $("#pic").val();
                    //var pic = "try";
                    //
                    $("#desc" +i).text($("#desci" +i).text());
                    //var date_replace = $("#datei" +i).text();
                    //$("#date" +i).val("2018-12-19");
                    //$("#date" +i).val(date_replace);
                    //$("b").append(date_replace);
                    $("#wp" +i).text($("#wpi" +i).text().match(/(\d+)/)[0]);
                    $("#stock" +i).text($("#stocki" +i).text().match(/(\d+)/)[0]);
                    $("#discount" +i).text($("#discounti" +i).text().match(/(\d+)/)[0]);
                    $("#mrp" +i).text($("#mrpi" +i).text().match(/(\d+\,\d+)/)[0]);
                    //####################################
                    //Assigning above values to variable to send
                    //$("selbid"+i+" option[value='"+bid+"']").attr("selected","selected");
                    //####################################
                    $(".dn" +i).css({'display':'none'});
                    $(".tdisp" +i).css({'display':'inline'});
                    $("#edit_mob" + i).text("Update");
                    //$("b").text(bid);
                    $("#edit_mob" +i).attr('id', 'uedit_mob'+i);
                    $('#edit_mob' + i).click( function(){
                });
                $('#uedit_mob' +i).click(function(){
                    var bid = $("#selbid" +i).val();
                    var mdate = $("#date" +i).val();
                    var mname = $("#m_name" +i).val();
                    //var pic = $("#pic").val();
                    //var pic = "try";
                    var desc = $("#desc" +i).val();
                    //alert(desc);
                    
                    var wp = $("#wp" +i).val(); 
                    var stock = $("#stock" +i).val(); 
                    var discount = $("#discount" +i).val(); 
                    var mrp = $("#mrp" +i).val(); 
                    //alert(bid+" "+mdate+" "+mname+" "+desc+" "+wp+" "+stock+" "+discount+" "+mrp);
                    $.ajax({
                            method:'post',
                            url:'edash/edash.php?bid='+bid+'&mname='+mname+'&pic=nothing&desc='+desc+'&mdate='+mdate+'&wp='+wp+'&stock='+stock+'&disc='+discount+'&mrp='+mrp+'&control=edit', 
                            success:function(data){
                            //$("b").append(data);
                            location.reload();
                            } 
                        });                       
                    });
                });
                
            }
                
                

            /**/
            
            
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
            <?php if($aon){
                       echo "<li><a href=userinfo.php>View User Info</a></li>";                
            }
            else{
                    echo "<li><a href=viewcart.php>View Cart</a></li>";
            }?>
            <li><a href="vieworders.php">View All orders</a></li>
            <li><a href="suggestion.html"> <?php echo ($aon) ? "View Suggestions" : "Suggest" ; ?></a></li>
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
            <?php
                if(!$aon){
                    echo "<th>Add to cart?</th>"; 
                }
                else if($aon){
                    echo "<th>Add or Edit</th>";
                }
            ?>
            
           
        </tr>
        <?php
            $id = 1;
            $query = $con->connect()->prepare("SELECT * FROM `mobile_brands` WHERE 1");
            $query->execute();
            $resbnames = $query->fetchAll();
            $query = $con->connect()->prepare("CALL fetch_mobiles_brand");
            $query->execute();
            //$query = mysqli_query($con,"CALL fetch_mobiles_brand");
            while($res = $query->fetch()){
                echo"<tr>";
                echo"<td>";
                
                echo"<select id=selbid".$id." class=\"tdispi tdisp".$id."\" required>";
                echo "<option value=>Please Select</option>";
                
                            foreach($resbnames as $rows){
                                echo "<option value=".$rows['b_id'].">".$rows['b_Name']."</option>";
                            }
                echo"</select>";
                
                
                echo "<p class=dn".$id.">".$res['b_Name']."</p></td>";
                echo"<td><textarea id=m_name".$id." cols=30 rows=10 class=\"tdispi tdisp".$id."\"></textarea><p id=m_namei".$id." class=dn".$id.">".$res['mobile_name']."</p></td>";
                echo"<td> <img class=dn".$id." src=".$res['pic']." alt=?> </td>";
                echo"<td><textarea id=desc".$id." cols=30 rows=10 class=\"tdispi tdisp".$id."\"></textarea><p id=desci".$id." class=dn".$id.">".$res['description']."</p></td>";
                echo"<td> <input type=date id=date".$id." class=\"tdispi tdisp".$id."\"> <p id=datei".$id." class=dn".$id."> ".$res['man_date']."</p></td>";
                echo"<td><textarea id=wp".$id." cols=30 rows=10 class=\"tdispi tdisp".$id."\"></textarea><p id=wpi".$id." class=dn".$id.">".$res['warranty']." months</p></td>";
                echo"<td><textarea id=stock".$id." cols=30 rows=10 class=\"tdispi tdisp".$id."\"></textarea><p id=stocki".$id." class=dn".$id.">".$res['stock']." left!</p></td>";
                echo"<td><textarea id=discount".$id." cols=30 rows=10 class=\"tdispi tdisp".$id."\"></textarea><p id=discounti".$id." class=dn".$id.">".$res['discount']."%</p></td>";
                echo"<td><textarea id=mrp".$id." cols=30 rows=10 class=\"tdispi tdisp".$id."\"></textarea><p id=mrpi".$id." class=dn".$id."> &#8377;".$res['mrp']."</p></td>";
                if(!$aon){
                    echo"<td> <button class=cart_change id=m".$id." value='".$res['mobile_name']."'>Add</button></td>";    
                }
                else if($aon){
                    echo"<td><button class=emc id=edit_mob".$id.">Edit</button</td>";
                }
                echo"</tr>";
                echo "<input type=hidden value=".$id.">";
                $id++;
            }
            if($aon){
            ?>
                <tr>
                <td>
                   <select id="selbid" required>
                        <option value="">Please Select</option>
                        <?php
                        $query = $con->connect()->prepare("SELECT * FROM `mobile_brands` WHERE 1");
                        $query->execute();
                            while($res = $query->fetch()){
                                echo "<option value=".$res['b_id'].">".$res['b_Name']."</option>";
                            }
                        ?>
                    </select>
                </td>
                <td><textarea name="" id="m_name" cols="30" rows="10" placeholder="Enter Mobile Name" required></textarea></td>
                <td id="pic" value="#">In progrss!</td>
                <td><textarea name="" id="desc" cols="30" rows="10" placeholder="Enter Description" required></textarea></td>
                <td> <input type="date" name="" id="date" required> </td>
                <td><textarea name="" id="wp" cols="30" rows="10" placeholder="Enter Warranty Period (Only number)" required></textarea></td>
                <td><textarea name="" id="stock" cols="30" rows="10" placeholder="Enter In stock(in numbers)" required></textarea></td>
                <td><textarea name="" id="discount" cols="30" rows="10" placeholder="Enter Discount(Numbers)" required></textarea></td>
                <td><textarea name="" id="mrp" cols="30" rows="10" placeholder="Enter Mrp in (Numbers)" required></textarea></td>
                <td><button id="add_mob">Add</button></td>
            </tr>
            <?php
            } //end of user check and add table
            ?>
    </table>
</body>
</html>