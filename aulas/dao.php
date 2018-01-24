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
define ("COLUMN_CLASS_NAME","name");
define ("COLUMN_CLASS_SHORTNAME","shortname");
define ("COLUMN_CLASS_LOCATION","location");
define ("COLUMN_CLASS_TIC","tic");
define ("COLUMN_CLASS_NUMPC","numpc");

// Tabla de los posibles tramos horarios
define ("TABLE_TIMETABLE","timetable");
define ("COLUMN_TIMETABLE_HOUR","hour");

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

    /**
     * Devuelve el id de un usuario buscado por su nombre
     */
    function getUserIdByName($username){
        try {
            $sql="SELECT _id FROM ".TABLE_USER." WHERE ".COLUMN_USER_USERNAME."="."'".$username."'";
            $statement = $this->con->prepare($sql);
            $statement->execute();
            $result = $statement->fetchAll(PDO::FETCH_ASSOC);
            foreach($result as $row){
                return $row["_id"];
            }
        } catch(PDOException $e){
            
        }
    }

    /**
     * Devuelve el nombre de un usuario buscado por su id
     */
    function getUSerUsernameByID($idUser){
        try {
            $sql="SELECT ".COLUMN_USER_USERNAME." FROM ".TABLE_USER." WHERE _id='".$idUser."'";
            $statement = $this->con->prepare($sql);
            $statement->execute();
            $result = $statement->fetchAll(PDO::FETCH_ASSOC);
            foreach($result as $row){
                return $row[COLUMN_USER_USERNAME];
            }
        } catch(PDOException $e){
            
        }
    }

    /**
     * Devuelve el nombre corto de un aula buscado por su id
     */
    function getClassShortnameByID($idClass){
        try {
            $sql="SELECT ".COLUMN_CLASS_SHORTNAME." FROM ".TABLE_CLASS." WHERE _id='".$idClass."'";
            $statement = $this->con->prepare($sql);
            $statement->execute();
            $result = $statement->fetchAll(PDO::FETCH_ASSOC);
            foreach($result as $row){
                return $row[COLUMN_CLASS_SHORTNAME];
            }
        } catch(PDOException $e){
            
        }
    }

    /**
     * Devuelve la hora de un tramo horario buscado por su id
     */
    function getTimeTableHourByID($idTimeTable){
        try {
            $sql="SELECT ".COLUMN_TIMETABLE_HOUR." FROM ".TABLE_TIMETABLE." WHERE _id='".$idTimeTable."'";
            $statement = $this->con->prepare($sql);
            $statement->execute();
            $result = $statement->fetchAll(PDO::FETCH_ASSOC);
            foreach($result as $row){
                return $row[COLUMN_TIMETABLE_HOUR];
            }
        } catch(PDOException $e){
            
        }
    }

    /**
     * Devuelve todas las reservas de un usuario concreto buscando por el id del usuario en cuestion
     */
    function getBooking($idUser){
        try {
            $sql="SELECT * FROM ".TABLE_BOOKING." WHERE ".COLUMN_BOOKING_USER."=".$idUser;
            $statement = $this->con->prepare($sql);
            return $statement;
        } catch(PDOException $e){
            
        }
    }

    /**
     * Devuelve todas las reservas de un usuario concreto buscando por el id del usuario en cuestion
     */
    function deleteBooking($idUser,$idClass,$idTimeTable,$date){
        try {
            $sql="DELETE FROM ".TABLE_BOOKING.
            " WHERE ".COLUMN_BOOKING_USER."='".$idUser."' and ".
            COLUMN_BOOKING_CLASS."='".$idClass."' and ".
            COLUMN_BOOKING_TIMETABLE."='".$idTimeTable."' and ".
            COLUMN_BOOKING_DATE."='".$date."'";
            $statement = $this->con->prepare($sql);
            $statement->execute();
        } catch(PDOException $e){
            
        }
    }

}

?>