<?php

include_once "dao.php";

class App {

    protected $dao;

    function __construct(){
        $this->dao = new Dao();
    }

    function getDao(){
        return $this->dao;
    }

    function init_session($user){
        if (!isset($_SESSION['user'])){
            $_SESSION['user'] = $user;
        }
    }

    function validate_session(){
        session_start();
        if (!$this->isLogged()){
            $this->showLogin();
        }
    }

    function isLogged(){
        return isset($_SESSION['user']);
    }

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

    static function show_head($titulo){
        print '
        <!DOCTYPE html>
        <html lang="es">
            <head>
                <title>'.$titulo.'</title>
                <meta charset="UTF-8"/>
                <meta http-equiv="Content-type" content="text/html; charset=UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1">
                <link rel="icon" href="img/icon.png">
                <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css">
                <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
                <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.6/umd/popper.min.js"></script>
                <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js"></script>
                <style>
                    .footer {
                        position: fixed;
                        left: 0;
                        bottom: 0;
                        width: 100%;
                        background-color: #212529;
                        color: white;
                        text-align: center;
                        vertical-align:middle;
                    }
                    .table {
                        margin-bottom:50px;
                    }
                    .navbar {
                        position: fixed;
                        width:100%;
                        top: 0;
                        z-index:10;
                    }
                </style>
            </head>
            <body style="marging-bottom:50px;margin-top:70px;z-index:1;background:#FAFAD2; ">';
    }

    static function show_footer(){
        print '
        <div class="footer">
            <em>Página realizada por Miguel Rodriguez Jimenez ®</em>
        </div>
            </body>
        </html>';
    }

    /**
     * Buscar, Reservas, Consultar, Alta, Gestion
     * inicio.php sera la pantalla donde te saldran tus reservas hechas y pasadas (gestion)
     * en buscar aula saldran un boton consultar para ver cuando esta reservada
     * en consultar saldra un boton para reservarla
     * cuando se reserva un boton para dar de alta la reserva
     */
    static function show_navbar(){
        echo '<nav class="navbar navbar-expand-md navbar-dark bg-dark" style="background-color: #212529 !important;">

            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target=".dual-collapse">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="navbar-collapse collapse dual-collapse">

                <ul class="navbar-nav mr-auto">

                    <li class="nav-item">
                        <h3 style="color:white;">IES Portada</h3>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="inicio.php">Gestion reservas</a>
                    </li>   

                    <li class="nav-item dropdown">

                        <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">Aulas</a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="buscarAula.php">Buscar</a>
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

}
?>