<?php

class angel{
	
	var $id;
	var $angel_name;
	var $gender;
	var $age;
	var $update_time;
	
	function __construct($id=null, $angel_name=null, $gender=null, $age=null){
        echo "New Angel Obj <br>";

		$this->setId($id);
		$this->setAngelName($angel_name);
		$this->setGender($gender);
		$this->setAge($age);
	}
	
	function getRecord($mysqli){
		if(empty($this->id)){
			echo "<BR>No ID <br>";
			die();
		}
		$sql = "select angel_name, gender, age, update_time from angel where id=".$this->$id ;
		if($res = $mysqli->query("$sql")){
			$row = $res->fetch_row();
			pre($row, 'row');
		}
        $res->close();
	}


	function insert($mysqli){
/*		$sql = "INSERT INTO angels( angel_name, Gender, age)
		VALUES (".$this->getAngelName().",'".$this->getGender()."',".$this->getAge()." )";
*/
     	$sql = "INSERT INTO angels( angel_name, Gender, age) VALUES (?,?,?)";
		$stmt = $mysqli->prepare($sql);
		$stmt->bind_param("ssi", $val1 , $val2, $val3);
		
		$val1 = $this->getAngelName();
		$val2 = $this->getGender();
		$val3 = $this->getAge();
		
		if($stmt->execute() ){
			$new_id = $mysqli->insert_id;
			$this->setId($new_id);
		}else{
			echo "<br> error ".$mysqli->error."<br> SQl: $sql";
		}
        $stmt->close();

	}
	
	function setId($val){
		$this->id = $val;
	}
	function getId($val){
		return $this->id;
	}

	function setAngelName($val){
        echo "Setting Angle Number: ".$val."<br>";
		$this->angel_name = $val;
	}
	function getAngelName(){
		return $this->angel_name;
	}
	
	function setGender($val){
		$this->gender = $val;
	}
	function getGender(){
		return $this->gender;
	}
	
	function setAge($val){
		$this->age = $val;
	}
	function getAge(){
		return $this->age;
	}
	
}
?>