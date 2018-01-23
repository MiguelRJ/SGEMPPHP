<?php

define ("DATABASE","classrooms");
define ("MYSQL_HOST","mysql:host=localhost;dbname=".DATABASE);
define ("MYSQL_USER","www-data");
define ("MYSQL_PASSWORD","www-data");

// Tabla de los usuarios registrados para reservar aulas
define ("TABLE_USER","user");
define ("COLUMN_USER_USERNAME","username");
define ("COLUMN_USER_PASSWORD","password");

// Tabla de las aulas disponibles
define ("TABLE_CLASS","class");

// Tabla de los posibles tramos horarios
define ("TABLE_TIMETABLE","timetable");

// Tabla de las reservas hechas sobre las aulas
define ("TABLE_BOOKING","booking");
define ("COLUMN_BOOKING_USER","_idUser");
define ("COLUMN_BOOKING_CLASS","_idClass");
define ("COLUMN_BOOKING_TIMETABLE","_idTimeTable");
define ("COLUMN_BOOKING_DATE","date");


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
            $sql="SELECT * FROM ".TABLE_USER." WHERE ".COLUMN_USER_USERNAME."='".$user."' AND ".COLUMN_USER_PASSWORD."='".SHA1($password)."'";
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

    function getUserIdByName($username){
        try {
            $sql="SELECT _id FROM ".TABLE_USER." WHERE ".COLUMN_USER_USERNAME."="."'".$username."'";
            $statement = $this->con->prepare($sql);
            $statement->execute();
            $users = $statement->fetchAll(PDO::FETCH_ASSOC);
            foreach($users as $row){
                return $row["_id"];
            }
        } catch(PDOException $e){
            
        }
    }

    function getBooking($idUser){
        try {
            $sql="SELECT * FROM ".TABLE_BOOKING." WHERE ".COLUMN_BOOKING_USER."=".$idUser;
            $statement = $this->con->prepare($sql);
            return $statement;
        } catch(PDOException $e){
            
        }
    }

}

?>