


<?php
//mail("daniel@arroyo.cl","asuntillo","Este es el cuerpo del mensaje") 
/*
$mail = "Prueba de mensaje";
//Titulo
$titulo = "PRUEBA DE TITULO";
//cabecera
$headers = "MIME-Version: 1.0\r\n"; 
$headers .= "Content-type: text/html; charset=iso-8859-1\r\n"; 
//dirección del remitente 
$headers .= "From: Geeky Theory < daniel@geektheory.com >\r\n";
//Enviamos el mensaje a tu_dirección_email 
$bool = mail("darroylat@gmail.com",$titulo,$mail,$headers);
if($bool){
    echo "Mensaje enviado";
}else{
    echo "Mensaje no enviado";
}
*/

//Librerías para el envío de mail
include_once('class.phpmailer.php');
include_once('class.smtp.php');
 
//Recibir todos los parámetros del formulario
$para = $_POST['email'];
$asunto = $_POST['asunto'];
$mensaje = $_POST['mensaje'];
$archivo = $_FILES['hugo'];
 
//Este bloque es importante
$mail = new PHPMailer();
$mail->IsSMTP();
$mail->SMTPAuth = true;
$mail->SMTPSecure = "ssl";
$mail->Host = "smtp.gmail.com";
$mail->Port = 465;
 
 
//Nuestra cuenta
$mail->Username ='darroylat@gmail.com';
$mail->Password = 'deal051085'; //Su password

// Dirección de correo del remitente
$mail->From = "no-reply@lerolero.cl";
$mail->FromName = "Mi nombre y apellidos";
 
//Agregar destinatario
$mail->AddAddress('daniel@arroyo.cl');
$mail->Subject = '$asunto';
$mail->Body = 'Prueba';
//Para adjuntar archivo
//$mail->AddAttachment($archivo['tmp_name'], $archivo['name']);
//$mail->MsgHTML('$mensajeaaaaaaaaaaaaaa');
 
//Avisar si fue enviado o no y dirigir al index
if($mail->Send())
{
    echo'<script type="text/javascript">
            alert("Enviado Correctamente");
            //window.location="http://localhost/maillocal/index.php"
         </script>';
}
else{
    echo'<script type="text/javascript">
            alert("NO ENVIADO, intentar de nuevo");
            //window.location="http://localhost/maillocal/index.php"
         </script>';
}
?>

