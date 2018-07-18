<?php
include_once($_SERVER['DOCUMENT_ROOT']."/config.php");
$email = "luisfelipermx3401@gmail.com"; // EMAIL DE QUEM ENVIA
$mensagem = $_POST['msg'];
$destino = "luisfelipepoint@gmail.com";
$arquivo = "<!DOCTYPE html>
	<html>
	<head>
		<title>Report</title>
	</head>
	<body>
	<div>".$_POST['url']."</div>
	<div>".$dataLocal."</div>
	<div>
		".$mensagem."
	</div>
	</body>
	</html>
";
// É necessário indicar que o formato do e-mail é html
$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
$headers .= 'From: PLAYSERIES <$email>';
$enviaremail = mail($destino, 'Report erro PlaySeries', $arquivo, $headers);
if($enviaremail){
	/* Enviou o email */
	echo "1";
} else {
	/* Não enviou o email */
	echo "0";
}
?>