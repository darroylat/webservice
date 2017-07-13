<?php
require_once(realpath($_SERVER["DOCUMENT_ROOT"]) .'/webservice/nusoap/lib/nusoap.php');

class Servicios{

var $usuario = 'cliente';
var $clave = '123456';

var $urlValidaUsuario = 'http://webservice.lerolero.cl/mountain/usuario/valida_usuario.php';
var $urlVerEventos = 'http://webservice.lerolero.cl/mountain/evento/obtener_evento_todos.php';
var $urlEvento = 'http://webservice.lerolero.cl/mountain/evento/obtener_evento_individual.php';
var $urlValidaInscripcionEvento = 'http://webservice.lerolero.cl/mountain/inscripcion/valida/valida_inscripcion_evento.php';
var $urlEliminarInscripcionEvento = 'http://webservice.lerolero.cl/mountain/inscripcion/eliminar/eliminar_inscripcion_evento.php';
var $urlIncripcionEvento = 'http://webservice.lerolero.cl/mountain/inscripcion/registro/registrar_inscripcion_evento.php';
var $urlIngresoComprobante = 'http://webservice.lerolero.cl/mountain/comprobante/ingresa_comprobante.php';
var $urlRegistroUsuario = 'http://webservice.lerolero.cl/mountain/usuario/registrar_usuario.php';

    function valida_usuario($user, $pass){
        $serverURL = $this->urlValidaUsuario;
        $metodoALlamar = 'validaUsuario';
        $cliente = new nusoap_client($serverURL.'?wsdl', 'wsdl');
        $cliente->soap_defencoding = 'UTF-8';

        $error = $cliente->getError();
        if ($error) {
            echo '<pre style="color:red">' . $error . '</pre>';
            echo '<p style="color:red;'>htmlspecialchars($cliente->getDebug(), ENT_QUOTES).'</p>';
            die();
        }
        // Datos de entrada
        $datos = array('usuario' => $this->usuario,
            'clave' => $this->clave,
            'user' => $user,
            'pass' => $pass);

        $result = $cliente->call(
            $metodoALlamar,  // Funcion a llamar
            $datos   // Parametros pasados a la funcion
        );

        // Verificacion que los parametros estan ok, y si lo estan. mostrar rta.
        if ($cliente->fault) {
            //echo '<b>Error: ';
            //print_r($result);
            //echo '</b>';
            return $result;
        } else {
            $error = $cliente->getError();
            if ($error) {
                //echo '<b style="color: red">Error: ' . $error . '</b>';
                return $error;
            } else {
                return $result;
                //echo 'Respuesta: ';
                //print_r($result);
            }
        }
    }

