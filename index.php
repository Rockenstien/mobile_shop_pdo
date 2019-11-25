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
    <title>Document</title>
  
    <style>
        table{
            text-align:center;
            height:200px;
        }
        *{
            overflow:auto;
        }
        input[type="text"],textarea {
         width: 50%; 
         height:50%;
         margin:0px auto;
        }
        input, textarea, label{
            vertical-align:middle;
        }
        .tdispi{
            display:none;
        }
        #m_name,#desc,#date,#wp,#stock,#discount,#mrp{
            height:40px;
            width:100%
        }
        .upbutton{
            background:rgba(255,255,255,.5);
            border:1px solid black;
        }
        .fa-plus-circle{
            font-size:25px;
        }
        
    </style>
    <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
    <script src="http://code.jquery.com/ui/1.10.0/jquery-ui.js"></script>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="/resources/demos/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.min.css">
  
    <script>
     
    $(document).ready(function(){
        $( function(){
            $("#dashboard").addClass("active");
        });
        $(".datepicker").datepicker();
        $( function() {
        var numItems =  $('.accord_class').length;
        var i=1;
        while(i <= numItems){
            $("#description_accordian" + i).accordion({
                active: 2,
                animate: 200,
                collapsible: true
            });
            i++;
        }
        });
        
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
                $(".start_disp"+i).css({'display':'none'});
                $('#edit_mob' + i).click( function(){
                    
                    //Assigning values to textarea to edit
                    $("#m_name" +i).val($("#mobname" +i).val());
                    $("#b_name" +i).val($("#brandname" +i).val());
                    //var pic = $("#pic").val();
                    //var pic = "try";
                    //
                    $("#desc" +i).text($("#desci" +i).text());
                    var date_replace = $("#datei" +i).text();
                    //$("#date" +i).val("2018-12-19");
                    $("#date" +i).val(date_replace);
                    //$("b").append(date_replace);
                    $("#wp" +i).val($("#wpi" +i).text().match(/(\d+)/)[0]);
                    $("#stock" +i).val($("#stocki" +i).text().match(/(\d+)/)[0]);
                    $("#discount" +i).val($("#discounti" +i).text().match(/(\d+)/)[0]);
                    $("#mrp" +i).val($("#mrpi" +i).text().match(/(\d+\,\d+)/)[0]);
                    //####################################
                    //Assigning above values to variable to send
                    //$("selbid"+i+" option[value='"+bid+"']").attr("selected","selected");
                    //####################################
                    $(".dn" +i).css({'display':'none'});
                    $(".start_disp"+i).css({'display':'block'});
                    $(".tdisp" +i).css({'display':'inline'});
                    $("#edit_mob" + i).text("Update");
                    //$("b").text(bid);
                    $("#edit_mob" +i).attr('id', 'uedit_mob'+i);
                    
                
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
                        alert(data);
                        //location.reload();
                        } 
                    });                       
                });
            });  
            }
        });
        $(function(){
            var numItems = $('.emc').length;
            for(let i=1; i<= numItems; i++){
                $("#img-button" +i).click(function(){
                    var mname = $("#mobname" +i).val();
                    //$("#img-button" +i).text("⬆️");
                    $("#imgupload" +i).trigger('click');
                    $("#imgupload" +i).change(function(){
                        var name = document.getElementById("imgupload" +i).files[0].name;
                        var form_data = new FormData();
                        var ext = name.split('.').pop().toLowerCase();
                        if(jQuery.inArray(ext,['jpeg','png','jpg']) == -1){
                            alert("Extension not supported");
                        }
                        var f = document.getElementById("imgupload" +i).files[0];
                        var fsize = f.size||f.fileSize;
                        if(fsize > 2000000){
                            alert("Image File Size is very big");
                        }
                        else{
                            form_data.append("file", document.getElementById('imgupload' +i).files[0]);
                            form_data.append("mname",mname);
                            $.ajax({
                                url:"upload/img_upload.php",
                                method:"POST",
                                data: form_data,
                                contentType: false,
                                cache: false,
                                processData: false,
                                beforeSend:function(){
                                    $('#img-loader' +i).removeClass("fa-plus-circle");
                                    $('#img-loader' +i).addClass("spinner-border");
                                    
                                },   
                                success:function(data){
                                    //$('#uploaded_image' +i).html(data);
                                    //$("p").append(data);
                                    
                                    setTimeout(function(){
                                        location.reload();
                                    });
                                }
                            });
                        }
                    });
                });
            } 
        });
    });
    </script>
</head>
<body>
<b></b>

<div class="container">
   
