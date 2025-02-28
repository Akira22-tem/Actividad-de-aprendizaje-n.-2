<?php
 class Persona{
    public $nombre;
    public $edad;
    public $pais;

    //constructor
    public function __construct($nombre,$edad){
        $this->nombre=$nombre;
        $this->edad=$edad;
    }

    public function saludar(){
        return 'Hola mi nombre es '.$this->nombre . ' y tengo '.$this->edad.' años';
    }

    ///destructor
    public function __destruct(){
        echo "Destruyendo el objeto {$this->nombre}";
    }

 }

    $persona1 = new Persona('Juan',20);
    echo $persona1->nombre;
    echo '<br>';
    echo $persona1->edad;
    echo '<br>';
    echo '<br>';

    $persona2= new Persona('Karla',30);
    echo $persona2->saludar();
    echo '<br>';
    echo '<br>';
?>