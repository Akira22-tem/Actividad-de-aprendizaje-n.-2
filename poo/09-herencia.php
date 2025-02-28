<?php
class Vehiculo{
    protected $marca;
    protected $modelo;

    public function __construct($marca, $modelo){
        $this->marca = $marca;
        $this->modelo = $modelo;
    }   

    public function mostrarInformacion(){
        echo 'Marca: '.$this->marca.'<br>';
        echo 'Modelo: '.$this->modelo.'<br>';
    }
}

class Sedan extends Vehiculo{
    private $precio;

    public function __construct($marca, $modelo, $precio){
        parent::__construct($marca, $modelo);
        $this->precio = $precio;
    }

    public function mostrarInformacion(){
        parent::mostrarInformacion();
        echo 'Precio: '.$this->precio.'<br>';
    }
}

$auto1= new Sedan('Kia', 'Rio', 20000);
$auto1->mostrarInformacion();

echo '<br>';
$auto2= new Vehiculo('Toyota', 'Corolla');
$auto2->mostrarInformacion();

?>