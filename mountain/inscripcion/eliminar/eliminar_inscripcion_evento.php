<?php

require_once('../../../nusoap/lib/nusoap.php');
include('../../../lib/conexion.php');
include('../../../lib/consultas.php');
$miURL = 'urn:Inscripcion';
$server = new soap_server();
$server->configureWSDL('Inscripcion', $miURL);
$server->wsdl->schemaTargetNamespace = $miURL;

$entrada = array(
    'usuario' => 'xsd:string',
    'clave' => 'xsd:string',
    'idusuario' => 'xsd:string',
    'idevento' => 'xsd:string');
$salida = array('return' => 'xsd:string');

$server->register('eliminarInscripcion', // Nombre de la funcion
    $entrada, // Parametros de entrada
    $salida, // Parametros de salida
    $miURL, // namespace
    $miURL.'#eliminarInscripcion', // soapaction
    'rpc', // style (llamada de procedimiento remoto)
    'encoded', // use
    'Elimina inscripcion del evento' // Documentacion del método
);


function eliminarInscripcion($usuario, $clave, $idusuario, $idevento){

    $conexionAdmin = connectDB_Admin();
    $query = getCliente($usuario, $clave);
    $resultado = ejecutar_sql($conexionAdmin, $query);
    $cliente = $resultado->fetch_array();

    $conexionCliente = connectDB_Cliente($cliente['DATOSCLIENTE']);

    $queryInscripcion = getInscripcionEvento($idevento,$idusuario);
    $resultadoInscripcion = ejecutar_sql($conexionCliente, $queryInscripcion);

    $filas = mysqli_num_rows($resultadoInscripcion);
    $respuesta[] = null;

    if($filas == 0){
        $respuesta ='0002|No se encontro incripcion al evento.|}~';
    }else{
        $ins = $resultadoInscripcion->fetch_array();
        $queryUpdate = updateInscripcionEvento($ins['IDINSCRIPCION'], 0);
        ejecutar_sql($conexionCliente, $queryUpdate);
        if($conexionCliente->affected_rows > 0){
            $respuesta = '0000|Inscripcion al evento eliminada.|}~';
        }else{
            $respuesta = '0001|No se pudo eliminar la inscripcion al evento.|}~';
        }
    }
    return $respuesta;
}

if (!isset($HTTP_RAW_POST_DATA)) $HTTP_RAW_POST_DATA = file_get_contents('php://input');
$server->service($HTTP_RAW_POST_DATA);