<?php
include_once 'includes/conn.class.php';

class angelItems extends conn{
    var $angel_type;
    var $sponsor_id;
    var $sponsor_guid;
    var $update_time=null;

    function __construct(){
        parent::__construct();
    }

    function getSponsordItems(){

        $sql = "select a.id as angel_id, a.angel_name, a.age, a.gender, i.item_id, i.item_name
                  , i.item_desc ,i.size, isp.sponsor_id
                from items i, angel_items ai, angels a, item_sponsor isp
                where ai.angel_id=a.id and ai.item_id=i.item_id and i.item_id= isp.item_id ";


        if(!empty($this->sponsor_id)){
            $sql .= "and isp.sponsor_id=".$this->getSponsorId();
        }
        if(!empty($this->update_time)){
            $sql .= " and update_time > '".$this->update_time."'";
        }

        $sql .= " order by isp.update_time ";

        if($res = $this->mysqli->query("$sql")){

            if ($res->num_rows > 0) {
                // output data of each row
                while($row = $res->fetch_assoc()) {
                    $item_arr['angel_items'][$row['item_id']] = $row;
                }
            } else {

                $row = $res->fetch_assoc();
                $item_arr['angel_items'][0] = $row;
            }
            return $item_arr;

        }else{
            echo "Error:".$this->getErrno()." :".$this->getError();
            $this->return_message = "Error:".$this->getErrno()." :".$this->getError();
            //echo "<br>".$this->return_message;
            $item_arr['angel_items'][0] = array("id"=>0,"errno"=>$this->getErrno(),"message"=>$this->return_message,"method"=>"select");
            return $item_arr;
        }

    }

    function getAvailableItems(){
        $sql = "select a.id as angel_id, a.angel_name, a.age, a.gender, i.item_id, i.item_name, i.item_desc,i.size
                from items i, angel_items ai, angels a
                where ai.angel_id=a.id and ai.item_id=i.item_id
                   and not exists( select item_sponsor_id from  item_sponsor isp where isp.item_id=ai.item_id)";
echo "SQL: ".$sql;
        if($res = $this->mysqli->query("$sql")){

            if ($res->num_rows > 0) {
                // output data of each row

                while($row = $res->fetch_assoc()) {
                    $angel_arr['angel_items'][$row['item_id']] = $row;
                }
                return $angel_arr;
            } else {
                $angel_arr['angel_items'][0]=$res->fetch_assoc();
                //echo "No Angels Exist";
            }
        }else{
            echo "Error:".$this->getErrno()." :".$this->getError();
            $this->return_message = $this->mysqli->error;
            //echo "<br>".$this->return_message;
            return array("id"=>0,"errno"=>$this->getErrno(),"message"=>$this->return_message,"method"=>"select");

        }

    }

    function assignItemSponsor($item_id,$sponsor_id){
        $sql = "INSERT INTO item_sponsor( item_id, sponsor_id) VALUES (?,?)";
        $stmt = $this->mysqli->prepare($sql);
        $stmt->bind_param("ii", $val1 , $val2);

        $val1 = $item_id;
        $val2 = $sponsor_id;

        if($stmt->execute() ){
            $new_id = $this->mysqli->insert_id;
            $item_sponsor_id = $new_id;
            $return_message = "Your have received you Angel's item";
            $method=1;
        }else{

            if( $this->getErrno() ==1062){
               // $row = $this->getRecord($mysqli,"email",$this->getEmail());
                $item_sponsor_id = 0;
                $return_message = "Sorry to slow. You'r Angel has been assigned elsewhere.";
                $method = 2;
            }else{
                $method=0;
                $return_message = "error ".$this->getErrno().": ".$this->getError()." SQl: $sql";
                // $this->return_message = "error";
            }
        }
        $stmt->close();

        return array("id"=>$item_sponsor_id,"errno"=>$this->getErrno(),"message"=>$return_message,"method"=>$method);
    }


    function getSponsorId(){
        return $this->sponsor_id;
    }
    function setSponsorId($val){
        $this->sponsor_id = $val;
    }
/*
    if($res = $this->mysqli->query("$sql")){
        return $res->fetch_assoc();
    } else{
        echo "<br>".$this->mysqli->error;

        $this->return_message = $this->mysqli->error;
        echo "<br>".$this->return_message;
    }
*/
}
?>