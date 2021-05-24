<?php 
    require '../utils/autoloader.php';


    $resultado = PersonaController::AltaDePersona($_POST['nombre'],$_POST['apellido'],$_POST['edad'],$_POST['email']);
    if($resultado){
        echo "Se realizo el alta";
    }
    else {
        echo "Hubo un error";
    }