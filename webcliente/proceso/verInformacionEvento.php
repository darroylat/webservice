<?php
require_once 'remoteService.php';
$codigoEvento = $_POST['codigo'];
echo evento($codigoEvento);