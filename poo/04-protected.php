<?php
class Persona {
    protected $nombre = 'Juan';
    protected $edad = 20;

    protected function verDatos() {
        return $this->nombre . ' - ' . $this->edad;
    }
}

class Empleado extends Persona {
    
    private $sueldo = 100;

    public function verDatos() {
        return parent::verDatos() . ' - ' . $this->sueldo;
    }
}

$empleado1 = new Empleado();
echo $empleado1->verDatos();

echo '<br>';
echo '<h1>Instancia de Persona</h1>';
$persona1 = new Persona();
echo $persona1->verDatos();

?>