<?php
session_start();

require_once 'class.servicios.php';

if (isset($_POST['usuario']) && isset($_POST['clave'])){

    $usuario = $_POST['usuario'];
    $clave = $_POST['clave'];

    $servicio = new Servicios();

    $respuesta = $servicio->valida_usuario($usuario, $clave);
    echo $respuesta;
    $split = split('\|', $respuesta);
    if($split[0] == '0000'){
        $_SESSION['usuario'] = $split[2];
        $_SESSION['id'] = $split[4];
        console_log(split[3]);
        echo $split[1];
        header("location: ../index.php");
    }
}else{
    echo 'nada';
}



//header("location: ../index.php");