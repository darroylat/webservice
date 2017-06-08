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



/*
 *  Ejemplo 3: listarClientes es la funcion mas compleja que voy realizar, no recibe parametros
 *  y retorna un listado de clientes. Utiliza varios metodos del ejemplo 2.
 */
class Cliente {
    var $id;
    var $nombre;
    var $apellido;
    var $cuit;
}
class ClienteDAO {
    /**
     * getCliente($id) : Cliente
     * Esta funcion deberia implementarse con una conexion a una base de datos
     * y obtener la informacion de la base directamente
     */
    function getCliente($id) {
        $obj = new Cliente();
        if ($id==1) {
            $obj->id = 1;
            $obj->nombre = 'Blas';
            $obj->apellido = 'Pascal';
            $obj->cuit = '11-11111111-1';
        }
        if ($id==2) {
            $obj->id = 2;
            $obj->nombre = 'Isaac';
            $obj->apellido = 'Newton';
            $obj->cuit = '22-22222222-2';
        }
        return $obj;
    }

    /**
     * getList : Array
     * Esta funcion retorna un listado de todos los clientes que estan en el sistema.
     * @return
     */
    function getList() {
        $rta = array();
        $rta[0] = $this->getCliente(1);
        $rta[1] = $this->getCliente(2);
        return $rta;
    }
}

$server->wsdl->addComplexType('Cliente',
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

$server->wsdl->addComplexType('listadoClientes',
    'complexType',
    'array',
    '',
    '',
    array (array('ref'=>'SOAP-ENC:arrayType','wsdl:arrayType'=>'tns:Cliente[]'))
);
$server->register('listarClientes', // Nombre de la funcion
    array(), // Parametros de entrada
    array('return' => 'tns:listadoClientes'), // Parametros de salida
    $miURL
);
function listarClientes() {
    $dao = new ClienteDAO();
    $listado = $dao->getList();
    $objSoporte = new SoporteWS();
    $respuesta = $objSoporte->convertirAVectorParaWS($listado);
    return new soapval('return', 'tns:listadoClientes', $respuesta);
}


//$server->service($HTTP_RAW_POST_DATA);
if ( !isset( $HTTP_RAW_POST_DATA ) ) $HTTP_RAW_POST_DATA =file_get_contents( 'php://input' );
$server->service($HTTP_RAW_POST_DATA);