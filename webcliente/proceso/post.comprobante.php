<?php

$comprobante = $_FILES['comprobante'];


if (!empty($_FILES['comprobante']['name'])){

    file_put_contents("image.jpg", $comprobante);
    echo 'guardo archivo';
    echo '{}';
    return;
}else{

    echo '{}';
    return;
}
