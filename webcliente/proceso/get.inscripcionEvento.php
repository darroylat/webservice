<?php
require_once 'remoteService.php';
$idusuario = $_GET['idusuario'];
$idevento = $_GET['idevento'];
$tipo = $_GET['tipo'];

if($tipo == 0){
    $inscripcion = eliminaInscripcionEvento($idevento, $idusuario);
    $split = split($inscripcion,'\|');
    header("location: ../index.php");
}else{
    $inscripcion = inscripcionEvento($idevento, $idusuario);
    header("location: ../index.php");
}