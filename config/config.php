<?php
header("Content-type: text/html; charset=utf-8");
date_default_timezone_set('America/Sao_Paulo');
$ip = $_SERVER['REMOTE_ADDR'];
$dataLocal = date('d-m-Y H:i:s');
/** Funções **/
function anti_injection($sql){$sql = preg_replace('/(index.php|config|.dat|.js|.css|from|select|insert|delete|where|drop table|show tables|#|\*|--|\\\\)/','',$sql);$sql = trim($sql);$sql = strip_tags($sql);$sql = addslashes($sql);return $sql;}
function charsEspe($str){
	$str = str_replace("#","&#35;",$str);
	$str = str_replace("*","&#42;",$str);
	$str = str_replace("\"","&#34;",$str);
	$str = str_replace("\\","&#92;",$str);
	$str = str_replace("/","&#47;",$str);
	$str = str_replace("'","&#39;",$str);
	$str = str_replace("-","&#45;",$str);
	$str = str_replace("+","&#43;",$str);
	$str = str_replace("=","&#61;",$str);
	$str = str_replace("<","&#60;",$str);
	$str = str_replace(">","&#62;",$str);
	$str = str_replace("!","&#33;",$str);
	return $str;
}
function fecha_conexao($conn){mysqli_close($conn) or die (mysqli_error());}
function connect_db(){
	$conn = mysqli_connect('localhost', 'luisfeliperm', '@Naruto123', 'playseries');
	mysqli_set_charset($conn, "utf8") or die (mysqli_error($conn));
	if (mysqli_connect_errno()) {
		$conn = "Erro no banco de dados!";exit();
	}
	return $conn;
}
function executa_query($query){
	$conn = connect_db();
	$result = @mysqli_query($conn, $query);
	return $result;
	fecha_conexao($conn);
}
function ler_db($tabela, $params = null, $fields = '*'){
	$query = "SELECT {$fields} FROM {$tabela} {$params} ";
	$result = executa_query($query);
	if (!@mysqli_num_rows($result)) {
		return false;
	}else{
		while ($res = mysqli_fetch_assoc($result)) {
			$data[] = $res;
		}
		return $data;
	}
}
$admin = 0;
// var SITE
$url_serie = @anti_injection($_GET['url_serie']);
session_start();
// Verifica a conta de admin
if (isset($_SESSION['email'],$_SESSION['pass']) && !empty($_SESSION['email']) && !empty($_SESSION['pass'])) {
	$query = "SELECT * FROM admin WHERE email = '".$_SESSION['email']."' AND pass = '".$_SESSION['pass']."' AND nivel > 0";
	$result = executa_query($query);
	if (!mysqli_num_rows($result)) {
		$_SESSION['email'] = null;$_SESSION['pass'] = null;
		session_destroy();
		echo "<script>window.location.href='/admin/';</script>";;exit();
	}else{$admin = 1;}
}
if (isset($_GET['sair'])){session_destroy();header('Location: /');exit();}
?>