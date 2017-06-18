<?php
/**
 * Created by PhpStorm.
 * User: darro
 * Date: 13-06-2017
 * Time: 22:36
 */
function getCliente($usuario, $clave){
    $query = "SELECT * FROM CLIENTE WHERE USUARIOCLIENTE = '".$usuario."' AND PASSCLIENTE = '".$clave."'";
    return $query;
}

function getEventoIndividual($id){
    $query = "SELECT E.NOMBRE, S.NOMBRE AS NOMBRESENDERO, E.DESCRIPCION, 
              E.FECHA, E.HORA, E.VALOR, E.PUNTO, E.FOTO 
              FROM EVENTO E 
              JOIN SENDERO S ON 
              E.IDSENDERO = S.IDSENDERO 
              WHERE E.IDEVENTO = '".$id."'";
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

function putInscripcionEvento($inscripcion){
    $query = "INSERT INTO INSCRIPCIONEVENTO (IDEVENTO, IDUSUARIO, ACTIVO, PAGADO)
              VALUES ('".$inscripcion['idevento']."', '".$inscripcion['idusuario']."', 0, 0)";
    return $query;
}

function putInscripcionPack($inscripcion){
    $query = "INSERT INTO INSCRIPCIONPACK (IDPACK, IDUSUARIO, ACTIVO, PAGADO)
              VALUES ('".$inscripcion['idpack']."', '".$inscripcion['idusuario']."', 0, 0)";
    return $query;
}

function getInscripcionEvento($inscripcion){
    $query = "SELECT * FROM INSCRIPCIONEVENTO 
              WHERE IDEVENTO = '".$inscripcion['idevento']."' AND IDUSUARIO = '".$inscripcion['idusuario']."'";
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