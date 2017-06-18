<?php

require_once('../../nusoap/lib/nusoap.php');
//require_once('../../lib/soporte_obrea.php');
include('../../lib/conexion.php');
include('../../lib/consultas.php');
$miURL = 'urn:mi_ws1';
$server = new soap_server();
$server->configureWSDL('ws_mountain', $miURL);
$server->wsdl->schemaTargetNamespace = $miURL;

$server->wsdl->addComplexType('entradaEvento',
    'complexType',
    'struct',
    'all',
    '',
    array(
        'usuario' => array('name' => 'usuario', 'type' => 'xsd:string'),
        'clave' => array('name' => 'clave', 'type' => 'xsd:string'),
        'codigo' => array('name' => 'codigo', 'type' => 'xsd:string')
    )
);

$server->wsdl->addComplexType('salidaEvento',
    'complexType',
    'struct',
    'all',
    '',
    array(
        'nombre' => array('name' => 'nombre', 'type' => 'xsd:string'),
        'nombresendero' => array('name' => 'nombresendero', 'type' => 'xsd:string'),
        'descripcion' => array('name' => 'descripcion', 'type' => 'xsd:string'),
        'fecha' => array('name' => 'fecha', 'type' => 'xsd:string'),
        'hora' => array('name' => 'hora', 'type' => 'xsd:string'),
        'valor' => array('name' => 'valor', 'type' => 'xsd:string'),
        'punto' => array('name' => 'punto', 'type' => 'xsd:string'),
        'foto' => array('name' => 'foto', 'type' => 'xsd:string')
    )
);

$server->register('verEvento', // Nombre de la funcion
    array('evento' => 'tns:entradaEvento'), // Parametros de entrada
    array('return' => 'tns:salidaEvento'), // Parametros de salida
    $miURL
);

function verEvento($evento){

    $conexionAdmin = connectDB_Admin();
    $query = getCliente($evento['usuario'], $evento['clave']);
    $resultado = ejecutar_sql($conexionAdmin, $query);
    $cliente = $resultado->fetch_array();

    $conexionCliente = connectDB_Cliente($cliente['DATOSCLIENTE']);
    $queryEvento = getEventoIndividual($evento['codigo']);
    $resultadoEvento = ejecutar_sql($conexionCliente, $queryEvento);

    $eventoArray = $resultadoEvento->fetch_array();

    $respuesta = array('nombre' => $eventoArray['NOMBRE'],
                        'nombresendero' => $eventoArray['NOMBRESENDERO'],
                        'descripcion' => $eventoArray['DESCRIPCION'],
                        'fecha' => $eventoArray['FECHA'],
                        'hora' => $eventoArray['HORA'],
                        'valor' => $eventoArray['VALOR'],
                        'punto' => $eventoArray['PUNTO'],
                        'foto' => $eventoArray['FOTO']
                );

    return $respuesta;
}

if (!isset($HTTP_RAW_POST_DATA)) $HTTP_RAW_POST_DATA = file_get_contents('php://input');
$server->service($HTTP_RAW_POST_DATA);