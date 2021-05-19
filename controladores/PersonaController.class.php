<?php 

    require '../modelos/PersonaModelo.class.php';

    class PersonaController{

        public static function AltaDePersona($nombre,$apellido,$edad,$email){

            if($nombre !== "" && $apelllido !== "" && $edad !== "" && $email !== ""){
                try{
                    $p = new PersonaModelo();
                    $p -> nombre = $nombre;
                    $p -> apellido = $apellido; 
                    $p -> edad = $edad;
                    $p -> email = $email;
                    $p -> guardar();
                    return true;
                }
                catch(Exception $e){
                    return $e -> getMessage();
                }
            }
            return false;
        }

        public static function ObtenerPersonas(){
            $p = new PersonaModelo();
            $personas = array();
            foreach($p -> obtenerTodos() as $fila){
                $persona = array(
                    "id" => $fila -> id,
                    "nombre" => $fila -> nombre,
                    "apellido" => $fila -> apellido,
                    "edad" => $fila -> edad,
                    "email" => $fila -> email
                );
                array_push($personas,$persona);
            }
            return $personas;
        }
        
        public static function EliminarPersona($id){
            $p = new PersonaModelo();
            $p -> obtenerUno($id);
            $p -> eliminar();
        }

    }
    
