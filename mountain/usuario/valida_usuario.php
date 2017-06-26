<?php
require_once('../../nusoap/lib/nusoap.php');
//require_once('../../lib/soporte_obrea.php');
include('../../lib/conexion.php');
include('../../lib/consultas.php');
$miURL = 'urn:Usuario';
$server = new soap_server();
$server->configureWSDL('Usuario', $miURL);
$server->wsdl->schemaTargetNamespace = $miURL;

$entrada = array('usuario' => 'xsd:string',
                'clave' => 'xsd:string',
                'user' => 'xsd:string',
                'pass' => 'xsd:string');

$salida = array('return' => 'xsd:string');

$server->register('validaUsuario', // Nombre de la funcion
    $entrada , // Parametros de entrada
    $salida, // Parametros de salida
    $miURL, // namespace
    $miURL.'#validaUsuario', // soapaction
    'rpc', // style (llamada de procedimiento remoto)
    'encoded', // use
    'Valida que el usuario corresponda a uno registrado' // Documentacion del método
);

function validaUsuario($usuario, $clave, $user, $pass){

    $conexionAdmin = connectDB_Admin();
    $query = getCliente($usuario, $clave);
    $resultado = ejecutar_sql($conexionAdmin, $query);
    $cliente = $resultado->fetch_array();

    $conexionCliente = connectDB_Cliente($cliente['DATOSCLIENTE']);
    $queryUsuario = getUsuario($user, $pass);
    $resultadoUsuario = ejecutar_sql($conexionCliente, $queryUsuario);
    $rowUsuario = $resultadoUsuario->fetch_array();
    $respuesta[] = null;

    $filas = mysqli_num_rows($resultadoUsuario);
    if($filas == 0){
        $respuesta =  '0001|Usuario o contraseña no valido.';
    }else{
        $respuesta = '0000|Consulta exitosa.|'.$rowUsuario['NOMBRE'].'|'.$rowUsuario['APELLIDO'].'|'.$rowUsuario['IDUSUARIO'].'|}~';
    }
    return $respuesta;
}

if (!isset($HTTP_RAW_POST_DATA)) $HTTP_RAW_POST_DATA = file_get_contents('php://input');
$server->service($HTTP_RAW_POST_DATA);

