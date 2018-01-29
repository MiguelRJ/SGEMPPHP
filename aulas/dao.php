<?php

define ("DATABASE","classrooms");
define ("MYSQL_HOST","mysql:host=localhost;dbname=".DATABASE);
define ("MYSQL_USER","www-data");
define ("MYSQL_PASSWORD","www-data");

// Tabla de los usuarios registrados para reservar aulas
define ("TABLE_USER","user");
define ("COLUMN_USER_USERNAME","username");
define ("COLUMN_USER_PASSWORD","password");
define ("COLUMN_USER_NAME","name");
define ("COLUMN_USER_DATE","birthdate");
define ("COLUMN_USER_EMAIL","email");

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
define ("COLUMN_BOOKING_BOOK","bookReason");
define ("COLUMN_BOOKING_CANCEL","cancelReason");


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
            $statement=$this->con->query($sql);
            if($statement->rowCount()==1){
                return true;
            } else {
                return false;
            }
        } catch(PDOException $e){
            $this->error="Error en la conexion: ".$e->getMessage();
        }
    }

    /** --------------------------------------------------------------------------------------------------------------------------       USER
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
            $this->error="Error en la conexion: ".$e->getMessage();
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
            $this->error="Error en la conexion: ".$e->getMessage();
        }
    }

    /**
     * Comprueba si existe un username en la base de datos
     */
    function existsUserUsername($username){
        try {
            $sql="SELECT ".COLUMN_USER_USERNAME." FROM ".TABLE_USER." WHERE ".COLUMN_USER_USERNAME."='".$username."'";
            $statement = $this->con->prepare($sql);
            $statement->execute();
            $result = $statement->fetchAll(PDO::FETCH_ASSOC);
            if (count($result) == 1) {
                return true;
            }
            return false;
        } catch(PDOException $e){
            $this->error="Error en la conexion: ".$e->getMessage();
        }
    }

    /**
     * Comprueba si existe un email en la base de datos
     */
    function existsUserEmail($email){
        try {
            $sql="SELECT ".COLUMN_USER_EMAIL." FROM ".TABLE_USER." WHERE ".COLUMN_USER_EMAIL."='".$email."'";
            $statement = $this->con->prepare($sql);
            $statement->execute();
            $result = $statement->fetchAll(PDO::FETCH_ASSOC);
            if (count($result) == 1) {
                return true;
            }
            return false;
        } catch(PDOException $e){
            $this->error="Error en la conexion: ".$e->getMessage();
        }
    }

    function insertUser($username,$password,$name,$date,$email){
        try {
            //INSERT INTO `user` (`_id`, `username`, `password`, `name`, `birthdate`, `email`) VALUES (NULL, 'migue', '123', '123', '2018-01-31', '123')
            $sql="INSERT INTO ".TABLE_USER." (_id, ".COLUMN_USER_USERNAME.", ".COLUMN_USER_PASSWORD.", ".COLUMN_USER_NAME.", ".COLUMN_USER_DATE.", ".COLUMN_USER_EMAIL.") VALUES (NULL, '".$username."', '".SHA1($password)."', '".$name."', '".$date."', '".$email."');";
            $statement = $this->con->prepare($sql);
            $statement->execute();
            return true;
        } catch(PDOException $e){
            $this->error="Error en la conexion: ".$e->getMessage();
            return false;
        }
    }

    /** --------------------------------------------------------------------------------------------------------------------------       CLASS
     * Devuelve el nombre corto de un aula buscado por su id
     * 
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
            $this->error="Error en la conexion: ".$e->getMessage();
        }
    }
 
    /**
     * Select todas las aulas
     */
    function getClass(){
        try {
            $sql="SELECT _id,".COLUMN_CLASS_NAME.", ".COLUMN_CLASS_SHORTNAME.", ".COLUMN_CLASS_LOCATION.", ".COLUMN_CLASS_TIC.", ".COLUMN_CLASS_NUMPC." FROM ".TABLE_CLASS;
            $statement = $this->con->prepare($sql);
            return $statement;
        } catch(PDOException $e){
            $this->error="Error en la conexion: ".$e->getMessage();
        }
    }

    /**
     * Select todas las aulas
     */
    function getClassBy($name,$shortname){
        try {
            if ($name != null && $shortname != null ) {
                $sql="SELECT _id,".COLUMN_CLASS_NAME.", ".COLUMN_CLASS_SHORTNAME.", ".COLUMN_CLASS_LOCATION.", ".COLUMN_CLASS_TIC.", ".COLUMN_CLASS_NUMPC." FROM ".TABLE_CLASS." WHERE ".COLUMN_CLASS_NAME." LIKE '%".$name."%' AND ".COLUMN_CLASS_SHORTNAME." LIKE '%".$shortname."%'";
            } elseif ($name != null) {
                $sql="SELECT _id,".COLUMN_CLASS_NAME.", ".COLUMN_CLASS_SHORTNAME.", ".COLUMN_CLASS_LOCATION.", ".COLUMN_CLASS_TIC.", ".COLUMN_CLASS_NUMPC." FROM ".TABLE_CLASS." WHERE ".COLUMN_CLASS_NAME." LIKE '%".$name."%'";
            } elseif ($shortname != null ) {
                $sql="SELECT _id,".COLUMN_CLASS_NAME.", ".COLUMN_CLASS_SHORTNAME.", ".COLUMN_CLASS_LOCATION.", ".COLUMN_CLASS_TIC.", ".COLUMN_CLASS_NUMPC." FROM ".TABLE_CLASS." WHERE ".COLUMN_CLASS_SHORTNAME." LIKE '%".$shortname."%'";
            } else {
                $sql="SELECT _id,".COLUMN_CLASS_NAME.", ".COLUMN_CLASS_SHORTNAME.", ".COLUMN_CLASS_LOCATION.", ".COLUMN_CLASS_TIC.", ".COLUMN_CLASS_NUMPC." FROM ".TABLE_CLASS;
            }
            $statement = $this->con->prepare($sql);
            return $statement;
        } catch(PDOException $e){
            $this->error="Error en la conexion: ".$e->getMessage();
        }
    }

    /**
     * Select todas las aulas
     */
    function getClassById($idAula){
        try {
            $sql="SELECT ".COLUMN_CLASS_NAME.", ".COLUMN_CLASS_SHORTNAME.", ".COLUMN_CLASS_LOCATION.", ".COLUMN_CLASS_TIC.", ".COLUMN_CLASS_NUMPC." FROM ".TABLE_CLASS." WHERE _id=".$idAula;
            $statement = $this->con->prepare($sql);
            return $statement;
        } catch(PDOException $e){
            $this->error="Error en la conexion: ".$e->getMessage();
        }
    }

    /** --------------------------------------------------------------------------------------------------------------------------       TIMETABLE
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
            $this->error="Error en la conexion: ".$e->getMessage();
        }
    }

    /** --------------------------------------------------------------------------------------------------------------------------       BOOKING 
     * Devuelve todas las reservas de un usuario concreto buscando por el id del usuario en cuestion
     */
    function getBooking($idUser){
        try {
            $sql="SELECT * FROM ".TABLE_BOOKING." WHERE ".COLUMN_BOOKING_USER."=".$idUser." ORDER BY ".COLUMN_BOOKING_DATE;
            $statement = $this->con->prepare($sql);
            return $statement;
        } catch(PDOException $e){
            $this->error="Error en la conexion: ".$e->getMessage();
        }
    }

    function getBookingByClassDate($idClass,$date){
        try {
            $sql="SELECT * FROM ".TABLE_BOOKING." WHERE ".COLUMN_BOOKING_CLASS."='".$idClass."' AND ".COLUMN_BOOKING_DATE."='".$date."'";
            $statement = $this->con->prepare($sql);
            return $statement;
        } catch(PDOException $e){
            $this->error="Error en la conexion: ".$e->getMessage();
        }
    }

    /**
     * elimina una reserva en concreto 
     */
    function deleteBookingdeleteBooking($idUser,$idClass,$idTimeTable,$date){
        try {
            $sql="DELETE FROM ".TABLE_BOOKING.
            " WHERE ".COLUMN_BOOKING_USER."='".$idUser."' and ".
            COLUMN_BOOKING_CLASS."='".$idClass."' and ".
            COLUMN_BOOKING_TIMETABLE."='".$idTimeTable."' and ".
            COLUMN_BOOKING_DATE."='".$date."'";
            $statement = $this->con->prepare($sql);
            $statement->execute();
        } catch(PDOException $e){
            $this->error="Error en la conexion: ".$e->getMessage();
        }
    }

    /**
     * Inserta un motivo de cancelacion en una reserva
     * UPDATE `booking` SET `cancelReason` = 'caca' WHERE `booking`.`_idUser` = 1 AND `booking`.`_idClass` = 1 AND `booking`.`_idTimeTable` = 1 AND `booking`.`date` = '2018-01-31';
     */
    function insertCancelReason($idUser,$idClass,$idTimeTable,$date,$cancelReason){
        try {
            $sql="UPDATE ".TABLE_BOOKING.
            " SET ".COLUMN_BOOKING_CANCEL." = '".$cancelReason.
            "' WHERE ".COLUMN_BOOKING_USER."='".$idUser."' and ".
            COLUMN_BOOKING_CLASS."='".$idClass."' and ".
            COLUMN_BOOKING_TIMETABLE."='".$idTimeTable."' and ".
            COLUMN_BOOKING_DATE."='".$date."'";
            $statement = $this->con->prepare($sql);
            $statement->execute();
        } catch(PDOException $e){
            $this->error="Error en la conexion: ".$e->getMessage();
        }
    }

    /**
     * INSERT INTO `booking` (`_idUser`, `_idClass`, `_idTimeTable`, `date`, `bookReason`, `cancelReason`) VALUES ('1', '1', '7', '2018-01-28', '123', NULL);
     */
    function insertBookReason($idUser,$idClass,$idTimeTable,$date,$bookReason){
        try {
            $sql="INSERT INTO ".TABLE_BOOKING.
            " ( ".COLUMN_BOOKING_USER.", ".
            COLUMN_BOOKING_CLASS.", ".
            COLUMN_BOOKING_TIMETABLE.", ".
            COLUMN_BOOKING_DATE.", ".
            COLUMN_BOOKING_BOOK." ) ".
            "VALUES ('".$idUser."', '".$idClass."', '".$idTimeTable."', '".$date."', '".$bookReason."') ";
            $statement = $this->con->prepare($sql);
            $statement->execute();
        } catch(PDOException $e){
            $this->error="Error en la conexion: ".$e->getMessage();
        }
    }

    /**
     * 
     */
    /*
    SELECT timetable._id, timetable.hour,
     booking._idUser, booking._idClass, booking._idTimetable, booking.date, booking.bookReason, booking.cancelReason 
     FROM timetable LEFT JOIN booking 
     on timetable._id=booking._idTimeTable
     AND booking._idClass='1' 
     AND booking.date='2018-01-31' 
     ORDER BY timetable._id ASC
    */
    function getBookingJoinTimetableByIdClasDate($idClass,$date){
        try {
            $sql = "SELECT timetable._id, timetable.hour, ".
            "booking._idUser, booking._idClass, booking._idTimetable, booking.date, booking.bookReason, booking.cancelReason ".
            "FROM timetable LEFT JOIN booking ".
            "ON timetable._id=booking._idTimeTable ".
            "AND booking._idClass='".$idClass."' ".
            "AND booking.date='".$date."' ".
            "ORDER BY timetable._id ASC";
            $statement = $this->con->prepare($sql);
            return $statement;
        } catch(PDOException $e){
            $this->error="Error en la conexion: ".$e->getMessage();
        }
    }

}

?>