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
     * <link href="/sgemp/bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
     * <script src="http://code.jquery.com/jquery.js"></script>
     * <script src="/sgemp/bootstrap/js/bootstrap.min.js"></script>
     * <script src="/sgemp/bootstrap/js/bootstrap.js"></script>
     * 
     * boostrap 3 
     * <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
     * <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
     * <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
     */
    static function show_head($titulo){
        print '
        <!DOCTYPE html>
        <html lang=\"es\">
            <head>
                <title>'.$titulo.'</title>
                <meta charset=\"utf8\"/>
                <meta http-equiv="X-UA-Compatible" content="IE=edge">
                <meta name="viewport" content="width=device-width, initial-scale=1">
                <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css">
                <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
                <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.6/umd/popper.min.js"></script>
                <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js"></script>
            </head>
            <body>';
    }
    static function show_logout(){
        echo "
        <div style='float:right; margin:10px;'>
            <a href='logout.php'>Log out</a>
        </div>";
    }

    /**
     * https://v4-alpha.getbootstrap.com/components/navs/
     */
    static function show_navbar(){
        echo '
        <nav class="navbar navbar-expand-md navbar-dark bg-dark" style="background-color: #212529 !important;">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target=".dual-collapse">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="navbar-collapse collapse dual-collapse">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="login.php">Inicio</a>
                </li>   
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                    Dependency
                    </a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="inventory.php">Listar</a>
                        <a class="dropdown-item" href="addDependency.php">Añadir</a>
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                    Sector
                    </a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="sector.php">Listar</a>
                        <a class="dropdown-item" href="#">Añadir</a>
                    </div>
                </li>
            </ul>
        </div>
        
        <div class="navbar-collapse collapse dual-collapse">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="logout.php">Log Out</a>
                </li>
            </ul>
        </div>
    </nav>';
    }

    static function show_footer(){
        print "
            </body>
        </html>";
    }
}

?>