    function verEventos($cantidad){
        $serverURL = $this->urlVerEventos;
        $metodoALlamar = 'listarEventos';
        $cliente = new nusoap_client($serverURL.'?wsdl', 'wsdl');
        $cliente->soap_defencoding = 'UTF-8';

        $error = $cliente->getError();
        if ($error) {
            echo '<pre style="color:red">' . $error . '</pre>';
            echo '<p style="color:red;'>htmlspecialchars($cliente->getDebug(), ENT_QUOTES).'</p>';
            die();
        }
        // Datos de entrada
        $datos = array('usuario' => $this->usuario,
                        'clave' => $this->clave,
                        'cantidad' => $cantidad);
        $result = $cliente->call(
            $metodoALlamar,  // Funcion a llamar
            $datos   // Parametros pasados a la funcion
        );

        // Verificacion que los parametros estan ok, y si lo estan. mostrar rta.
        if ($cliente->fault) {
            return $result;
        } else {
            $error = $cliente->getError();
            if ($error) {
                return $error;
            } else {
                return $result;
            }
        }
    }
    function evento($id){
        $serverURL = $this->urlEvento;
        $metodoALlamar = 'verEvento';
        $cliente = new nusoap_client($serverURL.'?wsdl', 'wsdl');
        $cliente->soap_defencoding = 'UTF-8';

        $error = $cliente->getError();
        if ($error) {
            echo '<pre style="color:red">' . $error . '</pre>';
            echo '<p style="color:red;'>htmlspecialchars($cliente->getDebug(), ENT_QUOTES).'</p>';
            die();
        }
        // Datos de entrada
        $datos = array('usuario' => $this->usuario,
            'clave' => $this->clave,
            'codigo' => $id);
        $result = $cliente->call(
            $metodoALlamar,  // Funcion a llamar
            $datos   // Parametros pasados a la funcion
        );

        // Verificacion que los parametros estan ok, y si lo estan. mostrar rta.
        if ($cliente->fault) {
            return $result;
        } else {
            $error = $cliente->getError();
            if ($error) {
                return $error;
            } else {
                return $result;
            }
        }
    }
    function validaInscripcionEvento($idevento, $idusuario){
        $serverURL = $this->urlValidaInscripcionEvento;
        $metodoALlamar = 'validaInscripcion';
        $cliente = new nusoap_client($serverURL.'?wsdl', 'wsdl');
        $cliente->soap_defencoding = 'UTF-8';

        $error = $cliente->getError();
        if ($error) {
            echo '<pre style="color:red">' . $error . '</pre>';
            echo '<p style="color:red;'>htmlspecialchars($cliente->getDebug(), ENT_QUOTES).'</p>';
            die();
        }
        // Datos de entrada
        $datos = array('usuario' => $this->usuario,
            'clave' => $this->clave,
            'idusuario' => $idusuario,
            'idevento' => $idevento);

        $result = $cliente->call(
            $metodoALlamar,  // Funcion a llamar
            $datos   // Parametros pasados a la funcion
        );

        // Verificacion que los parametros estan ok, y si lo estan. mostrar rta.
        if ($cliente->fault) {
            return $result;
        } else {
            $error = $cliente->getError();
            if ($error) {
                return $error;
            } else {
                return $result;
            }
        }
    }
    function eliminarInscripcionEvento($idevento, $idusuario){
        $serverURL = $this->urlEliminarInscripcionEvento;
        $metodoALlamar = 'eliminarInscripcion';
        $cliente = new nusoap_client($serverURL.'?wsdl', 'wsdl');
        $cliente->soap_defencoding = 'UTF-8';

        $error = $cliente->getError();
        if ($error) {
            echo '<pre style="color:red">' . $error . '</pre>';
            echo '<p style="color:red;'>htmlspecialchars($cliente->getDebug(), ENT_QUOTES).'</p>';
            die();
        }
        // Datos de entrada
        $datos = array('usuario' => $this->usuario,
            'clave' => $this->clave,
            'idusuario' => $idusuario,
            'idevento' => $idevento);

        $result = $cliente->call(
            $metodoALlamar,  // Funcion a llamar
            $datos   // Parametros pasados a la funcion
        );

        // Verificacion que los parametros estan ok, y si lo estan. mostrar rta.
        if ($cliente->fault) {
            return $result;
        } else {
            $error = $cliente->getError();
            if ($error) {
                return $error;
            } else {
                return $result;
            }
        }
    }
    function inscripcionEvento($idevento, $idusuario){
        $serverURL = $this->urlIncripcionEvento;
        $metodoALlamar = 'creaInscripcion';
        $cliente = new nusoap_client($serverURL.'?wsdl', 'wsdl');
        $cliente->soap_defencoding = 'UTF-8';

        $error = $cliente->getError();
        if ($error) {
            echo '<pre style="color:red">' . $error . '</pre>';
            echo '<p style="color:red;'>htmlspecialchars($cliente->getDebug(), ENT_QUOTES).'</p>';
            die();
        }
        // Datos de entrada
        $datos = array('usuario' => $this->usuario,
            'clave' => $this->clave,
            'idusuario' => $idusuario,
            'idevento' => $idevento);

        $result = $cliente->call(
            $metodoALlamar,  // Funcion a llamar
            $datos   // Parametros pasados a la funcion
        );

        // Verificacion que los parametros estan ok, y si lo estan. mostrar rta.
        if ($cliente->fault) {
            return $result;
        } else {
            $error = $cliente->getError();
            if ($error) {
                return $error;
            } else {
                return $result;
            }
        }
    }
    function ingresoComprobante($idevento, $idusuario, $comprobante){
        $serverURL = $this->urlIngresoComprobante;
        $metodoALlamar = 'ingresaComprobante';
        $cliente = new nusoap_client($serverURL.'?wsdl', 'wsdl');
        $cliente->soap_defencoding = 'UTF-8';

        $error = $cliente->getError();
        if ($error) {
            echo '<pre style="color:red">' . $error . '</pre>';
            echo '<p style="color:red;'>htmlspecialchars($cliente->getDebug(), ENT_QUOTES).'</p>';
            die();
        }
        // Datos de entrada
        $datos = array('usuario' => $this->usuario,
            'clave' => $this->clave,
            'idevento' => $idevento,
            'idusuario' => $idusuario,
            'comprobante' => $comprobante);

        $result = $cliente->call(
            $metodoALlamar,  // Funcion a llamar
            $datos   // Parametros pasados a la funcion
        );

        // Verificacion que los parametros estan ok, y si lo estan. mostrar rta.
        if ($cliente->fault) {
            return $result;
        } else {
            $error = $cliente->getError();
            if ($error) {
                return $error;
            } else {
                return $result;
            }
        }
    }

    function registrarUsuario($usuario, $clave, $nombre, $apellido, $email, $telefono, $edad, $sexo){
        $serverURL = $this->urlRegistroUsuario;
        $metodoALlamar = 'registraUsuario';
        $cliente = new nusoap_client($serverURL.'?wsdl', 'wsdl');
        $cliente->soap_defencoding = 'UTF-8';


        $datos = array(
            'usuario' => $this->usuario,
            'clave' => $this->clave,
            'rut' => $usuario,
            'pass' => $clave,
            'nombre' => $nombre,
            'apellido' => $apellido,
            'email' => $email,
            'telefono' => $telefono,
            'edad' => $edad,
            'sexo' => $sexo
        );

        $result = $cliente->call(
            $metodoALlamar,  // Funcion a llamar
            $datos   // Parametros pasados a la funcion
        );

        // Verificacion que los parametros estan ok, y si lo estan. mostrar rta.
        if ($cliente->fault) {
            return $result;
        } else {
            $error = $cliente->getError();
            if ($error) {
                return $error;
            } else {
                return $result;
            }
        }

    }
}









$user = '151192858';
$pass = '1234';












function console_log( $data ){
    echo '<script>';
    echo 'console.log('. json_encode( $data ) .')';
    echo '</script>';
}