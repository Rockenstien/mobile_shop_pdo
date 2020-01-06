<?php
 require_once('../includes/dbconnect.php');
 session_start();


class editdash extends dbconnect{
    private $bid;
    private $mname;
    private $pic;
    private $desc;
    private $mdate;
    private $wp;
    private $stock;
    private $discount;
    private $mrp;
    private $query;
    private $mid;
    public function __construct($bid,$mname,$pic,$desc,$mdate1,$wp,$stock,$disc,$mrp){
        $this->bid =  $bid;
        $this->mname = $mname;
        $this->pic = $pic;
        $this->desc = $desc;
        $this->mdate = date("Y-m-d",strtotime($mdate1));
        $this->wp = $wp;
        $this->stock = $stock;
        $this->discount = $disc;
        $this->mrp = $mrp;
    }
    public function edit(){
        $this->query = parent::connect()->prepare("SELECT mobile_data.m_id from mobile_data where mobile_data.mobile_name = ?");
        $this->query->execute([$this->mname]);
        echo "<<".$this->mname.">>";
        $this->mid = $this->query->fetchAll()[0];
        var_dump($this->mdate);
        echo "<pre>";
        //var_dump($this->mid['m_id']);
        $this->query = parent::connect()->prepare("UPDATE mobile_data  SET mobile_data.mobile_name = ?, mobile_data.b_id = ?, mobile_data.description = ?, mobile_data.man_date  = ?, mobile_data.warranty  = ?, mobile_data.mrp  = ?, mobile_data.stock  = ?, mobile_data.discount  = ?, mobile_data.pic = ? WHERE m_id = ? ");
        $this->query->execute([$this->mname,$this->bid,$this->desc,$this->mdate,$this->wp,$this->mrp,$this->stock,$this->discount,$this->pic,$this->mid['m_id']]);
    }
    public function add(){
        $this->query = parent::connect()->prepare("INSERT INTO mobile_data(mobile_data.mobile_name, mobile_data.b_id, mobile_data.description,mobile_data.man_date, mobile_data.warranty, mobile_data.mrp,mobile_data.stock, mobile_data.discount, mobile_data.pic) VALUES(?,?,?,?,?,?,?,?,?)");
        $this->query->execute([$this->mname,$this->bid,$this->desc,$this->mdate,$this->wp,$this->mrp,$this->stock,$this->discount,$this->pic]);  
        //echo $this->mname." ".$this->bid." ".$this->desc." ".$this->mdate." ".$this->wp." ".$this->mrp." ".$this->stock." ".$this->discount." ".$this->pic;
    }
}


//driver
if(!isset($_REQUEST['desc'])){ echo $_REQUEST['desc'];}
//echo $_REQUEST['desc']."h";
$odash = new editdash($_REQUEST['bid'],$_REQUEST['mname'],$_REQUEST['pic'],$_REQUEST['desc'],
                      $_REQUEST['mdate'],$_REQUEST['wp'],
                      $_REQUEST['stock'],$_REQUEST['disc'],$_REQUEST['mrp']);
                      
switch($_REQUEST['control']){
    case 'add' : $odash->add(); break;
    case 'edit' : $odash->edit(); break;
}
                      
?>