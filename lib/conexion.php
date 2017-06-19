<?php

function ejecutar_sql($conex, $sql){

    $resultado = mysqli_query($conex, $sql);

    if (! $resultado ) {die("ERROR AL EJECUTAR LA CONSULTA: ".mysqli_connect_error()." ".mysqli_error($conex));}

    return $resultado;
}

function connectDB_Admin(){

    $server = "localhost";
    $user = "root";
    $pass = "";
    $bd = "MOUNTAIN_ADMIN";

    $conexion = mysqli_connect($server, $user, $pass, $bd)
    or die("Ha sucedido un error inexperado en la conexion de la base de datos");

    return $conexion;
}
function connectDB_Cliente($bd){

    $server = "localhost";
    $user = "root";
    $pass = "";

    $conexion = mysqli_connect($server, $user, $pass, $bd)
    or die("Ha sucedido un error inexperado en la conexion de la base de datos");

    return $conexion;
}
function disconnectDB($conexion){

    $close = mysqli_close($conexion)
    or die("Ha sucedido un error inexperado en la desconexion de la base de datos");

    return $close;
}
