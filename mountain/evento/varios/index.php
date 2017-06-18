<?php

require_once('../../nusoap/lib/nusoap.php');
require_once('../../lib/soporte_obrea.php');
$miURL = 'urn:mi_ws1';
$server = new soap_server();
$server->configureWSDL('ws_mountain', $miURL);
$server->wsdl->schemaTargetNamespace=$miURL;

$server->wsdl->addComplexType('entradaEvento',
    'complexType',
    'struct',
    'all',
    '',
    array(
        'usuario' => array('name' => 'usuario',	'type' => 'xsd:string'),
        'clave' => array('name' => 'clave', 'type' => 'xsd:string'),
        'codigo' => array('name' => 'codigo',	'type' => 'xsd:string')
    )
);

$server->wsdl->addComplexType('salidaEvento',
    'complexType',
    'struct',
    'all',
    '',
    array(
        'nombre' => array('name' => 'usuario',	'type' => 'xsd:string'),
        'descripcion' => array('name' => 'clave', 'type' => 'xsd:string'),
        'fecha' => array('name' => 'cantidad',	'type' => 'xsd:string'),
        'hora' => array('name' => 'cantidad',	'type' => 'xsd:string'),
        'valor' => array('name' => 'cantidad',	'type' => 'xsd:string'),
        'punto' => array('name' => 'cantidad',	'type' => 'xsd:string'),
        'foto' => array('name' => 'cantidad',	'type' => 'xsd:string')
    )
);

$server->register('verEvento', // Nombre de la funcion
    array('evento' => 'tns:entradaEvento'), // Parametros de entrada
    array('return' => 'tns:salidaEvento'), // Parametros de salida
    $miURL
);

function verEvento($entradaEvento){

}
