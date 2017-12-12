<?php
    include_once "biblioteca.php";
    include_once "Persona.php";
    include_once "Estudiante.php";
    
    show_head("Mi primera clase en php");

    // Se crea el objeto persona
    $persona = new Persona("Miguel","Rodriguez","21");
    echo "<p>".$persona->saludar()."</p>";
    
    $estudiante = new Estudiante("Carlos","Garrido","18",3456, array("DEINT","SGEMP","EINE","PSPRO","PMDM"));
    $estudiante->setCodigo(23);
    echo "<p>".$estudiante->saludar()."</p>";

    $array_personas = array();
    $array_personas[0] = $persona;
    $array_personas[1] = $estudiante;

    for ($i = 0; $i<count($array_personas); $i++) {
        if($array_personas[$i] instanceof Estudiante){
            echo "<h1>Estudiante</h1>";
            echo "<p>Nombre: ".$array_personas[$i]->getNombre()."</p>";
            echo "<p>Apellido: ".$array_personas[$i]->getApellido()."</p>";
            echo "<p>Edad: ".$array_personas[$i]->getEdad()."</p>";
            echo "<p>Codigo: ".$array_personas[$i]->getCodigo()."</p>";
            echo "<p>Numero de modulos: ".Estudiante::$numModulos."</p>";
            echo "<p>Modulos matriculados: ".print_r($array_personas[$i]->getMatricula(),true)."</p>";
        } else {
            echo "<h1>Persona</h1>";
            echo "<p>Nombre: ".$array_personas[$i]->getNombre()."</p>";
            echo "<p>Apellido: ".$array_personas[$i]->getApellido()."</p>";
            echo "<p>Edad: ".$array_personas[$i]->getEdad()."</p>";
        }
    }

    // Se destruye el objeto persona
    unset($persona);
    
    show_footer();

?>