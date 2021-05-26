<?php  
    require '../utils/autoloader.php';
    $request = $_SERVER['REQUEST_URI'];
    
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
        default: 
            cargarVista('404');
    }