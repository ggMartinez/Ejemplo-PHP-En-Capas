<?php  
    require '../utils/autoloader.php';
    $request = $_SERVER['REQUEST_URI'];


    function esContenidoEstatico($url){
        $extensiones = [
            ".css",
            ".png",
            ".jpg",
            ".jpeg",
            ".pdf",
            ".js"
        ];
        foreach($extensiones as $extension){
            if(strpos($url,$extension) !== false)
                return true;
        }
        return false;
    }

    function cargarContenidoEstatico($archivo){
        $extensiones = [
            ".css" => "text/css",
            ".png" => "image/png",
            ".jpg" => "image/jpg",
            ".jpeg" => "image/jpeg",
            ".pdf" => "document/pdf",
            ".js" => "text/js"
        ];
        foreach($extensiones as $extension => $contenido){
            if(strpos($archivo,$extension) !== false)
                $contentType = $contenido;
        }
        $contenidoDelArchivo = [
            "contenido" => file_get_contents("../vistas/estatico" . $archivo),
            "contentType" => $contentType
        ];
        return $contenidoDelArchivo;
    }

    if(esContenidoEstatico($request)){
        $contenido = cargarContenidoEstatico($request);
        header("Content-Type: " . $contenido['contentType']);
        echo $contenido['contenido'];
    }
    else {
    
        switch($request){
            case '/':
                PersonaController::ObtenerPersonas();
                break;
            case '':
                PersonaController::ObtenerPersonas();
                break;
            case '/insertar':
                if($_SERVER['REQUEST_METHOD'] === 'POST') PersonaController::AltaDePersona($_POST['nombre'],$_POST['apellido'],$_POST['edad'],$_POST['email']);
                if($_SERVER['REQUEST_METHOD'] === 'GET') cargarVista('formularioInsert');  
                break;
            case '/login':
                
                if($_SERVER['REQUEST_METHOD'] === 'GET') UsuarioController::MostrarLogin();  
                if($_SERVER['REQUEST_METHOD'] === 'POST') UsuarioController::IniciarSesion($_POST['nombre'],$_POST['password']);
                
                break;
            case '/principal':
                UsuarioController::MostrarMenuPrincipal();
                break;
            default: 
                cargarVista('404');
        }
    }