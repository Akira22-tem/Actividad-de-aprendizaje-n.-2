<?php

class Persona{

    public $nombre;
    public $edad;
    public $pais;

    public function saludar(){
        return 'Hola mi nombre es '.$this->nombre;
    }

    public function mostrarInformacion(){
        return $this->saludar().' y soy de '.$this->pais;
    }
}

//objetos
$persona1 = new Persona();
$persona1->nombre='Juan';
$persona1->edad=20;
$persona1->pais='Ecuador';

echo $persona1->saludar();
echo '<br>';
echo $persona1->mostrarInformacion();
echo '<br>';
$persona2 = new Persona();
$persona2->nombre='Karla';
$persona2->edad=30;
$persona2->pais='Colombia';
echo $persona2->mostrarInformacion();
echo '<br>';
?>