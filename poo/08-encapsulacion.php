<?php
class Persona{
    private $nombre;
    private $edad;

    public function setNombre($nombre){
        if(!empty($nombre)){
            $this->nombre = $nombre;
        }else{
            echo 'El nombre no puede estar vacio';
        }
    }

    public function getNombre(){
        return $this->nombre;
    }

    public function setEdad($edad){
        if($edad > 0){
            $this->edad = $edad;
        }else{
            echo 'La edad no puede ser menor a 0';
        }
    }

    public function getEdad(){
        return $this->edad;
    }
}

$persona1=new Persona();
$persona1->setNombre('Juan');
$persona1->setEdad(30);
echo $persona1->getNombre().PHP_EOL;
echo $persona1->getEdad().PHP_EOL;
?>