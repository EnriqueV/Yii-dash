<?php
require("class.phpmailer.php");
require("class.smtp.php");


$mail = new PHPMailer();
$mail->IsSMTP();
$mail->SMTPAuth = true;
$mail->SMTPDebug = 2;
$mail->SMTPSecure = "ssl";
$mail->Host = "smtp.gmail.com";
$mail->Port = 465;
$mail->Username = "";
$mail->Password = "";

$mail->From = "albert.hugo@hotmail.com";
	$mail->FromName = "Tu Nombre";
	$mail->Subject = "Enviar Mail con PHPMailer";
	$mail->AltBody = "";
	$mail->MsgHTML("<h1>Hola Mundo!</h1>");
$mail->AddAttachment("adjunto.txt");

$mail->AddAddress("lhugo.calderon@gmail.com");
$mail->IsHTML(true);
if($mail->Send()){
 echo "Enviado";
}else{
    echo "No enviado";
}


?>