<?php
//Registra inscripcion pack

require_once('../../../nusoap/lib/nusoap.php');
//require_once('../../lib/soporte_obrea.php');
include('../../../lib/conexion.php');
include('../../../lib/consultas.php');
$miURL = 'urn:mi_ws1';
$server = new soap_server();
$server->configureWSDL('ws_mountain', $miURL);
$server->wsdl->schemaTargetNamespace = $miURL;

$server->wsdl->addComplexType('entradaInscripcion',
    'complexType',
    'struct',
    'all',
    '',
    array(
        'usuario' => array('name' => 'usuario', 'type' => 'xsd:string'),
        'clave' => array('name' => 'clave', 'type' => 'xsd:string'),
        'idusuario' => array('name' => 'idusuario', 'type' => 'xsd:string'),
        'idpack' => array('name' => 'idpack', 'type' => 'xsd:string')
    )
);

$server->wsdl->addComplexType('salidaInscripcion',
    'complexType',
    'struct',
    'all',
    '',
    array(
        'codigo' => array('name' => 'codigo', 'type' => 'xsd:string'),
        'descripcion' => array('name' => 'descripcion', 'type' => 'xsd:string')
    )
);

$server->register('creaInscripcion', // Nombre de la funcion
    array('inscripcion' => 'tns:entradaInscripcion'), // Parametros de entrada
    array('return' => 'tns:salidaInscripcion'), // Parametros de salida
    $miURL
);

function creaInscripcion($inscripcion){

    $conexionAdmin = connectDB_Admin();
    $query = getCliente($inscripcion['usuario'], $inscripcion['clave']);
    $resultado = ejecutar_sql($conexionAdmin, $query);
    $cliente = $resultado->fetch_array();

    $conexionCliente = connectDB_Cliente($cliente['DATOSCLIENTE']);
    $queryInscripcion = putInscripcionPack($inscripcion);

    $selectInscripcion = getInscripcionEvento($inscripcion);
    $resultadoInscripcion = ejecutar_sql($conexionCliente, $selectInscripcion);

    $filas = mysqli_num_rows($resultadoInscripcion);

    $respuesta[] = null;

    if($filas == 0){
        ejecutar_sql($conexionCliente, $queryInscripcion);

        if($conexionCliente->affected_rows > 0){
            $respuesta = array('codigo' => '0000', 'descripcion' => 'Inscripcion pack realizada correctamente.');
        }else{
            $respuesta = array('codigo' => '0001', 'descripcion' => 'Error en la inscripcion del pack.');
        }
    }else{
        $ins = $resultadoInscripcion->fetch_array();
        $queryUpdate = updateInscripcionPack($ins['IDINSCRIPCION'], 1);
        ejecutar_sql($conexionCliente, $queryUpdate);
        if($conexionCliente->affected_rows > 0){
            $respuesta = array('codigo' => '0000', 'descripcion' => 'Inscripcion pack realizada correctamente.');
        }else{
            $respuesta = array('codigo' => '0001', 'descripcion' => 'Error en la inscripcion del pack.');
        }
    }
    return $respuesta;
}

if (!isset($HTTP_RAW_POST_DATA)) $HTTP_RAW_POST_DATA = file_get_contents('php://input');
$server->service($HTTP_RAW_POST_DATA);