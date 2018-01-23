<?php

define ("DATABASE","inventory");
define ("MYSQL_HOST","mysql:host=localhost;dbname=".DATABASE);
define ("MYSQL_USER","www-data");
define ("MYSQL_PASSWORD","www-data");

define ("TABLE_USER","user");
define ("TABLE_PRODUCTS","products");
define ("TABLE_DEPENDENCY","dependency");
define ("TABLE_SECTOR","sector");
define ("COLUMN_USER_NAME","name");
define ("COLUMN_USER_PASSWORD","password");

/**
 * http://php.net/manual/es/class.pdostatement.php
 * http://php.net/manual/es/pdostatement.fetchall.php
 * cuando hacemos query  tenemos objeto statement
 * que devuelve this con->query($sql);
 * objeto que tiene internamente un cursor 
 * que se abre y se cierra
 */

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

    /**
     * Destructor de la clase
     */
    function __destruct(){
        if ($this->isConected()){
            $this->con=null;
            unset($this->error);
        }
    }

    /**
     * Metodo que indica si existe una conexion a la base de datos
     */
    function isConected(){
        return $this->con==null?false:true;
    }

    /**
     * Funcion que comprueba si el usuario existe en la base de datos
     */
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

    /**
     * Funcion que devuelve los productos de la base de datos
     */
    function getProducts(){
        try {
            $sql = "SELECT id,name,price,description FROM ".TABLE_PRODUCTS;
            //echo $sql;
            $statement=$this->con->query($sql);
            if($statement->rowCount()>0){
                return $statement;
            } else {
                return null;
            }
        } catch(PDOException $e){
            
        }
    }

    /**
     * Funcion que devuelve las dependencys de la base de datos
     */
    function getDependency(){
        try {
            $sql="SELECT id,shortname,name,description FROM ".TABLE_DEPENDENCY;
            //echo $sql;
            $statement=$this->con->query($sql);
            if($statement->rowCount()>0){
                return $statement;
            } else {
                return null;
            }
        } catch(PDOException $e){
            
        }
    }

    /**
     * Funcion que devuelve los sectores de una dependencia mediante una sentencia prepare
     * http://php.net/manual/es/pdo.prepare.php
     */
    function getSectorsByIdDependency($idDependency){
        try {
            $sql="SELECT id,shortname,name,description,idDependency
             FROM ".TABLE_SECTOR.
             " WHERE idDependency = :idDependency";
            /*
            $sql="SELECT id,shortname,name,description,idDependency
             FROM ".TABLE_DEPENDENCY.
             " WHERE idDependency = ?";
            */
            $statement = $this->con->prepare($sql);
            $statement->bindParam(':idDependency',$idDependency);
            //return $statement->execute(array(':idDependency'=>$idDependency)); // cuando es ':'
            // return $statement->execute(array('$idDependency')); // Cuando es '?'
            return $statement;
        } catch(PDOException $e){
            
        }
    }

    /**
     * Funcion que devuelve los sectores de una dependencia mediante una sentencia prepare
     * http://php.net/manual/es/pdo.prepare.php
     */
    function getSectors(){
        try {
            $sql="SELECT id,shortname,name,description,idDependency
             FROM ".TABLE_SECTOR;
            /*
            $sql="SELECT id,shortname,name,description,idDependency
             FROM ".TABLE_DEPENDENCY;
            */
            $statement = $this->con->prepare($sql);
            return $statement;
        } catch(PDOException $e){
            
        }
    }

    /**
     * Funcion que añade dependencys
     */
    function addDependency($name,$shortname,$description){
        try {
            $sql="INSERT INTO ".TABLE_DEPENDENCY." (`ID`, `shortname`, `name`, `description`) VALUES (NULL,'".$shortname."','".$name."','".$description."')";
            $statement = $this->con->prepare($sql);
            $statement->execute();
        } catch(PDOException $e){
            
        }
    }

}

?>