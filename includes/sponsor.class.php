<?php

class sponsor {
	
	var $sponsor_id;
	var $first_name;
    var $last_name;
	var $email;
	var $phone;
    var $sponsor_guid;

    var $return_message = null;
    var $method = null;     // 1 for insert 2 for update 3 for delete
	
	function __construct($id=null, $first_name=null, $last_name=null, $email=null, $phone=null, $guid=null){

		$this->assignValues($id, $first_name, $last_name, $email, $phone, $guid);

	}

    function assignValues($id=null, $first_name=null, $last_name=null, $email=null, $phone=null, $guid=null){

        $this->setSponsorId($id);
        $this->setFirstName($first_name);
        $this->setLastName($last_name);
        $this->setEmail($email);
        $this->setPhone($phone);
        $this->setSponsorGuid($guid);
    }

    function checkSponsor($guid){
        $this->getRecord($mysqli,'sponsor_guid',$guid);
    }

	function getRecord($mysqli, $key=null, $value=null){
        $key = (is_null($key))? "sponsor_id": $key;
        $value = (is_null($value))?$this->sponsor_id: $value;

        $sql = "select sponsor_id, first_name, last_name, email, phone, update_time from sponsors where $key='$value'" ;

        echo "SQL: $sql";
        if($res = $mysqli->query("$sql")){
			return $res->fetch_assoc();
		} else{
           // echo "Error:".$mysqli->errno." ".$mysqli->error;
            $this->return_message = $mysqli->error;
        }

        $res->close();
	}
	function insert($mysqli){

     	$sql = "INSERT INTO sponsors( first_name, last_name, email, phone) VALUES (?,?,?,?)";
		$stmt = $mysqli->prepare($sql);
		$stmt->bind_param("ssss", $val1 , $val2, $val3, $val4);
		
		$val1 = $this->getFirstName();
        $val2 = $this->getLastName();
		$val3 = $this->getEmail();
		$val4 = $this->getPhone();

        if($stmt->execute() ){
            $new_id = $mysqli->insert_id;
            $this->setSponsorId($new_id);
            $this->return_message = "Insert Successful id: ".$this->getSponsorId();
            $this->setMethod(1);
        }else{
            if( $mysqli->errno ==1062 || $mysqli->errno ==1064){
                $row = $this->getRecord($mysqli,"email",$this->getEmail());
                $this->setSponsorId($row['sponsor_id']);
                $this->return_message = "Email Address already exists.";
                $this->setMethod(2);
            }else{
                $this->return_message = "error ".$mysqli->errno.": ".$mysqli->error." SQl: $sql";
               // $this->return_message = "error";
            }
        }
        $stmt->close();
	}

    function getReturnArr($mysqli){
        return array("id"=>$this->getSponsorId(),"errno"=>$mysqli->errno,"message"=>$this->return_message, "method"=>$this->getMethod());
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
}
?>