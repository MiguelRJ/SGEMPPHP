<?php

define("DATABASE","classroms");
define ("MYSQL_HOST","mysql:host=localhost;dbname=".DATABASE);
define ("MYSQL_USER","www-data");
define ("MYSQL_PASSWORD","www-data");

define ("TABLE_USER","user");
define ("TABLE_CLASS","class");
define ("TABLE_TIMETABLE","timetable");
define ("TABLE_BOOKING","booking");
define ("COLUMN_USER_NAME","name");
define ("COLUMN_USER_PASSWORD","password");

class Dao {
    
    protected $con;
    public $error;
    
    function __construct(){
        try{
            $this->con=new PDO(MYSQL_HOST,MYSQL_USER,MYSQL_PASSWORD);
        } catch(PDOException $e){
            $this->error="Error en la conexion: ".$e->getMessage();
            $this->con=null;
        }
    }

    function __destruct(){
        if ($this->isConected()){
            $this->con=null;
            unset($this->error);
        }
    }

    function isConected(){
        return $this->con==null?false:true;
    }

    function validateUser($user,$password){
        try {
            $sql="SELECT * FROM ".TABLE_USER." WHERE ".COLUMN_USER_NAME."='".$user."' AND ".COLUMN_USER_PASSWORD."='".SHA1($password)."'";
            //echo $sql;
            $statement=$this->con->query($sql);
            if($statement->rowCount()==1){
                return true;
            } else {
                return false;
            }
        } catch(PDOException $e){
            
        }
    }

}

?>