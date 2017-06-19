<?php

require_once('../../nusoap/lib/nusoap.php');
require_once('../../lib/soporte_obrea.php');
include('../../lib/conexion.php');
include('../../lib/consultas.php');
$miURL = 'urn:mi_ws1';
$server = new soap_server();
$server->configureWSDL('ws_mountain', $miURL);
$server->wsdl->schemaTargetNamespace=$miURL;

/*
 *  Ejemplo 3: listarClientes es la funcion mas compleja que voy realizar, no recibe parametros
 *  y retorna un listado de clientes. Utiliza varios metodos del ejemplo 2.
 */
class Evento {
    var $idevento;
    var $nombre;
    var $nombresendero;
    var $nombreubicacion;
    var $descripcion;
    var $fecha;
    var $hora;
    var $valor;
    var $punto;
    var $foto;
    var $estado;
}
class EventoDAO {
    /**
     * getCliente($id) : Cliente
     * Esta funcion deberia implementarse con una conexion a una base de datos
     * y obtener la informacion de la base directamente
     */
    function getEvento($evento) {
        $idevento = $evento['IDEVENTO'];
        $nombre = $evento['NOMBRE'];
        $nombresendero = $evento['NOMBRESENDERO'];
        $nombreubicacion = $evento['NOMBREUBICACION'];
        $descripcion = $evento['DESCRIPCION'];
        $fecha = $evento['FECHA'];
        $hora = $evento['HORA'];
        $valor = $evento['VALOR'];
        $punto = $evento['PUNTO'];
        $foto = $evento['FOTO'];
        $estado = $evento['ESTADO'];

        $obj = new Evento();
        //echo $evento['NOMBRESENDERO'];
        $obj->idevento = $idevento;
        $obj->nombre = $nombre;
        $obj->nombresendero = $nombresendero;
        $obj->nombreubicacion = $nombreubicacion;
        $obj->descripcion = $descripcion;
        $obj->fecha = $fecha;
        $obj->hora = $hora;
        $obj->valor = $valor;
        $obj->punto = $punto;
        $obj->foto = $foto;
        $obj->estado = $estado;

        return $obj;
    }

    /**
     * getList : Array
     * Esta funcion retorna un listado de todos los clientes que estan en el sistema.
     * @return
     */
    function getList($db) {
        $rta = array();
        $conexionCliente = connectDB_Cliente($db);
        $queryEventos = getTodosEvento(); //agregar cantidad en la query
        $listadoEvento = ejecutar_sql($conexionCliente, $queryEventos);

        $numero = 0;

        while ($evento = $listadoEvento->fetch_assoc()) {
            $rta[$numero] = $this->getEvento($evento);
            /*$obj = new Evento();
            echo $evento['NOMBRE'];
            $obj->idevento = $evento['IDEVENTO'];
            $obj->nombre = $evento['NOMBRE'];
            $obj->nombresendero = $evento['NOMBRESENDERO'];
            $obj->nombreubicacion = $evento['NOMBREUBICACION'];
            $obj->descripcion = $evento['DESCRIPCION'];
            $obj->fecha = $evento['FECHA'];
            $obj->hora = $evento['HORA'];
            $obj->valor = $evento['VALOR'];
            $obj->punto = $evento['PUNTO'];
            $obj->foto = $evento['FOTO'];
            $obj->estado = $evento['ESTADO'];

            $rta[$numero] = obj;*/
            //echo $numero;
            $numero++;

        }

        //$rta[0] = $this->getCliente(1);
        //$rta[1] = $this->getCliente(2);
        return $rta;
    }
}

$server->wsdl->addComplexType('entradaEvento',
    'complexType',
    'struct',
    'all',
    '',
    array(
        'usuario' => array('name' => 'usuario', 'type' => 'xsd:string'),
        'clave' => array('name' => 'clave',	'type' => 'xsd:string'),
        'cantidad' => array('name' => 'cantidad', 'type' => 'xsd:string')
    )
);

$server->wsdl->addComplexType('Evento',
    'complexType',
    'struct',
    'all',
    '',
    array(
        'idevento' => array('name' => 'idevento', 'type' => 'xsd:string'),
        'nombre' => array('name' => 'nombre',	'type' => 'xsd:string'),
        'nombresendero' => array('name' => 'nombresendero', 'type' => 'xsd:string'),
        'nombreubicacion' => array('name' => 'nombreubicacion', 'type' => 'xsd:string'),
        'descripcion' => array('name' => 'descripcion', 'type' => 'xsd:string'),
        'fecha' => array('name' => 'fecha', 'type' => 'xsd:string'),
        'hora' => array('name' => 'hora', 'type' => 'xsd:string'),
        'valor' => array('name' => 'valor', 'type' => 'xsd:string'),
        'punto' => array('name' => 'punto', 'type' => 'xsd:string'),
        'foto' => array('name' => 'foto', 'type' => 'xsd:string'),
        'estado' => array('name' => 'estado', 'type' => 'xsd:string')
    )
);

$server->wsdl->addComplexType('listadoEvento',
    'complexType',
    'array',
    '',
    '',
    array (array('ref'=>'SOAP-ENC:arrayType','wsdl:arrayType'=>'tns:Evento[]'))
);
$server->register('listarClientes', // Nombre de la funcion
    array('evento' => 'tns:entradaEvento'), // Parametros de entrada
    array('return' => 'tns:listadoEvento'), // Parametros de salida
    $miURL
);

function listarClientes($evento) {
    $dao = new EventoDAO();

    $conexionAdmin = connectDB_Admin();
    $query = getCliente($evento['usuario'], $evento['clave']);
    $resultado = ejecutar_sql($conexionAdmin, $query);
    $cliente = $resultado->fetch_array();

    $listado = $dao->getList($cliente['DATOSCLIENTE']);
    $objSoporte = new SoporteWS();
    $respuesta = $objSoporte->convertirAVectorParaWS($listado);
    return new soapval('return', 'tns:listadoEvento', $respuesta);
}


//$server->service($HTTP_RAW_POST_DATA);
if ( !isset( $HTTP_RAW_POST_DATA ) ) $HTTP_RAW_POST_DATA =file_get_contents( 'php://input' );
$server->service($HTTP_RAW_POST_DATA);