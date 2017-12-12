<?php

class Triangulo {

    private $catetoMenor;
    private $catetoMayor;

    public function getCatetoMenor(){
        return $this->catetoMenor;
    }
    public function setCatetoMenor(){
        return $this->catetoMenor;
    }

    public function getCatetoMayor(){
        return $this->catetoMayor;
    }
    public function setCatetoMayor(){
        return $this->catetoMayor;
    }

    public function __construct($catetoMenor,$catetoMayor){
        $this->catetoMenor = $catetoMenor;
        $this->catetoMayor = $catetoMayor;
    }

    public function __destruct(){
        echo "Triangulo destruido";
    }
    
}

?>