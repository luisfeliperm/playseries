<style type="text/css">
	.topo .ordem{
		text-align: right;
		display: inline-block;
	}
	.pesquisa{
		width: 240px;
		position: relative;
		float: left;
	}
	.op{
		padding-left: 20px;
		text-decoration: underline;
	}
	.list_user li:hover{
		background-color: #ebebeb;
	}
	#status{
		padding: 5px 10px;
		padding: 18px 0px;
		text-align: right;
		position: absolute;
		right: 0;
		display: inline-block;
	}
	#id01{
		background: #fff;
		position: fixed;bottom: 0;top: 0;left: 0;right: 0;
	}
</style>
<?php
if (isset($_GET['dell'])) {
	$id = anti_injection($_GET['dell']);
	$query = "DELETE FROM usuarios WHERE id = '".@$id."' ";
	executa_query($query);
}
?>
<h2>Administrador > Usuarios</h2>
<div class="topo">
	<form class="pesquisa" method="get" action="?p=usuarios.php">
		<input type="hidden" name="p" value="usuarios.php" /> 
		<input class="input_pesq" placeholder="Pesquisar usuario" type="text" name="b">
	</form>
	<div class="ordem">
		<label>Ordem:</label>
		<select onchange="ordem();" id="ordem_select"><option <?php if(@$_GET['ordem']=="novos"){echo "selected";} ?> value="1">Novos</option><option <?php if(@$_GET['ordem']=="antigos"){echo "selected";} ?> value="0">Antigos</option></select>
	</div>
	<div id="status"></div>
</div>
<!-- Exibe lista de usuarios -->
<ul>
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
/// Status
if (isset($_GET['status']) && $_GET['status'] >= 0) {
	$priv = anti_injection($_GET['status']);
	$query = "UPDATE usuarios SET status = '".$priv."' WHERE id = '".anti_injection(@$_GET['id'])."' ";
	executa_query($query);
}
/// NIVEL
if (isset($_GET['nivel']) && $_GET['nivel'] >= 0) {
	$priv = intval($_GET['nivel']);
	$query = "UPDATE usuarios SET nivel = '".$priv."' WHERE id = '".anti_injection(@$_GET['id'])."' ";
	executa_query($query);
}
/// NIVEL
if (isset($_GET['renovar']) && $_GET['renew_tempo'] >= 0) {
	$priv = intval($_GET['renew_tempo']);
	$query = "UPDATE usuarios SET tempo = '".$priv."', renovado = '".$dataLocal."' WHERE id = '".anti_injection(@$_GET['id'])."' ";
	executa_query($query);
}
if (isset($_GET['b']) && !empty($_GET['b'])) {
	# Se for solicitada a busca
	/// Busca solicitada
	?>
	<a href="./?p=usuarios.php" style="text-decoration: underline;padding: 0px;margin:0px;"><< VOLTAR </a>
	<?php
	$total = 0;
	$key = anti_injection($_GET['b']);
	$ler = @ler_db("usuarios", "WHERE (ip LIKE '%". $key ."%' OR nome LIKE '%". $key ."%' OR email LIKE '%". $key ."%' OR senha LIKE '%". $key ."%' OR login LIKE '%". $key ."%') ORDER BY id ".$ordem."");
	if (!empty($ler)) {
		foreach ($ler as $lers) {
			$total ++;
			?>
	        <li>
	        	<a href="?p=usuarios.php&id=<?php echo $lers['id']; ?>&info=1"><?php echo $lers["login"]; ?></a>
	        </li>
	        <?php				
		}
	}else{
		echo "<div style='padding: 20px 10px;'>Não encontrado</div>";
	}
	?><script type="text/javascript">edita_texto('status','Resultado: <?php echo $total; ?>');</script><?php
}else{
	# Não foi solicitada busca
	$ler = @ler_db("usuarios", "ORDER BY id ".$ordem."");
	if (!empty($ler)) {
		foreach ($ler as $lers) {
			@$total++;
			?>
	        <li>
	        	<a href="?p=usuarios.php&id=<?php echo $lers['id']; ?>&info=1"><?php echo $lers["login"]; ?></a>
	        	<script type="text/javascript">
	        		// Soma user
	        		edita_texto('status','Resultado: <?php echo $total; ?>')
	        	</script>
	        </li>
	        <?php
		}
	}else{
		 echo "0 results";
	}
}
?>
</ul>

