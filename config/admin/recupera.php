<?php
if (!isset($_POST['user'])) {exit;}
include_once($_SERVER['DOCUMENT_ROOT']."/config/config.php");
$user = anti_injection($_POST['user']);


$ler = ler_db("admin", " WHERE (user = '".$user."' OR email = '".$user."') ");
foreach ($ler as $lers) {
	$user = $lers['user'];
	$email = $lers['email'];
	$senha = $lers['senha'];
}
$destino = $email
$email = "luisfelipermx3401@gmail.com"; // EMAIL DE QUEM ENVIA
$arquivo = "<!DOCTYPE html>
	<html>
	<head>
		<title>Recuperação de senha</title>
	</head>
	<body>
	<div>".$dataLocal."</div>
	<div>
		Usuario:".$user." Senha: ".$senha."
	</div>
	</body>
	</html>
";
// É necessário indicar que o formato do e-mail é html
$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
$headers .= 'From: Recuperar Senha <$email>';
mail($destino, 'Report erro PlaySeries', $arquivo, $headers);
exit();
if($enviaremail){
	/* Enviou o email */
	echo "1";
} else {
	/* Não enviou o email */
	echo "0";
}
?>