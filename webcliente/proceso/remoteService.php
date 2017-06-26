<?php
require_once 'class.servicios.php';

function verEvento($cantidad){
    $servicios = new Servicios();

    return $servicios->verEventos($cantidad);
}

function validarInscripcionEvento($idevento, $idusuario){
    $servicios = new Servicios();
    return $servicios->validaInscripcionEvento($idevento, $idusuario);
}