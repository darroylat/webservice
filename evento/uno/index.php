<?php
/**
 * Created by PhpStorm.
 * User: darro
 * Date: 07-06-2017
 * Time: 23:45
 */
require_once('../../nusoap/lib/nusoap.php');
//require_once('soporte_obrea.php');
$miURL = 'urn:mi_ws1';
$server = new soap_server();
$server->configureWSDL('ws_mountain', $miURL);
$server->wsdl->schemaTargetNamespace=$miURL;

$server->wsdl->addComplexType('cliente',
    'complexType',
    'struct',
    'all',
    '',
    array(
        'id' => array('name' => 'id', 'type' => 'xsd:int'),
        'nombre' => array('name' => 'nombre',	'type' => 'xsd:string'),
        'apellido' => array('name' => 'apellido', 'type' => 'xsd:string'),
        'cuit' => array('name' => 'CUIT',	'type' => 'xsd:string')
    )
);

$server->register('listarClientes', // Nombre de la funcion
    array(), // Parametros de entrada
    array('return' => 'tns:cliente'), // Parametros de salida
    $miURL
);
function listarClientes() {

    return null;
}

if ( !isset( $HTTP_RAW_POST_DATA ) ) $HTTP_RAW_POST_DATA =file_get_contents( 'php://input' );
$server->service($HTTP_RAW_POST_DATA);