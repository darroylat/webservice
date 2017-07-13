<?php
session_start();

require_once 'class.servicios.php';

if (isset($_POST['usuario']) && isset($_POST['pass']) && isset($_POST['nombre'])
    && isset($_POST['apellido']) && isset($_POST['email']) && isset($_POST['telefono'])
    && isset($_POST['edad']) && isset($_POST['sexo'])){

    $usuario = $_POST['usuario'];
    $clave = $_POST['pass'];
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $email = $_POST['email'];
    $telefono = $_POST['telefono'];
    $edad = $_POST['edad'];
    $sexo = $_POST['sexo'];


    $servicio = new Servicios();

    $respuesta = $servicio->registrarUsuario($usuario, $clave, $nombre, $apellido, $email, $telefono, $edad, $sexo);
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