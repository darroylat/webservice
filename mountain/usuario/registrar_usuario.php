<?php

require_once('../../nusoap/lib/nusoap.php');
//require_once('../../lib/soporte_obrea.php');
include('../../lib/conexion.php');
include('../../lib/consultas.php');
$miURL = 'urn:mi_ws1';
$server = new soap_server();
$server->configureWSDL('ws_mountain', $miURL);
$server->wsdl->schemaTargetNamespace = $miURL;

$server->wsdl->addComplexType('entradaUsuario',
    'complexType',
    'struct',
    'all',
    '',
    array(
        'usuario' => array('name' => 'usuario', 'type' => 'xsd:string'),
        'clave' => array('name' => 'clave', 'type' => 'xsd:string'),
        'rut' => array('name' => 'rut', 'type' => 'xsd:string'),
        'pass' => array('name' => 'pass', 'type' => 'xsd:string'),
        'nombre' => array('name' => 'nombre', 'type' => 'xsd:string'),
        'apellido' => array('name' => 'apellido', 'type' => 'xsd:string'),
        'email' => array('name' => 'email', 'type' => 'xsd:string'),
        'fecha' => array('name' => 'fecha', 'type' => 'xsd:string'),
        'sexo' => array('name' => 'sexo', 'type' => 'xsd:string'),
        'telefono' => array('name' => 'telefono', 'type' => 'xsd:string'),
        'instagram' => array('name' => 'instagram', 'type' => 'xsd:string'),
        'auto' => array('name' => 'auto', 'type' => 'xsd:string'),
        'autocom' => array('name' => 'autocom', 'type' => 'xsd:string'),
        'primer' => array('name' => 'primer', 'type' => 'xsd:string')
    )
);

$server->wsdl->addComplexType('salidaUsuario',
    'complexType',
    'struct',
    'all',
    '',
    array(
        'codigo' => array('name' => 'codigo', 'type' => 'xsd:string'),
        'descripcion' => array('name' => 'descripcion', 'type' => 'xsd:string')
    )
);

$server->register('registraUsuario', // Nombre de la funcion
    array('usuario' => 'tns:entradaUsuario'), // Parametros de entrada
    array('return' => 'tns:salidaUsuario'), // Parametros de salida
    $miURL
);

function registraUsuario($usuario){

    $conexionAdmin = connectDB_Admin();
    $query = getCliente($usuario['usuario'], $usuario['clave']);
    $resultado = ejecutar_sql($conexionAdmin, $query);
    $cliente = $resultado->fetch_array();

    $conexionCliente = connectDB_Cliente($cliente['DATOSCLIENTE']);

    $queryGetUsuario = getUsuario($usuario['user'], $usuario['pass']);
    $resultadoGetUsuario = ejecutar_sql($conexionCliente, $queryGetUsuario);

    $filasGetUsuario = mysqli_num_rows($resultadoGetUsuario);

    $respuesta[] = null;

    if($filasGetUsuario > 0){
        $respuesta = array('codigo' => '0002', 'descripcion' => 'Usuario existe.');
    }else{
        $queryRegistrarUsuario = putUsuario($usuario);
        ejecutar_sql($conexionCliente, $queryRegistrarUsuario);

        if($conexionCliente->affected_rows > 0){
            $respuesta = array('codigo' => '0000', 'descripcion' => 'Usuario registrado correctamente.');
        }else{
            $respuesta = array('codigo' => '0001', 'descripcion' => 'Error al registrar usuario.');
        }
    }
    return $respuesta;
}

if (!isset($HTTP_RAW_POST_DATA)) $HTTP_RAW_POST_DATA = file_get_contents('php://input');
$server->service($HTTP_RAW_POST_DATA);