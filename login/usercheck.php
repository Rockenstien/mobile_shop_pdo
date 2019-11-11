<?php 
class usercheck{
    private $user;
    public function __construct(){
        $this->user = $_SESSION['email'];
    }
    public function retUsertype(){
        return $this->user;
    }
}
$user = new userCheck();
$aon = ($user->retUsertype() == "admin") ? true : false;
?>