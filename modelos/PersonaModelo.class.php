<?php 
    require 'Modelo.class.php';

    class PersonaModelo extends Modelo{
        public $id;
        public $nombre;
        public $apellido;
        public $edad;
        public $email;

        public function guardar(){
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
                throw new Exception("Hubo un problema al cargar la persona");
            }
        }

        public function eliminar(){
            $sql = "DELETE FROM persona WHERE id = '{$this -> id}'";
            $this -> conexion -> query($sql);
        }



        public function obtenerTodos(){
            $sql = "SELECT id,nombre,apellido,edad,email FROM persona";
            $filas = array();
            foreach($this -> conexion -> query($sql) -> fetch_all(MYSQLI_ASSOC) as $fila){
                $p = new PersonaModelo();
                $p -> id = $fila['id'];
                $p -> nombre = $fila['nombre'];
                $p -> apellido = $fila['apellido'];
                $p -> edad = $fila['edad'];
                $p -> email = $fila['email'];
                array_push($filas,$p);
            }
            return $filas;
        }

        public function obtenerUno($id){
            $sql = "SELECT id,nombre,apellido,edad,email FROM persona WHERE id = $id";
            $resultado =  $this -> conexion -> query($sql) -> fetch_assoc();
            $this -> id = $resultado['id'];
            $this -> nombre = $resultado['nombre'];
            $this -> apellido = $resultado['apellido'];
            $this -> edad = $resultado['edad'];
            $this -> email = $resultado['email'];

        }
    }