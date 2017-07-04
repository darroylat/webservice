<?php

require_once('../../nusoap/lib/nusoap.php');
require_once('../../lib/soporte_obrea.php');
include('../../lib/conexion.php');
include('../../lib/consultas.php');
$miURL = 'urn:Evento';
$server = new soap_server();
$server->configureWSDL('Evento', $miURL);
$server->wsdl->schemaTargetNamespace=$miURL;

/*
 *  Ejemplo 3: listarClientes es la funcion mas compleja que voy realizar, no recibe parametros
 *  y retorna un listado de clientes. Utiliza varios metodos del ejemplo 2.
 */

class EventoDAO {
    /**
     * getCliente($id) : Cliente
     * Esta funcion deberia implementarse con una conexion a una base de datos
     * y obtener la informacion de la base directamente
     */
    function getEvento($evento) {
        $obj = $evento['IDEVENTO'].'|'.$evento['NOMBRE'].'|'.$evento['NOMBRESENDERO'].'|'.$evento['NOMBREUBICACION'].'|'.$evento['DESCRIPCION'].'|';
        $obj .= $evento['FECHA'].'|'.$evento['HORA'].'|'.$evento['VALOR'].'|'.$evento['PUNTO'].'|'.$evento['FOTO'].'|'.$evento['ESTADO'].'#';
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

        $fila = mysqli_num_rows($listadoEvento);

        if($fila == 0){
            $salida = '0001#';
        }else{
            $salida = '0000#';
        }

        while ($evento = $listadoEvento->fetch_assoc()) {
           $salida .= $this->getEvento($evento);
        }
        $salida .= '}~';
        return $salida;
    }
}

$entrada = array('usuario' => 'xsd:string',
                'clave' => 'xsd:string',
                'cantidad' => 'xsd:string');

$salida = array('return' => 'xsd:string');

$server->register('listarEventos', // Nombre de la funcion
    $entrada, // Parametros de entrada
    $salida, // Parametros de salida
    $miURL, // namespace
    $miURL.'#listarEventos', // soapaction
    'rpc', // style (llamada de procedimiento remoto)
    'encoded', // use
    'Muestra los eventos del cliente' // Documentacion del método
);

function listarEventos($usuario, $clave, $cantidad) {
    $dao = new EventoDAO();

    $conexionAdmin = connectDB_Admin();
    $query = getCliente($usuario, $clave);
    $resultado = ejecutar_sql($conexionAdmin, $query);
    $cliente = $resultado->fetch_array();

    $listado = $dao->getList($cliente['DATOSCLIENTE']);

    return $listado;
}


//$server->service($HTTP_RAW_POST_DATA);
if ( !isset( $HTTP_RAW_POST_DATA ) ) $HTTP_RAW_POST_DATA =file_get_contents( 'php://input' );
$server->service($HTTP_RAW_POST_DATA);