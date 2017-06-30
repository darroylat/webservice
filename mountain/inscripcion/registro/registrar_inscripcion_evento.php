<?php
//Registra inscripcion evento

require_once('../../../nusoap/lib/nusoap.php');
include('../../../lib/conexion.php');
include('../../../lib/consultas.php');
$miURL = 'urn:Inscripcion';
$server = new soap_server();
$server->configureWSDL('Inscripcion', $miURL);
$server->wsdl->schemaTargetNamespace = $miURL;

$entrada = array('usuario' => 'xsd:string',
                'clave' => 'xsd:string',
                'idusuario' => 'xsd:string',
                'idevento' => 'xsd:string');

$salida = array('return' => 'xsd:string');


$server->register('creaInscripcion', // Nombre de la funcion
    $entrada, // Parametros de entrada
    $salida, // Parametros de salida
    $miURL, // namespace
    $miURL.'#creaInscripcion', // soapaction
    'rpc', // style (llamada de procedimiento remoto)
    'encoded', // use
    'Registra usuario al evento requerido' // Documentacion del método
);

function creaInscripcion($usuario, $clave, $idusuario, $idevento){

    $conexionAdmin = connectDB_Admin();
    $query = getCliente($usuario, $clave);
    $resultado = ejecutar_sql($conexionAdmin, $query);
    $cliente = $resultado->fetch_array();

    $conexionCliente = connectDB_Cliente($cliente['DATOSCLIENTE']);
    $queryInscripcion = putInscripcionEvento($idevento,$idusuario);

    $selectInscripcion = getInscripcionEvento($idevento, $idusuario);
    $resultadoInscripcion = ejecutar_sql($conexionCliente, $selectInscripcion);

    $filas = mysqli_num_rows($resultadoInscripcion);

    $respuesta[] = null;
    if($filas == 0){
        ejecutar_sql($conexionCliente, $queryInscripcion);

        if($conexionCliente->affected_rows > 0){
            $respuesta = array('codigo' => '0000', 'descripcion' => 'Inscripcion evento realizada correctamente..');
        }else{
            $respuesta = array('codigo' => '0001', 'descripcion' => 'Error en la inscripcion del evento.');
        }
    }else{
        $ins = $resultadoInscripcion->fetch_array();
        $queryUpdate = updateInscripcionEvento($ins['IDINSCRIPCION'], 1);
        ejecutar_sql($conexionCliente, $queryUpdate);
        if($conexionCliente->affected_rows > 0){
            $respuesta = array('codigo' => '0000', 'descripcion' => 'Inscripcion evento realizada correctamente.');
        }else{
            $respuesta = array('codigo' => '0001', 'descripcion' => 'Error en la inscripcion del evento.');
        }
    }
    return $respuesta;
}

if (!isset($HTTP_RAW_POST_DATA)) $HTTP_RAW_POST_DATA = file_get_contents('php://input');
$server->service($HTTP_RAW_POST_DATA);