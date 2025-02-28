<?php
abstract class Figura {
    abstract public function calcularArea();
}

class  Circulo extends Figura {
    private $radio;

    public function __construct($radio) {
        $this->radio = $radio;
    }

    public function calcularArea() {
        return M_PI * pow($this->radio, 2);
    }
}

class Rectangulo extends Figura {
    private $base;
    private $altura;

    public function __construct($base, $altura) {
        $this->base = $base;
        $this->altura = $altura;
    }

    public function calcularArea() {
        return $this->base * $this->altura;
    }
}

$circulo = new Circulo(5);
echo "Área del círculo: " . $circulo->calcularArea() . "<br>";

$rectangulo = new Rectangulo(5, 10);
echo "Área del rectángulo: " . $rectangulo->calcularArea() . "<br>";

?>
