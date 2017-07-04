<?php
/**
 * Created by PhpStorm.
 * User: darro
 * Date: 13-06-2017
 * Time: 22:36
 */
function getCliente($usuario, $clave){
    $query = "SELECT * FROM MOUNTAIN_ADMIN.CLIENTE WHERE USUARIOCLIENTE = '".$usuario."' AND PASSCLIENTE = '".$clave."'";
    return $query;
}

function getEventoIndividual($id){
    $query = "SELECT E.NOMBRE, S.NOMBRE AS NOMBRESENDERO, E.DESCRIPCION, 
              E.FECHA, E.HORA, E.VALOR, E.PUNTO, E.FOTO 
              FROM EVENTO E 
              JOIN SENDERO S ON E.IDSENDERO = S.IDSENDERO 
              WHERE E.IDEVENTO = '".$id."'";
    return $query;
}

function getTodosEvento(){
    $query = "SELECT E.IDEVENTO, E.NOMBRE, S.NOMBRE AS NOMBRESENDERO, U.NOMBRE AS NOMBREUBICACION,
                E.DESCRIPCION, E.FECHA, E.HORA,  E.VALOR, E.PUNTO, E.FOTO, E.ESTADO FROM EVENTO E
                JOIN SENDERO S ON E.IDSENDERO = S.IDSENDERO
                JOIN UBICACION U ON U.IDUBICACION = S.IDUBICACION
                WHERE DATE(E.FECHAREGISTRO) > CURDATE() - INTERVAL 1 DAY";
    return $query;
}

function getUsuario($usuario, $clave){
    $query = "SELECT * FROM USUARIO WHERE IDUSUARIO = '".$usuario."' AND PASSWORD = '".$clave."'";
    return $query;
}

function putUsuario($usuario){
    $query = "";
    return $query;
}

function putInscripcionEvento($idevento, $idusuario){
    $query = "INSERT INTO INSCRIPCIONEVENTO (IDEVENTO, IDUSUARIO, ACTIVO, PAGADO)
              VALUES ('".$idevento."', '".$idusuario."', 1, 0)";
    return $query;
}

function putInscripcionPack($inscripcion){
    $query = "INSERT INTO INSCRIPCIONPACK (IDPACK, IDUSUARIO, ACTIVO, PAGADO)
              VALUES ('".$inscripcion['idpack']."', '".$inscripcion['idusuario']."', 1, 0)";
    return $query;
}

function getInscripcionEvento($idevento, $idusuario){
    $query = "SELECT * FROM INSCRIPCIONEVENTO 
              WHERE IDEVENTO = '".$idevento."' AND IDUSUARIO = '".$idusuario."'";
    return $query;
}

function getInscripcionPack($inscripcion){
    $query = "SELECT * FROM INSCRIPCIONPACK
              WHERE IDPACK = '".$inscripcion['idpack']."' AND IDUSUARIO = '".$inscripcion['idusuario']."'";
    return $query;
}

function delInscripcionEvento($inscripcion){
    $query = "DELETE FROM INSCRIPCIONEVENTO WHERE IDEVENTO = '".$inscripcion['idevento']."' AND IDUSUARIO = '".$inscripcion['idusuario']."'";
    return $query;
}

function delInscripcionPack($inscripcion){
    $query = "DELETE FROM INSCRIPCIONPACK WHERE IDPACK = '".$inscripcion['idpack']."' AND IDUSUARIO = '".$inscripcion['idusuario']."'";
    return $query;
}

function updateInscripcionEvento($id, $activo){
    $query = "UPDATE INSCRIPCIONEVENTO SET ACTIVO = '".$activo."' WHERE IDINSCRIPCION = '".$id."'";
    return $query;
}

function updateInscripcionPack($id, $activo){
    $query = "UPDATE INSCRIPCIONPACK SET ACTIVO = '".$activo."' WHERE IDINSCRIPCIONPACK = '".$id."'";
    return $query;
}

function getEquipoEvento($id){
    $query = "SELECT DISTINCT E.IDEQUIPOTRECK, M.DESCRIPCION FROM EQUIPOEVENTO E
                JOIN MAESTROEQUIPO M ON
                M.IDEQUIPOTRECK = E.IDEQUIPOTRECK
                WHERE IDEVENTO = '".$id."'  ORDER BY E.IDEQUIPOTRECK ASC";
    return $query;
}