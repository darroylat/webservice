<?php

require_once('../../../nusoap/lib/nusoap.php');
include('../../../lib/conexion.php');
include('../../../lib/consultas.php');
$miURL = 'urn:Inscripcion';
$server = new soap_server();
$server->configureWSDL('Inscripcion', $miURL);
$server->wsdl->schemaTargetNamespace = $miURL;

$entrada = array(
    'usuario'=> 'xsd:string',
    'clave' => 'xsd:string',
    'idusuario' => 'xsd:string',
    'idevento' => 'xsd:string'
);
$salida = array('return' => 'xsd:string');

$server->register('validaInscripcion', // Nombre de la funcion
    $entrada, // Parametros de entrada
    $salida, // Parametros de salida
    $miURL, // namespace
    $miURL.'#validaInscripcion', // soapaction
    'rpc', // style (llamada de procedimiento remoto)
    'encoded', // use
    'Valida inscripcion al evento' // Documentacion del método
);

function validaInscripcion($usuario, $clave, $idusuario, $idevento){

    $conexionAdmin = connectDB_Admin();
    $query = getCliente($usuario, $clave);
    $resultado = ejecutar_sql($conexionAdmin, $query);
    $cliente = $resultado->fetch_array();

    $conexionCliente = connectDB_Cliente($cliente['DATOSCLIENTE']);

    $queryInscripcion = getInscripcionEvento($idevento, $idusuario);
    $resultadoInscripcion = ejecutar_sql($conexionCliente, $queryInscripcion);

    $filas = mysqli_num_rows($resultadoInscripcion);
    $respuesta[] = null;

    if($filas == 0){
        $respuesta = '0001|No se encontro incripcion al evento.|}~';
    }else{
        $ins = $resultadoInscripcion->fetch_array();
        if ($ins['ACTIVO'] == 1){
            $respuesta = '0000|Inscripcion al evento correcta.|}~';
        }else{
            $respuesta = '0002|Inscripcion al evento inactiva.|}~';
        }
    }

    return $respuesta;
}

if (!isset($HTTP_RAW_POST_DATA)) $HTTP_RAW_POST_DATA = file_get_contents('php://input');
$server->service($HTTP_RAW_POST_DATA);