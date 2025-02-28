<?php
class Producto {
    private $nombre='Producto 1';
    private $precio=100;
    private $codigo='1234';

    public function mostrarInformarion() {
        echo 'Nombre: '.$this->nombre.'<br>';
        echo 'Precio: '.$this->precio.'<br>';
        echo 'Codigo: '.$this->codigo.'<br>';
    }   


}

$producto = new Producto();
$producto->mostrarInformarion();


?>