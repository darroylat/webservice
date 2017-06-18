<?php

include('../lib/conexion.php');

$conexionAdmin = connectDB_Admin();

$query = "SELECT * FROM CLIENTE";

$resultado = ejecutar_sql($conexionAdmin, $query);

/*while ($producto = $resultado->fetch_assoc()) {
    echo $producto['DATOSCLIENTE'];
    //echo $producto["campo1"];
    //echo $producto["campo2"];
    //echo $producto["campo3"];
}*/
$cliente = $resultado->fetch_array();
echo $cliente['DATOSCLIENTE'].'</br>';

$conexionCliente = connectDB_Cliente($cliente['DATOSCLIENTE']);

$queryCliente = "SELECT * FROM USUARIO";


$resultadoUsuario = ejecutar_sql($conexionCliente, $queryCliente);

while ($usuario = $resultadoUsuario->fetch_assoc()) {
    echo $usuario['NOMBRE'].' '.$usuario['APELLIDO'].'</br>';
}



$resultado->free();
$resultadoUsuario->free();

disconnectDB($conexionAdmin);
disconnectDB($conexionCliente);