<!DOCTYPE html>
<html>
<head>
	<title>Administração - LOGIN</title>
	<meta charset="utf-8">
</head>
<body>
<form method="post">
	<input type="password" placeholder="Senha" name="login">
	<button>entrar</button>
</form>
<style type="text/css">
*{font-family:arial;box-sizing: border-box;}
	body{margin:0;background: #f1f1f1}
	form{
		border:1px solid #ddd;
		width: 200px;padding: 10px;
		margin:20px auto;background: #fff;
	}
	form input{
		display: block;width: 100%;
		padding: 6px 8px;
	}
	form button{
		margin:5px 0px;
		padding: 4px;
		width: 100%;
	}
</style>
</body>
</html>
<?php 
session_start();
echo $_SESSION['login'];
if (isset($_POST['login']) && $_POST['login'] == "22082000") {
	$_SESSION['login'] = $_POST['login'];
	header('Location: /admin/'); 
}
?>