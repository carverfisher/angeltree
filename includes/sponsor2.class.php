<?php
include_once 'includes/conn.class.php';

class sponsor extends conn{
	
	var $sponsor_id;
	var $first_name;
    var $last_name;
	var $email;
	var $phone;
    var $sponsor_guid;

    var $sponsor_array;
    var $return_message;
    var $method;    // 1 for insert 2 for update 3 for delete
    private $_check_sponsor_arr;


	function __construct($id=null, $first_name=null, $last_name=null, $email=null, $phone=null, $guid=null){
        parent::__construct();
		$this->assignValues($id, $first_name, $last_name, $email, $phone, $guid);
        $this->_check_sponsor_arr=null;
	}

    function assignValues($id=null, $first_name=null, $last_name=null, $email=null, $phone=null, $guid=null){

        $this->setSponsorId($id);
        $this->setFirstName($first_name);
        $this->setLastName($last_name);
        $this->setEmail($email);
        $this->setPhone($phone);
        $this->setSponsorGuid($guid);

        $this->setSponsorArray(array('sponsor_id'=>$id,'first_name'=>$first_name,'last_name'=>$last_name,'email'=>$email,'phone'=>$phone,'sponsor_guid'=>$guid));
    }

    function assignArrayValues($a){
        $sponsor_id = empty($a['sponsor_id'])? null: $a['sponsor_id'];
        $fname      = empty($a['first_name'])? null: $a['first_name'];
        $lname      = empty($a['last_name']) ? null: $a['last_name'];
        $email      = empty($a['email'])     ? null: $a['email'];
        $phone      = empty($a['phone'])     ? null: $a['phone'];
        $guid       = empty($a['sponsor_guid']) ? null: $a['sponsor_guid'];

        $this->assignValues($sponsor_id,$fname,$lname,$email,$phone,$guid);
    }

    function isSponsor($guid){
        if ($guid == $this->getSponsorGuid()){
            return true;
        }else if( $this->checkSponsor($guid) !== false){
            return true;
        }else{
            return false;
        }
    }

    function checkSponsor($guid){
        $_check_sponsor_arr = $this->getRecord('sponsor_guid',$guid);
        if(empty($_check_sponsor_arr)){
            $this->_check_sponsor_arr=$_check_sponsor_arr;
            return false;
        }else{
            $this->_check_sponsor_arr=$_check_sponsor_arr;
            return $this->_check_sponsor_arr;
        }
    }

    function loadCheckedSponsor($guid=null){
        if(!empty($guid)) {
            $this->checkSponsor($guid);
        }
        if(empty($this->_check_sponsor_arr)) {
            echo "Error no sponsor_arr";
            return;
        }
        $this->assignArrayValues($this->_check_sponsor_arr);
        return;
    }



	function getRecord( $key=null, $value=null){
        $key = (is_null($key))? "sponsor_id": $key;
        $value = (is_null($value))?$this->sponsor_id: $value;

        $sql = "select sponsor_id, first_name, last_name, email, phone, update_time from sponsors where $key='$value'" ;

       // echo "SQL: $sql";
        if($res = $this->mysqli->query("$sql")){
         	return $res->fetch_assoc();
		} else{
            echo "<br>".$this->mysqli->error;

            $this->return_message = $this->mysqli->error;
            echo "<br>".$this->return_message;
        }

        $res->close();
	}

	function insert(){

     	$sql = "INSERT INTO sponsors( first_name, last_name, email, phone) VALUES (?,?,?,?)";
		$stmt = $this->mysqli->prepare($sql);
		$stmt->bind_param("ssss", $val1 , $val2, $val3, $val4);
		
		$val1 = $this->getFirstName();
        $val2 = $this->getLastName();
		$val3 = $this->getEmail();
		$val4 = $this->getPhone();

        if($stmt->execute() ){
            $new_id = $this->mysqli->insert_id;
            $this->setSponsorId($new_id);
            $this->return_message = "Insert Successful id: ".$this->getSponsorId();
            $this->setMethod(1);
        }else{
            if( $this->mysqli->errno ==1062 || $this->mysqli->errno ==1064){
                $row = $this->getRecord("email",$this->getEmail());
                $this->setSponsorId($row['sponsor_id']);
                $this->return_message = "Email Address already exists.";
                $this->setMethod(2);
            }else{
                $this->return_message = "error ".$this->mysqli->errno.": ".$this->mysqli->error." SQl: $sql";
               // $this->return_message = "error";
            }
        }
        $stmt->close();
	}

    function getReturnArr($mysqli){
        return array("id"=>$this->getSponsorId(),"errno"=>$this->mysqli->errno,"message"=>$this->return_message, "method"=>$this->getMethod());
       // return array("sponsor_id"=>"3","errno"=>"2026","message"=>"No real message");
       // echo "calss ". json_encode(array("sponsor_id"=>"3","errno"=>"2026","message"=>"No real message"));
    }
	function setSponsorId($val){
		$this->sponsor_id = $val;
	}
	function getSponsorId(){
		return $this->sponsor_id;
	}

	function setFirstName($val){
		$this->first_name = $val;
	}
	function getFirstName(){
		return $this->first_name;
	}

    function setLastName($val){
        $this->last_name = $val;
    }
    function getLastName(){
        return $this->last_name;
    }

	function setEmail($val){
		$this->email = $val;
	}
	function getEmail(){
		return $this->email;
	}
	
	function setPhone($val){
		$this->phone = $val;
	}
	function getPhone(){
		return $this->phone;
	}

    function setMethod($val){
        $this->method=$val;
    }
    function getMethod(){
        return $this->method;
    }

    function setSponsorGuid($val){
        $this->sponsor_guid=$val;
    }
    function getSponsorGuid(){
        return $this->sponsor_guid;
    }

    function getSponsorArray(){
        return $this->sponsor_array;
    }
    function setSponsorArray($val=null){
        $this->sponsor_array = $val;
    }
}
?>