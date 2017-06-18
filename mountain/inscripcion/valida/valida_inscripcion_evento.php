<?php

require_once('../../nusoap/lib/nusoap.php');
//require_once('../../lib/soporte_obrea.php');
include('../../lib/conexion.php');
include('../../lib/consultas.php');
$miURL = 'urn:mi_ws1';
$server = new soap_server();
$server->configureWSDL('ws_mountain', $miURL);
$server->wsdl->schemaTargetNamespace = $miURL;

$server->wsdl->addComplexType('entradaValidaInscripcion',
    'complexType',
    'struct',
    'all',
    '',
    array(
        'usuario' => array('name' => 'usuario', 'type' => 'xsd:string'),
        'clave' => array('name' => 'clave', 'type' => 'xsd:string'),
        'idusuario' => array('name' => 'idusuario', 'type' => 'xsd:string'),
        'idevento' => array('name' => 'idevento', 'type' => 'xsd:string')
    )
);

$server->wsdl->addComplexType('salidaValidaInscripcion',
    'complexType',
    'struct',
    'all',
    '',
    array(
        'codigo' => array('name' => 'codigo', 'type' => 'xsd:string'),
        'descripcion' => array('name' => 'descripcion', 'type' => 'xsd:string')
    )
);

$server->register('validaInscripcion', // Nombre de la funcion
    array('inscripcion' => 'tns:entradaValidaInscripcion'), // Parametros de entrada
    array('return' => 'tns:salidaValidaInscripcion'), // Parametros de salida
    $miURL
);

function validaInscripcion($inscripcion){

    $conexionAdmin = connectDB_Admin();
    $query = getCliente($inscripcion['usuario'], $inscripcion['clave']);
    $resultado = ejecutar_sql($conexionAdmin, $query);
    $cliente = $resultado->fetch_array();

    $conexionCliente = connectDB_Cliente($cliente['DATOSCLIENTE']);

    $queryInscripcion = getInscripcionEvento($inscripcion);
    $resultadoInscripcion = ejecutar_sql($conexionCliente, $queryInscripcion);

    $filas = mysqli_num_rows($resultadoInscripcion);
    $respuesta[] = null;

    if($filas == 0){
        $respuesta = array('codigo' => '0001', 'descripcion' => 'No se encontro incripcion al evento.');
    }else{
        $respuesta = array('codigo' => '0000', 'descripcion' => 'Inscripcion al evento correcta.');
    }

    return $respuesta;
}

if (!isset($HTTP_RAW_POST_DATA)) $HTTP_RAW_POST_DATA = file_get_contents('php://input');
$server->service($HTTP_RAW_POST_DATA);