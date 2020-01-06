<?php 
require_once('../includes/session.php');
require_once('../includes/dbconnect.php');


class suggest extends dbconnect{
    private $email;
    private $subject;
    private $suggest;
    private $query;
    public function __construct($em,$sb,$sg){
        $this->email = $cs-getUsername();
        $this->subject = $sb;
        $this->suggest = $sg;
    }
    public function send_suggestion(){
        $this->query = parent::connect()->prepare("INSERT INTO suggestion(email,subject,suggestion) values(?,?,?)");
        $this->query->execute([$this->email,$this->subject,$this->suggest]);

    }
}

if(isset($_REQUEST['sub']) && isset($_REQUEST['sug'])){
    $sg = new suggest($_REQUEST['sub'],$_REQUEST['sug']);    
    $sg->send_suggestion();
}
else{
    header("location:suggestion.php");    
}
?>