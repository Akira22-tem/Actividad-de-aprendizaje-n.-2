<?php
class Usuario{
    public $nombre="Geovanny";

    public function mostrarInformacion(){
        return 'Nombre: '.$this->nombre;
    }
}

$usuario = new Usuario();
echo $usuario->nombre;
echo '<br>';
echo $usuario->mostrarInformacion();
echo '<br>';

$usuario2 = new Usuario();
$usuario2->nombre='Karla';
echo $usuario2->nombre; 
echo '<br>';
echo $usuario2->mostrarInformacion();
?>