<?php
class Producto {
    private $nombre;
    private $precio;
    private $codigo;

    ///constructor
    public function __construct($nombre, $precio, $codigo) {
        $this->nombre = $nombre;
        $this->precio = $precio;
        $this->codigo = $codigo;
    }

    //setters y getters

    public function setNombre($nombre) {
        if(!empty($nombre)){
            $this->nombre = $nombre;
        }else{
            echo 'El nombre no puede estar vacio';
        }
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function setPrecio($precio) {
        if($precio > 0){
            $this->precio = $precio;
        }else{
            echo 'El precio no puede ser menor a 0';
        }
    }

    public function getPrecio() {
        return $this->precio;
    }

    public function setCodigo($codigo) {
        $this->codigo = $codigo;
    }

    public function getCodigo() {
        return $this->codigo;
    }

    public function mostrarInformarion() {
        echo 'Nombre: '.$this->nombre.'<br>';
        echo 'Precio: '.$this->precio.'<br>';
        echo 'Codigo: '.$this->codigo.'<br>';
    }   
}

$producto = new Producto('Laptop', 1000, 'ACB123');
$producto->mostrarInformarion();
echo '<br>';
echo $producto->getNombre();
echo '<br>';
echo $producto->getPrecio();
echo '<br>';
$producto->setNombre('Tablet');
$producto->setPrecio(500);
$producto->mostrarInformarion();
echo '<br>';
$producto2 = new Producto('Smartphone', 500, 'XYZ123');
$producto2->mostrarInformarion();
echo '<br>';
$producto2->setPrecio(-100);
echo '<br>';
echo $producto2->getPrecio();
?>