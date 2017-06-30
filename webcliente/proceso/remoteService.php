<?php
require_once 'class.servicios.php';

function verEvento($cantidad){
    $servicios = new Servicios();

    return $servicios->verEventos($cantidad);
}

function evento($idevento){
    $servicios = new Servicios();
    return $servicios->evento($idevento);
}

function validarInscripcionEvento($idevento, $idusuario){
    $servicios = new Servicios();
    return $servicios->validaInscripcionEvento($idevento, $idusuario);
}

function eliminaInscripcionEvento($idevento, $idusuario){
    $servicios = new Servicios();
    return $servicios->eliminarInscripcionEvento($idevento,$idusuario);
}

function inscripcionEvento($idevento, $idusuario){
    $servicios = new Servicios();
    return $servicios->inscripcionEvento($idevento, $idusuario);
}