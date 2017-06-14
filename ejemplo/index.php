<?php
/**
 * Created by PhpStorm.
 * User: darro
 * Date: 13-06-2017
 * Time: 22:13
 */

include('../lib/conexion.php');



/*
* Creación de la consulta SQL
*/
$query = "SELECT * FROM CLIENTE";

/*
* Guardamos el resultado que devuelve MySQL
*/
$resultado = $db_admin->query($query);
/*
* Iteramos sobre el resultado y mostramos los datos
*/
while ($producto = $resultado->fetch_assoc()) {
    echo $producto['IDCLIENTE'];
    //echo $producto["campo1"];
    //echo $producto["campo2"];
    //echo $producto["campo3"];
}
/*
* Liberamos los recursos reservados
*/
$resultado->free();

$db_admin->close();