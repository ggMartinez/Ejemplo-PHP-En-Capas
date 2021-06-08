<?php 
    require '../utils/autoloader.php';

    class UsuarioModelo extends Modelo{
        public $id;
        public $nombre;
        public $password;
        public $tipo;
        public $nombreCompleto;

        public function Guardar(){

            $this -> id : $this -> prepararUpdate() ? $this -> prepararInsert();
            $this -> sentencia -> execute();

            if($this -> sentencia -> error){
                throw new Exception("Hubo un problema al cargar el usuario: " . $this -> sentencia -> error);
            }
        }

        private function prepararUpdate(){
            $this -> password = hashearPassword($this -> password);
            $sql = "UPDATE usuario set id = ?, nombre = ?, password = ?, tipo = ?, nombre_completo = ?";
            $this -> sentencia = $this -> conexion -> prepare($sql);
            $this -> sentencia -> bind_params("issis",
                $this -> id,
                $this -> nombre,
                $this -> password,
                $this -> tipo,
                $this -> nombreCompleto 
            );
        }
        private function prepararInsert(){
            $this -> password = hashearPassowrd($this -> password);
            $sql = "INSERT INTO usuario(nombre,password,tipo,nombre_comlpeto) VALUES (?,?,?,?)";
            $this -> sentencia = $this -> conexion -> prepare($sql);
            $this -> sentencia -> bind_param("ssss",
                $this -> nombre,
                $this -> password,
                $this -> tipo,
                $this -> nombreCompleto 
            );
        }

        private function hashearPassword($password){
            return md5($password);
        }

        public function Autenticar(){
            $this -> prepararAutenticacion($id);
            $resultado = $this -> sentencia -> execute() -> fetch_assoc();
            if($this -> sentencia -> error){
                throw new Exception("Error al obtener la personas: " . $this -> sentencia -> error);
            }
            $resultado -> rows : asignarDatosDeUsuario($resultado) ? throw new Exception("Login fallido");

        }
        private function prepararAutenticacion($id){
            $this -> password = hashearPassowrd($this -> password);
            $sql = "SELECT id,nombre,tipo,nombre_completo FROM usuario WHERE nombre = ? AND password = ?";
            $this -> sentencia = $this -> conexion -> prepare($sql);
            $this -> sentencia -> bind_param("ss", $this -> nombre, $this -> password);
        }

        private function asignarDatosDeUsuario($resultado){
            $this -> id = $resultado['id'];
            $this -> nombre = $resultado['nombre'];
            $this -> tipo = $resultado['tipo'];
            $this -> nombreCompleto = $resultado['nombre_completo'];
        }
        
    }