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
        'user' => array('name' => 'user', 'type' => 'xsd:string'),
        'pass' => array('name' => 'pass', 'type' => 'xsd:string')
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

$server->register('validaUsuario', // Nombre de la funcion
    array('usuario' => 'tns:entradaUsuario'), // Parametros de entrada
    array('return' => 'tns:salidaUsuario'), // Parametros de salida
    $miURL
);

function validaUsuario($usuario){

    $conexionAdmin = connectDB_Admin();
    $query = getCliente($usuario['usuario'], $usuario['clave']);
    $resultado = ejecutar_sql($conexionAdmin, $query);
    $cliente = $resultado->fetch_array();

    $conexionCliente = connectDB_Cliente($cliente['DATOSCLIENTE']);
    $queryUsuario = getUsuario($usuario['user'], $usuario['pass']);
    $resultadoUsuario = ejecutar_sql($conexionCliente, $queryUsuario);

    $filas = mysqli_num_rows($resultadoUsuario);
    $respuesta[] = null;

    if($filas == 0){
        $respuesta = array('codigo' => '0001',
            'descripcion' => 'Usuario o contraseña no valido.'
        );
    }else{
        $respuesta = array('codigo' => '0000',
            'descripcion' => 'Consulta exitosa.'
        );
    }

    return $respuesta;
}

if (!isset($HTTP_RAW_POST_DATA)) $HTTP_RAW_POST_DATA = file_get_contents('php://input');
$server->service($HTTP_RAW_POST_DATA);