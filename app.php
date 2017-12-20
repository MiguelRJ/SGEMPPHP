<?php

/**
 * App frameworks
 * http://www.yiiframework.com/doc/api/1.1/CApplication/
 * https://laravel.com/docs/5.5/controllers
 */

include_once "dao.php";

class App {

    protected $dao;

    function __construct(){
        $this->dao = new Dao();
    }

    function getDao(){
        return $this->dao;
    }

    /**
     * Funcion que guarda el nombre del usuario en la variable $_SESSION
     * importante cuando el usuario se ha logeado (login.php)
     */
    function init_session($user){
        if(!isset($_SESSION['user'])){
            $_SESSION['user'] = $user;
        }
    }

    /**
     * Funcion que comprueba si un usuario esta logeado en el sistema
     */
    function validate_session(){
        session_start();
        if(!$this->isLogged()){
            $this->showLogin();
        }
    }

    /**
     * Funcion que comprueba si el usuario ha inicializado sesion
     */
    function isLogged(){
        return isset($_SESSION['user']);
    }

    /**
     * Funcion que redirige a login
     */
    function showLogin(){
        header('Location: login.php');
    }

    function invalidate_session(){
        if(isset($_SESSION['user'])){
            unset($_SESSION['user']);
            session_destroy();
            $this->showLogin();
        }
    }

    /**
     * FUNCIONES DE FORMATO DE PAGINA 
     */
    static function show_head($titulo){
        print "
        <!DOCTYPE html>
        <html lang=\"es\">
            <head>
                <title>".$titulo."</title>
                <meta charset=\"utf8\"/>
                <meta http-equiv='X-UA-Compatible' content='IE=edge'>
                <meta name='viewport' content='width=device-width, initial-scale=1'>
                <link href='/sgemp/bootstrap/css/bootstrap.min.css' rel='stylesheet' media='screen'>
            </head>
            <body>
            <script src='http://code.jquery.com/jquery.js'></script>
            <script src='/sgemp/bootstrap/js/bootstrap.min.js'></script>";
    }
    static function show_footer(){
        print "
            </body>
        </html>";
    }
}

?>