
/**
 * Created by PhpStorm.
 * User: darro
 * Date: 13-06-2017
 * Time: 22:18
 */

<?php
/*
* Datos de conexión a MySQL
*/
$db_database = 'MOUNTAIN_ADMIN';
$db_hostname = 'localhost';
$db_username = 'root';
$db_password = '';

/*
* Creación del objeto mysqli
*/
$mysqli = new mysqli($db_hostname, $db_username, $db_password, $db_database);

/*
* Buscamos posibles errores en la conexión
*/
if (mysqli_connect_errno()) {
    printf("Falló la conexión: %s\n", mysqli_connect_error());
    exit();
}

/*
* Creación de la consulta SQL
*/
$query = "SELECT * FROM CLIENTE";

/*
* Guardamos el resultado que devuelve MySQL
*/
$resultado = $mysqli->query($query);
/*
* Iteramos sobre el resultado y mostramos los datos
*/
while ($producto = $resultado->fetch_assoc()) {
    echo $producto["campo1"];
    echo $producto["campo2"];
    echo $producto["campo3"];
}

/*
* Liberamos los recursos reservados
*/
$resultado->free();

$mysqli->close();


