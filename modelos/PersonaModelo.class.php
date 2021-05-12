<?php 
    require 'Modelo.class.php';

    class PersonaModelo extends Modelo{
        public $nombre;
        public $apellido;
        public $edad;
        public $email;

        public function guardar(){
            $sql = "INSERT INTO persona(nombre,apellido,edad,email) VALUES (
                '{$this -> nombre}',
                '{$this -> apellido}',
                {$this -> edad},
                '{$this -> email}
                ')";
            $this -> conexion -> query($sql);
            if($this -> conexion -> error){
                throw new Exception("Hubo un problema al cargar la persona");
            }
        }
    }