<?php
//upload.php
session_start();
require_once('../includes/dbconnect.php');

class uploader extends dbconnect{
    private $mname;
    private $location;
    private $name;
    public function __construct(){
        if($_FILES["file"]["name"] != ''){
            $this->mname = $_POST['mname'];
            $test = explode('.', $_FILES["file"]["name"]);
            $ext = end($test);
            $this->name = str_replace(" ", "", trim($this->mname)) .'.' . $ext;
            $this->location = '../upload/images/' . $this->name;  
            $this->uploader();
            //echo '<img src="'.$location.'" height="150" width="225" class="img-thumbnail" />';
        }
    }
    public function uploader(){
        $moved=move_uploaded_file($_FILES["file"]["tmp_name"], $this->location);
        $this->location = "upload/images/" . $this->name;
        $query = parent::connect()->prepare("update mobile_data set pic = ? where mobile_name = ?");
        $query->execute([$this->location,$this->mname]);
        //echo $mname;
    }
}
$uploader = new uploader();

?>