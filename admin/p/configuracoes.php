<?php 
if (isset($_GET['add_dns'],$_GET['tipo']) && !empty($_GET['add_dns']) && !empty($_GET['tipo'])) {
	$add = anti_injection($_GET['add_dns']);
	$tipo = anti_injection(intval($_GET['tipo']));

	if (filter_var($add, FILTER_VALIDATE_URL)) {
		$sql = "INSERT INTO dominios (tipo,dns) VALUES ('".$tipo."', '".$add."') ";
		if(executa_query($sql) === true){
			echo "<div class='sucesso'>
			ADICIONADO: ".$add." <b>#".$tipo."</b>
			</div>";
		}else{
			echo "<div class='erro'>ERRO</div>";
		}
	}
}
if (isset($_GET['up_dns'],$_GET['id']) && !empty($_GET['up_dns']) && !empty($_GET['id'])) {
	$new = anti_injection($_GET['up_dns']);
	$id = anti_injection(intval($_GET['id']));

	if (filter_var($new, FILTER_VALIDATE_URL)) {
		$sql = "UPDATE dominios SET dns ='".$new."' WHERE id = '".$id."' ";
		if(executa_query($sql) === true){
			echo "<div class='sucesso'>SUCESSO</div>";
		}else{
			echo "<div class='erro'>ERRO</div>";
		}
	}
}
if (isset($_GET['dns_dell']) && !empty($_GET['dns_dell'])) {
	$id  = anti_injection(intval($_GET['dns_dell']));
	$sql = "DELETE FROM dominios WHERE id = '".$id."' ";
	if (executa_query($sql) === true) {
		echo "<div class='sucesso'>DELETADO</div>";
	}else{
		echo "<div class='erro'>ERRO</div>";
	}
}
?>
<style type="text/css">
	a{
		text-decoration: none;
	}
	.status{
		display: block;
		width: 275px;
		border: 1px solid #ededed;
	}
	.se_titulo{
		padding: 10px;
		color: #444;
		background: #dbdbdb;
		overflow: auto;
	}
	.status > form{
		padding: 10px;
	}
	.status > form div{
		margin-right: 20px;
		display: inline-block;
	}
	.status > form div:hover{
		color: #c40000;
	}
	.status label,.status input{cursor: pointer;}
	.status button{margin: auto;margin-top: 10px;display: table;}
	.status .se_titulo > span:after{
	    padding: 0px 8px;
	    text-decoration: none;
	    color: blue; /* Or a color you prefer */
	}
</style>


<h2>Administrador > Configurações do site</h2>
<hr>
<h2 style="margin:4px 0px">Dominios</h2>
<div class="info">
	<div><b>TIPO 1:</b> Encurtador FREE</div>
	<div><b>TIPO 2:</b> Encurtador Premium</div>
	<div><b>TIPO 3:</b> URL Final Free</div>
	<div><b>TIPO 4:</b> URL Final Premium</div>
</div>
<form>
	<input type="hidden" name="p" value="configuracoes.php">
	<input type="url" name="add_dns" required>	
	<select name="tipo">
		<optgroup label="Encurtador">
			<option value="1">#1 Free</option>
			<option value="2">#2 Premium</option>
		</optgroup>
		<optgroup label="URL Final">
			<option value="3">#3 Free</option>
			<option value="4">#4 Premium</option>
		</optgroup>
	</select>
	<button>ADD</button>
</form>

<?php if (!empty($_GET['dns_up'])){
	$id_dns = anti_injection(intval($_GET['dns_up']));
	$ler = ler_db("dominios", "WHERE id = '".$id_dns."' ");

	if (!empty($ler)) {
		foreach ($ler as $lers) {
			?>
			<form class="update">
				<input type="hidden" name="p" value="configuracoes.php">
				<div><b>DE:</b> <?php echo $lers['dns']." <b>#".$lers['tipo']."</b>"; ?> </div>
				<label>New:</label>
				<input type="hidden" name="id" value="<?php echo $id_dns;?>">
				<input type="url" name="up_dns" required>
				<button>Up</button>
			</form>
			<?php 
		}
	}
}

?>





<ul class="lista">
	<?php
	$ler = ler_db("dominios", "ORDER BY tipo ASC");
	if (!empty($ler)) {
		foreach ($ler as $lers) {
			$dns = $lers['dns'];
			echo "
			<li>
				TIPO: ".$lers['tipo']." ".$dns."
				<a href='./?p=configuracoes.php&dns_up=".$lers['id']."'>Alterar</a> <a href='./?p=configuracoes.php&dns_dell=".$lers['id']."'>Deletar</a>
			</li>";
		}
	}
	?>
</ul>


<style type="text/css">
.lista a:hover{text-decoration: underline;}
.lista{
	margin:10px 5px;
}
.info{
	border:1px solid #ddd;padding: 10px;margin:10px 0px;
	background: #f1f1f1;
}
.update{
	margin:10px 0px;border:1px solid #ddd;padding: 10px;
	background: #d9ffe2;color:green;
}
.update > div{padding: 5px 0px;}
</style>