<?php

# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
//$hostname_angeltree = "127.0.0.1";
class conn
{

    var $mysqli;
    var $return_message;
    var $sql;
    var $result;

    function __construct(){

        $hostname_angeltree = "barga.org";
        $database_angeltree = "barga_angel_tree";
        $username_angeltree = "barga_angelupd";
        $password_angeltree = "tw3n6QXH0E6t";


        $this->mysqli = new mysqli($hostname_angeltree, $username_angeltree, $password_angeltree, $database_angeltree);

        if ($this->mysqli->connect_errno)
        {
            echo "Failed to connect to MySQL: (" . $this->mysqli->connect_errno . ") " . $this->mysqli->connect_error;
        }
    }
/*
    function fetch_Assoc($sql=null, $varTypeArr=array(), $var_arr=array()){
        $this->sql = (is_null($sql))?$this->sql: $this->getSql();

        if ($stmt = $this->mysqli->prepare("$sql")) {

            / bind parameters for markers
            for($i=0;$i<count($varTypeArr);$i++) {
                //$stmt->bind_param("s", $city);
                $stmt->bind_param("$varTypeArr[$i]",$var_arr[$i]);
            }
            $stmt->execute();

            // bind result variables
            $this->result = $stmt->get_result();
            $_temprr = $this->result->fetch_assoc();
            echo "<br>fetching Assoc<br>";
            print_r($_temprr);

            $this->result->close();

            return $_temparr;
        }
        else{
            echo "<br>".$this->mysqli->error;

            $this->return_message = $this->mysqli->error;
            echo "<br>".$this->return_message;
        }
*/
       /*
        if($this->result = $this->mysqli->query("$sql")){
            return $this->result->fetch_assoc();
        } else{
            echo "<br>".$this->mysqli->error;

            $this->return_message = $this->mysqli->error;
            echo "<br>".$this->return_message;
        }
       */
 //   }

    function setReturnMessage($val=null){
        $this->return_message=$val;
    }
    function getReturnMessage(){
        return $this->return_message;
    }

    function getError(){
        return $this->mysqli->error;
    }
    function getErrno(){
        return $this->mysqli->errno;
    }

    function setSql($val){
        $this->sql=$val;
    }
    function getSql(){
        return $this->sql;
    }
}
?>