<?php
//  Exibir informações de um user especifico
if (isset($_GET['id'],$_GET['info'])) {
	$g_id = anti_injection($_GET['id']);
	// Pega info do user no db com o ID
	$ler = @ler_db("usuarios", "WHERE id='".$g_id."' ");
?>
<div id="id01" style="display: block;">
    <div class="">
      <header> 
      	<span class="close" onclick="document.getElementById('id01').style.display='none'" 
        class="w3-button w3-display-topright">&times;</span>
      	<?php 
      	if (!empty($ler)) {
		foreach ($ler as $lers) {
	    ?>
        <h2>Usuario <?php echo $lers["id"]; ?> </h2>
      </header>
      <div style="padding: 0px 10px;">
        <p>IP: <?php echo $lers["ip"]; ?></p>
        <p>Data: <?php echo $lers["data"]; ?></p>
        <p>Nome: <?php echo $lers["nome"]; ?></p>
        <p>User: <?php echo $lers["login"]; ?></p>
        <p>Email: <?php echo $lers["email"]; ?></p>
        <p>Senha: <?php echo $lers["senha"]; ?></p>
        <hr>
        <p>Tempo: <?php echo $lers["tempo"]; ?></p>
        <p>Renovado: <?php echo date('d/m/Y h:m:i',  strtotime($lers["renovado"])); ?></p>
        <div>
        	<form>
        		<input type="hidden" name="p" value="usuarios.php">
        		<input type="hidden" name="id" value="<?php echo $_GET['id'];?>">
        		<input type="hidden" name="info" value="true">
        		<input type="hidden" name="renovar" value="true">
        		<input type="number" name="renew_tempo" value="10" style="width: 60px;" name="tempo">
        		<button>RENOVAR</button>
        	</form>
        </div>
      </div>

      <footer class="w3-container w3-teal">
        <p><a href="./?p=usuarios.php&dell=<?php echo $lers["id"]; ?>" class="op">Excluir</a>
        	<a class="op" href="./?p=vitimas.php&pesquise=1&PorDono=<?php echo $lers["login"]; ?>&ordem=novos&limit=0">Logs</a>
        	<a class="op" href="./?p=usuarios.php&link_gerado=<?php echo $lers["id"]; ?>">Links gerados</a>

        	<select onchange="status();" id="status_select" style="margin-left: 10px;">
        		<option <?php if($lers["status"]=="1"){echo "selected";} ?> value="1">Ativo</option>
        		<option <?php if($lers["status"]=="0"){echo "selected";} ?> value="0">Bloqueado</option>
        	</select>

        	<select title="nivel" onchange="nivel();" id="nivel_select" style="margin-left: 10px;">
        		<option <?php if($lers["nivel"]=="1"){echo "selected";} ?> value="1">Comum</option>
        		<option <?php if($lers["nivel"]=="2"){echo "selected";} ?> value="2">Premium</option>
        		<option <?php if($lers["nivel"]=="3"){echo "selected";} ?> value="3">Admin</option>
        	</select>

        </p>
      </footer>
      <?php
      	}
		}else{
		    echo "Não encontrado";
		}
      ?>
    </div>
  </div>
 <input type="hidden" id="id_atual" value="<?php echo $_GET['id']; ?>" >
<?php
}
?>
<script type="text/javascript">
function ordem(){
	if(document.getElementById('ordem_select').value =="1"){
		window.location.href="./?p=usuarios.php&ordem=novos";
	}else{
		window.location.href="./?p=usuarios.php&ordem=antigos";
	}
}
function status(){
	var id_atual = document.getElementById("id_atual").value;
	if(document.getElementById('status_select').value =="1"){
		window.location.href="./?p=usuarios.php&id="+id_atual+"&info=1&status=1";
	}else{
		window.location.href="./?p=usuarios.php&id="+id_atual+"&info=1&status=0";
	}
}
function nivel(){
	var id_atual = document.getElementById("id_atual").value;
	if(document.getElementById('nivel_select').value =="1"){
		window.location.href="./?p=usuarios.php&id="+id_atual+"&info=1&nivel=1";
	}else if(document.getElementById('nivel_select').value =="2"){
		window.location.href="./?p=usuarios.php&id="+id_atual+"&info=1&nivel=2";
	}else{
		window.location.href="./?p=usuarios.php&id="+id_atual+"&info=1&nivel=3";
	}
}
</script>
