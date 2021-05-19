<?php 
    require '../controladores/PersonaController.class.php';


    foreach(PersonaController::ObtenerPersonas() as $fila){
        
        echo $fila['id'] . " " . $fila['nombre'] . " " . $fila['apellido'] . " " . $fila['edad'] . " " . $fila['email'] . "<br>";
    }
