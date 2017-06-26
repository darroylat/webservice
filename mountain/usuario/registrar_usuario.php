<?php

require_once('../../nusoap/lib/nusoap.php');
//require_once('../../lib/soporte_obrea.php');
include('../../lib/conexion.php');
include('../../lib/consultas.php');
$miURL = 'urn:Usuario';
$server = new soap_server();
$server->configureWSDL('Usuario', $miURL);
$server->wsdl->schemaTargetNamespace = $miURL;

$entrada = array(
    'usuario' => 'xsd:string',
    'clave' => 'xsd:string',
    'rut' => 'xsd:string',
    'pass' => 'xsd:string',
    'nombre' => 'xsd:string',
    'apellido' => 'xsd:string',
    'email' => 'xsd:string',
    'fecha' => 'xsd:string',
    'sexo' => 'xsd:string',
    'telefono' => 'xsd:string',
    'instagram' => 'xsd:string',
    'auto' => 'xsd:string',
    'autocom' => 'xsd:string',
    'primer' => 'xsd:string'
);
$salida = array('return' => 'xsd:string');

$server->register('registraUsuario', // Nombre de la funcion
    $entrada, // Parametros de entrada
    $salida, // Parametros de salida
    $miURL, // namespace
    $miURL.'#registraUsuario', // soapaction
    'rpc', // style (llamada de procedimiento remoto)
    'encoded', // use
    'Registra nuevo usuario para la cuenta del cliente' // Documentacion del método
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
        $respuesta = '0002|Usuario existe.|}~';
    }else{
        $queryRegistrarUsuario = putUsuario($usuario);
        ejecutar_sql($conexionCliente, $queryRegistrarUsuario);

        if($conexionCliente->affected_rows > 0){
            $respuesta = '0000|Usuario registrado correctamente.|}~';
        }else{
            $respuesta = '0001|Error al registrar usuario.|}~';
        }
    }
    return $respuesta;
}

if (!isset($HTTP_RAW_POST_DATA)) $HTTP_RAW_POST_DATA = file_get_contents('php://input');
$server->service($HTTP_RAW_POST_DATA);