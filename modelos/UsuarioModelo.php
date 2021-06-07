<?php 
    require '../utils/autoloader.php';

    class PersonaModelo extends Modelo{
        public $id;
        public $nombre;
        public $password;
        public $tipo;
        public $nombreCompleto;

        public function Guardar(){
            if ($this -> id){
                $sql = "UPDATE persona set 
                id = {$this -> id},
                nombre = '{$this -> nombre}',
                apellido = '{$this -> apellido}',
                edad = {$this -> edad},
                email = '{$this -> email}'
                WHERE id = {$this -> id}
                ";
            }
            else{
                $sql = "INSERT INTO persona(nombre,apellido,edad,email) VALUES (
                    '{$this -> nombre}',
                    '{$this -> apellido}',
                    {$this -> edad},
                    '{$this -> email}'
                    )";
            }
            $this -> conexion -> query($sql);
            if($this -> conexion -> error){
                throw new Exception("Hubo un problema al cargar la persona: " . $this -> conexion -> error);
            }
        }
    }