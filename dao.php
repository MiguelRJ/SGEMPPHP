<?php

define ("DATABASE","inventory");
define ("MYSQL_HOST","mysql:host=localhost;dbname=".DATABASE);
define ("MYSQL_USER","www-data");
define ("MYSQL_PASSWORD","www-data");

define ("TABLE_USER","user");
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

}

?>