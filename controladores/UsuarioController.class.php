<?php 

    require '../utils/autoloader.php';

    class PersonaController{
        public static function IniciarSesion($usuario,$password){
            try{
                $u = new UsuarioModelo();
                $u -> nombre = $usuario;
                $u -> password = $password;
                $u -> Autenticar();
                crearSesion($u);
                cargarVista("menuPrincipal");
            }
            catch (Exception $e) {
                generarHtml("login",["falla" => true]);
            }

        }

        public static function AltaDeUsuario($usuario,$password,$tipo,$nombreCompleto){

            if($usuario !== "" && $password !== "" && $tipo !== "" && $nombreCompleto !== ""){
                try{
                    $u = new UsuarioModelo();
                    $u -> nombre = $nombre;
                    $u -> password = $password; 
                    $u -> tipo = $tipo;
                    $u -> nombreCompleto = $nombreCompleto;
                    $u -> Guardar();
                    return generarHtml('formularioInsertUsuario',['exito' => true]);
                }
                catch(Exception $e){
                    error_log($e -> getMessage());
                    return generarHtml('formularioInsertUsuario',['exito' =>false]);
                }
            }
            return generarHtml('formularioInsertUsuario',['exito' => false]);
        }

        private static function crearSesion($usuario){
            session_start();
            $_SESSION['usuarioId'] = $usuario -> id;
            $_SESSION['usuarioNombre'] = $usuario -> nombre;
            $_SESSION['usuarioTipo'] = $usuario -> tipo;
            $_SESSION['usuarioNombreCompleto'] = $usuario -> nombreCompleto;
        }
    }