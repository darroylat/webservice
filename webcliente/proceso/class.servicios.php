<?php
require_once(realpath($_SERVER["DOCUMENT_ROOT"]) .'/webservice/nusoap/lib/nusoap.php');

class Servicios{

var $usuario = 'cliente';
var $clave = '123456';

    function valida_usuario($user, $pass){
        $serverURL = 'http://localhost/webservice/mountain/usuario/valida_usuario.php';
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
        $serverURL = 'http://localhost/webservice/mountain/evento/obtener_evento_todos.php';
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
        $serverURL = 'http://localhost/webservice/mountain/evento/obtener_evento_individual.php';
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
        $serverURL = 'http://localhost/webservice/mountain/inscripcion/valida/valida_inscripcion_evento.php';
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
        $serverURL = 'http://localhost/webservice/mountain/inscripcion/eliminar/eliminar_inscripcion_evento.php';
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
        $serverURL = 'http://localhost/webservice/mountain/inscripcion/registro/registrar_inscripcion_evento.php';
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
        $serverURL = 'http://localhost/webservice/mountain/comprobante/ingresa_comprobante.php';
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

}









$user = '151192858';
$pass = '1234';












function console_log( $data ){
    echo '<script>';
    echo 'console.log('. json_encode( $data ) .')';
    echo '</script>';
}