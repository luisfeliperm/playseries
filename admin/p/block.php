<?php 
if (isset($_POST['ip'])) {
	$a = anti_injection(@$_POST['titulo']);
	$b = anti_injection(@$_POST['ip']);
	$c = anti_injection(@$_POST['descricao']);
	$query = "INSERT INTO block (nome,ip,descricao) VALUES ('".$a."', '".$b."', '".$c."') ";

	if (executa_query($query) == 1) {
		echo "sucesso";
	}else{
		echo "Erro";
	}
}

?>
<h1>IP's bloqueados <sup style="font-size:17px;" id="total">20</sup></h1>
<form class="adicionar" name="adicionar" method="post">
	<input type="text" name="titulo" placeholder="Titulo" maxlength="100">
	<input type="text" onkeyup="ant_xfs(this);" required  name="ip" id="ip" placeholder="IP" maxlength="50">
	<textarea name="descricao" placeholder="Descrição" maxlength="200"></textarea>
	<button onclick="return validar2();">+</button>
</form>
<div style="padding: 10px 0px;">Será bloqueado o usuario que o ip começar com o inserido</div>


<?php 

$ler = ler_db("block", " ");
if (!empty($ler)) {
	$i = 0;
foreach ($ler as $lers) {
	$i++;
	echo  "<div class='log'>
		  	<b style=color:green>Nome:</b> ".$lers['nome']."
		  	<b style=color:green>IP:</b> ".$lers['ip']."

		  	<span class='dell' name='dell'>
		  		<a href='/admin/?p=db.php&query=DELETE FROM block WHERE id = ".$lers['id']."' target='_blank'>x</a>
		  	</span>
		  	<div class='mensagem'>
				".$lers['descricao']."
			</div>
		   </div>";
	} 
}

?>

<style type="text/css">
.adicionar{margin-top: 20px;}
.adicionar input,.adicionar button,.adicionar textarea{
	display: block;width: 320px;margin:5px 0px;
}
.log{
	position: relative;
	border: 1px solid black;
	padding: 1px 3px;
	cursor: pointer;}
.log span{display:inline;float: right;position: absolute;right: 0;}
.log span a{padding: 1px 4px;border:none;background:transparent;}
.log span a:hover{border:1px solid red;}
.log:hover,.log:active{background: #f1f1f1;}
.log:active .mensagem{display: block;}
.log .mensagem{
	z-index: 1;
	display: none;
	position: absolute;
	top: 100%;
	left:0%;right: 0%;
	color:#ccc;
	padding: 4px 3px;
	background: #333;}
</style>
<script type="text/javascript">
function ant_xfs(id){
	str = id.value.replace(/ |>/g, '');
	id.value = str;
}
edita_texto('total','<?php echo $i; ?>')

function validar2(){
		var ip = adicionar.ip.value;
		if (ip.length   < 7 || ip.length   > 50) {
			adicionar.ip.focus();
			return false;
		}
	}
</script>