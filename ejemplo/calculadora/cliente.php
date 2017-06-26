<?php
require_once("../../nusoap/lib/nusoap.php");

$cliente = new nusoap_client('http://localhost/webservice/ejemplo/calculadora/?wsdl','wsdl');
$parametros = array('num1' => 2,'num2' => 3);
$result = $cliente->call('Suma', $parametros);

echo $result;