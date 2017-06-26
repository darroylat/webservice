<?php
require_once("../../nusoap/lib/nusoap.php");

$server = new soap_server();
$server->configureWSDL('Calculadora', 'urn:Calculadora');

$server->register('Suma', // Nombre del método a registrar
        array('num1' => 'xsd:int','num2' => 'xsd:int'), // Parámetros de entrada
        array('return' => 'xsd:int'), // Parámetro de salida
        'urn:Sumawsdl', // namespace
        'urn:Sumawsdl#Suma', // soapaction
        'rpc', // style (llamada de procedimiento remoto)
        'encoded', // use
        'Suma de numeros con entrada num1: Numero 1 y num2: Numero 2' // Documentacion del método
);

function Suma($num1,$num2) {
        return $num1+$num2;
}

$HTTP_RAW_POST_DATA = isset($HTTP_RAW_POST_DATA) ? $HTTP_RAW_POST_DATA : '';
$server->service($HTTP_RAW_POST_DATA);