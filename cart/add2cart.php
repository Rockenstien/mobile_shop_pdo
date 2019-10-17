<?php
require_once('../includes/dbconnect.php');
session_start();
class add2cart extends dbconnect{

    private $mobile_name;
    private $query;
    private $cid;
    private $mid;
    public function __construct($val,$control){
        if($val!="Na") $this->mobile_name = $val;
        if($control!="check")   $this->generate_query();
    }
    public function generate_query(){
        $this->query = parent::connect()->prepare("CALL get_cid_seca_secq(?)");
        $this->query->execute([$_SESSION['email']]);
        $res = $this->query->fetchAll();
        $this->query = parent::connect()->prepare("CALL get_pid(?)");
        $this->query->execute([$this->mobile_name]);
        //echo "$this->mobile_name";
        $res1 = $this->query->fetchAll();
        $this->cid = $res[0]['c_id'];
        $this->mid = $res1[0]['m_id'];
        //echo "<pre>";
        //print_r($res1);
    }
    public function check_cart(){
        $this->query = parent::connect()->prepare("CALL get_cid_seca_secq(?)");
        $this->query->execute([$_SESSION['email']]);
        $res = $this->query->fetchAll();
        $this->cid = $res[0]['c_id'];
        $this->query = parent::connect()->prepare("SELECT mobile_data.mobile_name FROM mobile_data INNER JOIN cart on mobile_data.m_id = cart.m_id WHERE cart.c_id = ?");
        $this->query->execute([$this->cid]);
        $res = $this->query->fetchAll();
        $str="";
        foreach($res as $mob)
            $str.= $mob['mobile_name'].",";
        echo trim($str,',');
        
    }
    public function add(){
        
        $this->query = parent::connect()->prepare("CALL add_cart(?,?)");
        $this->query->execute([$this->cid,$this->mid]);
        //echo $cid." ".$mid;

    } 
    public function remove(){
        //$this->check_cart();
        $this->query = parent::connect()->prepare("DELETE FROM cart WHERE m_id = ? and c_id= ? ");
        $this->query->execute([$this->mid,$this->cid]);
        if(isset($_REQUEST['m']))  header("location:../viewcart.php");
    }
}
$a = $_REQUEST['val'];
(isset($_REQUEST['val'])) ? $val = $_REQUEST['val'] :  header("location:../index.php");
$acart = new add2cart($val,$_REQUEST['control']);
switch($_REQUEST['control']){
    case "add"  :   $acart->add();break;
    case "remove" : $acart->remove();break;
    case "check"    :   $acart->check_cart();break;
}
?>