<?php
    $id = 1;
    $query = $con->connect()->prepare("SELECT * FROM `mobile_brands` WHERE 1");
    $query->execute();
    $resbnames = $query->fetchAll();
    $query = $con->connect()->prepare("CALL fetch_mobiles_brand");
    $query->execute();
    while($res = $query->fetch()){
?>
    <div class="card mb-3">
            <div class="row no-gutters">
                <div class="col-md-4" >
                    <img src="<?php echo $res['pic'];?>" class="card-img img-responsive" alt="Image of <?php echo $res['mobile_name'];?>">
                    <?php 
                        if($aon){ //only for admin?>
                        <input type="file" id="imgupload<?php echo $id;?>" style="display:none"/> 
                        <button class="card-img-overlay btn upbutton" id="img-button<?php echo $id; ?>"><i id="img-loader<?php echo $id;?>" class="fas fa-plus-circle"></i></button>
                    <?php } ?>
                    </div>
                <div class="col-md-8">
                    <div class="card-body">
                        <h5 class="card-title dn<?php echo $id;?>"><?php echo $res['b_Name']." - ".$res['mobile_name'];?></h5>
                        <input type="hidden" id="mobname<?php echo $id;?>" value="<?php echo $res['mobile_name'];?>" >
                        <input type="hidden" id="brandname<?php echo $id;?>" value="<?php echo $res['b_Name'];?>">
                        <div class="accord_class dn<?php echo $id;?>" id="description_accordian<?php echo $id;?>">
                            <h3>1. Description</h3>
                            <div>
                                <p id="desci<?php echo $id;?>"><?php echo $res['description'];?></p>
                            </div>
                            <h3>2. Buying Information</h3>
                            <div>
                                <p><?php echo"<b>Manufacturing Date - </b> <span id=datei".$id.">".$res['man_date']."</span><br><b>Warranty - </b> <span id=wpi".$id.">".$res['warranty']."</span><br> <b>Discount -</b><span id=discounti".$id.">".$res['discount']."%</span>"?></p>
                            </div>
                        </div>
                        <p id=mrpi<?php echo $id; ?> class="catd-text dn<?php echo $id;?>"><b>MRP - &#8377;<?php echo $res['mrp'];?></b></p>
                        <p id=stocki<?php echo $id; ?> class="card-text dn<?php echo $id;?>"><small class="text-muted">Only <?php echo $res['stock']?> left!</small></p>
                        <div class="tdispi form-group start_disp<?php echo $id;?>">
                            <label for=b_name<?php echo $id;?>>Brand Name :</label>
                            <input class="form-control" id=b_name<?php echo $id;?> class="tdispi tdisp<?php echo $id;?>" readonly>
                        </div>
                        <div class="tdispi form-group start_disp<?php echo $id;?>">
                            <label for=m_name<?php echo $id;?>>Mobile Name :</label>
                            <input class="form-control" id=m_name<?php echo $id;?> class="tdispi tdisp<?php echo $id;?>" readonly>
                        </div>
                        <div class="tdispi form-group start_disp<?php echo $id;?>">
                            <label for=desc<?php echo $id;?>>Description :</label>
                            <textarea class="form-control" id=desc<?php echo $id;?> cols=30 rows=10 class="tdispi tdisp<?php echo $id;?>"></textarea>
                        </div>
                        
                        <div class="tdispi form-group start_disp<?php echo $id;?>">
                            <label for=date<?php echo $id;?>>Date :</label>
                            <input class="form-control datepicker"  type=date id=date<?php echo $id;?> class="tdispi tdisp<?php echo $id;?>">
                        </div>
                        <div class="tdispi form-group start_disp<?php echo $id;?>">
                            <label for=wp<?php echo $id;?>>Warranty :</label>
                            <input class="form-control" id=wp<?php echo $id;?> class="tdispi tdisp<?php echo $id;?>">
                        </div>
                        <div class="tdispi form-group start_disp<?php echo $id;?>">
                            <label for=stock<?php echo $id;?>>Stocks :</label>
                            <input class="form-control" id=stock<?php echo $id;?> class="tdispi tdisp<?php echo $id;?>">
                        </div>
                        <div class="tdispi form-group start_disp<?php echo $id;?>">
                            <label for=discount<?php echo $id;?>>Discount :</label>
                            <input class="form-control" id=discount<?php echo $id;?>  class="tdispi tdisp<?php echo $id;?>">
                        </div>
                        <div class="tdispi form-group start_disp<?php echo $id;?>">
                            <label for=mrp<?php echo $id;?>>Mrp :</label>
                            <input class="form-control" id=mrp<?php echo $id;?> class="tdispi tdisp<?php echo $id;?>">
                        </div>
                        
                        <?php
                        if(!$aon){
                            echo"<button class=\"btn btn-primary cart_change\" id=m".$id." value='".$res['mobile_name']."'>Add</button>";    
                        }
                        else if($aon){
                            echo"<button class=\"btn btn-primary emc\" id=edit_mob".$id.">Edit</button>";
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>    
      
    <?php $id++;    } 
    
    if($aon){?>
    <div class="card text-white bg-primary mb-3">
    <div class="card-header">Add More Phones</div>
    <div class="card-body">
    <h5 class="card-title">Primary card title</h5>
    <div class="form-group">
    <select id="selbid" class="form-control"required>
        <option value="">Please Select</option>
        <?php
            $query = $con->connect()->prepare("SELECT * FROM `mobile_brands` WHERE 1");
            $query->execute();
            while($res = $query->fetch()){
                echo "<option value=".$res['b_id'].">".$res['b_Name']."</option>";
            }
        ?>
    </select>
    </div>
    <div class="form-group">
        <label for=m_name>Mobile Name:</label>
        <input class="form-control" type=text id=m_name >
    </div>
    <div class="form-group">
        <label for=desc>Description :</label>
        <textarea class="form-control" id=desc></textarea>
    </div>
    <div class=" form-group">
        <label for=date>Date :</label>
        <input class="form-control" type=date id=date>
    </div>
    <div class=" form-group">
        <label for=wp>Warranty :</label>
        <input class="form-control" type=text id=wp>
    </div>
    <div class=" form-group">
        <label for=stock>Stocks :</label>
        <input class="form-control" type=text id=stock>
    </div>
    <div class="form-group">
        <label for=discount>Discount :</label>
        <input class="form-control" type=text id=discount>
    </div>
    <div class=" form-group">
        <label for=mrp>Mrp :</label>
        <input class="form-control" type=text id=mrp>
    </div>
    <button id="add_mob" class="btn btn-secondary">Add</button>
  </div>
</div><?php }?>
</div>    
    
</body>
</html>