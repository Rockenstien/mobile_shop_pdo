<?php 
    session_start();    
    class check_session{
        private $username;
        private $redirect;
        public function __construct(){
            $this->redirect = true;
            if(isset($_COOKIE['email'])){ 
                $this->username = $_COOKIE['email'];
                $_SESSION['email'] = $this->username;
              
            }
            else if(isset($_SESSION['email'])){ 
                $this->username = $_SESSION['email'];
               
            }
            else { 
                $this->redirect = false;
                //$this->username = "";
            } // header("location:login.php");
           
        }
        public function getUsername(){
            return "$this->username";
        }
        public function redirect(){
            return $this->redirect; //redirect to login (beacause of redirect error too many redirects)
        }
    }
    $cs = new check_session();
?>