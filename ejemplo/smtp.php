<?php 

// Pear Mail Library
/*
require_once "Mail.php";

$from = '<your@mail.com>'; //change this to your email address
$to = '<daniele@arroyo.cl>'; // change to address
$subject = 'Insert subject here'; // subject of mail
$body = "Hello world! this is the content of the email"; //content of mail

$headers = array(
    'From' => $from,
    'To' => $to,
    'Subject' => $subject
);

$smtp = Mail::factory('smtp', array(
        'host' => 'ssl://smtp.gmail.com',
        'port' => '465',
        'auth' => true,
        'username' => 'darroylat@gmail.com', //your gmail account
        'password' => 'deal051085' // your password
    ));

// Send the mail
$mail = $smtp->send($to, $headers, $body);*/



require 'PHPMailerAutoload.php';


// Crear una nueva  instancia de PHPMailer habilitando el tratamiento de excepciones

$mail = new PHPMailer(true); 
	
// Configuramos el protocolo SMTP con autenticación
$mail->IsSMTP();
$mail->SMTPAuth = true;
	
// Puerto de escucha del servidor
$mail->Port = 465
	
// Dirección del servidor SMTP
$mail->Host = 'smtp.gmail.com';

// Usuario y contraseña para autenticación en el servidor
$mail->Username   = "darroylat@gmail.com"
$mail->Password = "deal051085"

// Dirección de correo del remitente
$mail->From = "no-reply@lerolero.cl";

// Nombre del remitente
$mail->FromName = "Mi nombre y apellidos";


$mail->AddAddress("daniel@arroyo.cl","Daniel Arroyo");
//$mail->AddAddress("destino2@correo.com","Nombre 2");
//$mail->AddAddress("destinon@correo.com","Nombre n");

// copia
//$mail->AddCC("copia1@correo.com","Nombre copia 1");
// copia oculta
//$mail->AddBCC("copia1@correo.com","Nombre copia 1");

$mail->Subject = "Asunto del correo";

// Creamos en una variable el cuerpo, contenido HMTL, del correo
$body  = "Proebando los correos con un tutorial<br>";
$body .= "hecho por <strong>Developando</strong>.<br>";
$body .= "<font color='red'>Visitanos pronto</font>";
	
// Añadimos el contenido al mail creado 
$mail->Body = $body;

// Fichero adjunto
//$mail->AddAttachment("misImagenes/foto1.jpg", "developandoFoto.jpg");
//$mail->AddAttachment("files/proyecto.zip", "demo-proyecto.zip");

if($mail->Send())
{
	echo 'exito';
    /*echo'<script type="text/javascript">
            alert("Enviado Correctamente");
            //window.location="http://localhost/maillocal/index.php"
         </script>';*/
}else{
	echo 'rechazado';
    /*echo'<script type="text/javascript">
            alert("NO ENVIADO, intentar de nuevo");
            //window.location="http://localhost/maillocal/index.php"
         </script>';*/
}
?>