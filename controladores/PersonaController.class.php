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

    }
    
