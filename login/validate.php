<?php
session_start();
require_once('../includes/dbconnect.php');
class lls extends dbconnect{
    private $mail;
    private $pass;
    private $secques;
    private $secans;
    private $query;
    private $found;
    private $control;
    private $cid;
    public $msg;
    public function __construct($email,$password,$sq,$sa,$ch){
        $this->found = FALSE; //credentials flag   
        $this->mail = $email;
        $this->pass = md5($password);
        $this->secques = $sq;
        $this->secans = md5($sa);
        $this->check =$ch;
    }

    public function login(){
        //__contruct("login");
        //$this->query = parent::connect()->query("CALL fetch_cred()") or die();
        $this->query = parent::connect()->prepare("CALL fetch_cred()");
        //var_dump($query);
        $this->query->execute();
        while($res = $this->query->fetch()){
            if($this->mail == $res['email']){
                    if($this->pass == $res['pass'])
                        {
                            $this->found = TRUE;
                            setcookie('email', $this->mail, time()-1); //unset previus cookies
                            if($this->check=="on")
                                setcookie("email", $this->mail, time()+100000, '/'); //generating cookie for "Remember me"
                            $_SESSION['email']=$this->mail; //creating session after login
                            echo true;
                        }
                }
            }
        if (!$this->found) echo false; //singup failure
    }


    public function signup(){
            
        $this->query = parent::connect()->prepare("CALL store_cred(?,?,?,?)");
            $this->query->execute([$this->mail,$this->pass,$this->secques,$this->secans]) or die();
            //mysqli_query($con,"CALL store_cred('$mail','$pass','$sec_quest')") or die(mysqli_error($con));
            if($this->check=="on")
                setcookie("email", $this->mail, time()+1000);
            $_SESSION['email'] = $this->mail;
            //header("location:index.php");
            
    }
    public function update_user_info(){
        $this->query = parent::connect()->prepare("CALL get_cid_seca_secq(?)") or die();
        $this->query->execute([$this->mail]);
        $res = $this->query->fetchAll();
        $this->query = ($res[0][1] == $this->secans) ?  parent::connect()->prepare("CALL update_cred(?,?,?)") : NULL;
        $this->msg = ($this->query !=NULL) ? $this->query->execute([$this->pass,$res[0][0],$this->mail]) : "incorrect password";
        echo $res[0][1];
    }
    public function check_email(){
        $this->secq = NULL;
        $this->query=parent::connect()->prepare("CALL check_email");
        $this->query->execute() or die();
        $res = $this->query->fetchAll();
        foreach($res as $search_m)
            {
                if(in_array($this->mail,$search_m)) {$this->secq = $search_m['sec_question'];   break;}
            }
        echo $this->secq;
    }
}

/* Function calling */
$call_function = $_REQUEST['control'];
$mail = $_REQUEST['email'];
$pass = md5($_REQUEST['pass']); 
(isset($_REQUEST['check'])) ? $check = $_REQUEST['check'] : $check = NULL ;
if(isset($_REQUEST['secques'])&&isset($_REQUEST['secans'])) {   $secq = $_REQUEST['secques']; $seca = $_REQUEST['secans'];   }
else {  $secq = NULL; $seca = NULL; }
$lls_obj = new lls($mail,$pass,$secq,$seca,$check);
switch($call_function){
    case "login" : $lls_obj->login(); break;
    case "signup" : $lls_obj->signup(); break;
    case "uui"  : $lls_obj->update_user_info(); break;
    case "spwnsecq" : $lls_obj->check_email(); break;
}
?>