<?php
    
    
    
    require_once('../includes/dbconnect.php');
    session_start();
    class checkout_vorders extends dbconnect{
        private $query;
        private $date;
        function check(){
            $this->query = parent::connect()->prepare("CALL get_cid_seca_secq(?)");
            $this->query->execute([$_SESSION['email']]);
            $res= $this->query->fetchAll()[0]['c_id'];
            $this->query = parent::connect()->prepare("INSERT INTO orders(cart_id,c_id, m_id,date) SELECT cart_id,c_id, m_id,? FROM cart WHERE c_id = ?");
            $this->date = date("Y-m-d H:i:s");
            $this->query->execute([$this->date,$res]);
            $this->query = parent::connect()->prepare("UPDATE mobile_data SET stock = stock - 1 WHERE m_id = (SELECT m_id FROM cart WHERE c_id = ?) and stock >= 0");
            $this->query->execute([$res]);
            $this->query = parent::connect()->prepare("DELETE FROM cart WHERE c_id = ?");
            $this->query->execute([$res]);
        }
    }
    $o = new checkout_vorders();
    $o->check();
?>