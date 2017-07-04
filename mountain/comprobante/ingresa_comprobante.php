<?php

require_once('../../nusoap/lib/nusoap.php');
include('../../lib/conexion.php');
include('../../lib/consultas.php');
$miURL = 'urn:Comprobante';
$server = new soap_server();
$server->configureWSDL('Comprobante', $miURL);
$server->wsdl->schemaTargetNamespace = $miURL;


$entrada = array('usuario' => 'xsd:string',
    'clave' => 'xsd:string',
    'idevento' => 'xsd:string',
    'idusuario' => 'xsd:string',
    'comprobante' => 'xsd:string');

$salida = array('return' => 'xsd:string');

$server->register('ingresaComprobante', // Nombre de la funcion
    $entrada, // Parametros de entrada
    $salida, // Parametros de salida
    $miURL, // namespace
    $miURL.'#ingresaComprobante', // soapaction
    'rpc', // style (llamada de procedimiento remoto)
    'encoded', // use
    'Muestra el evento seleccionado por el usuario' // Documentacion del método
);

function ingresaComprobante($usuario, $clave, $idevento, $idusuario, $comprobante){

    /*$conexionAdmin = connectDB_Admin();
    $query = getCliente($usuario, $clave);
    $resultado = ejecutar_sql($conexionAdmin, $query);
    $cliente = $resultado->fetch_array();

    $conexionCliente = connectDB_Cliente($cliente['DATOSCLIENTE']);
    $queryEvento = getEventoIndividual($codigo);
    $resultadoEvento = ejecutar_sql($conexionCliente, $queryEvento);

    $eventoArray = $resultadoEvento->fetch_array();



    $respuesta = '0000|';
    $respuesta .= $eventoArray['NOMBRE'].'|'.$eventoArray['NOMBRESENDERO'].'|'.$eventoArray['DESCRIPCION'].'|';
    $respuesta .= $eventoArray['FECHA'].'|'.$eventoArray['HORA'].'|'.$eventoArray['VALOR'].'|';
    $respuesta .= $eventoArray['PUNTO'].'|'.$eventoArray['FOTO'].'|';

    $queryEquipos = getEquipoEvento($codigo);

    $resultadoEquipos = ejecutar_sql($conexionCliente,$queryEquipos);

    $equipos = '';

    while ($equipo = $resultadoEquipos->fetch_assoc()) {
        $equipos .= $equipo['IDEQUIPOTRECK'].'#'.$equipo['DESCRIPCION'].'!';
    }*/
    $respuesta .= $equipos.'|}~';

    return $respuesta;
}

if (!isset($HTTP_RAW_POST_DATA)) $HTTP_RAW_POST_DATA = file_get_contents('php://input');
$server->service($HTTP_RAW_POST_DATA);