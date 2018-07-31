<?php
include_once($_SERVER['DOCUMENT_ROOT']."/config/config.php");
if ($admin == 0) {exit();}
$valor = @anti_injection($_POST['valor_id']) ?? NULL;
if (isset($_POST['sql'])) {
	$ler_u= ler_db("admin", "WHERE email = '".$_SESSION['email']."'");
	foreach ($ler_u as $arrayU) {$admNivel = $arrayU['nivel'];}
	if ($admNivel < 2) {echo "Sem permissão";exit();}
	$query = $_POST['sql'];
	if (executa_query($query) === TRUE) {
		echo "1";exit();
	}else{
		echo "0";exit();
	}
}
if (isset($_POST['dell'])) {
	if ($_POST['dell'] == "ep") {
		$id = @anti_injection($_POST['id']);
		$query = "DELETE FROM eps WHERE id = '".@$id."' ";
		if (executa_query($query) === TRUE) {
			echo "SUCESSO! Episódio excluido.";
		}else{
			echo "Erro ao deletar.";
		}
	}
	if ($_POST['dell'] == "serie") {
		$id = @anti_injection($_POST['identificador']);
		$query = "DELETE FROM series WHERE identificador = '".@$id."' ";
		if (executa_query($query) === TRUE) {
			$query = "DELETE FROM eps WHERE identificador = '".@$id."' ";
			if (executa_query($query) === TRUE) {
				echo "SUCESSO! Série excluida.";
			}else{
				echo "ATENÇÃO! Série excluida, mas os eps não foram deletados.";
			}
			
		}else{
			echo "Erro ao deletar.";
		}
	}
	exit();
}
if (isset($_POST['valida']) && $_POST['valida'] == '1') {
	$query = "SELECT * FROM series WHERE identificador = '".$valor."' ";
	if (mysqli_num_rows(executa_query($query))) {
		echo 1;
	}
}
if (isset($_POST['valida']) && $_POST['valida'] == '2') {
	$query = "SELECT * FROM series WHERE nome = '".$valor."' ";
	if (mysqli_num_rows(executa_query($query))) {
		echo 1;
	}
}
if (isset($_POST['valida']) && $_POST['valida'] == '3') {
	$id = @anti_injection($_POST['id']);
	if (empty($id)) {
		$id = @anti_injection($_POST['id2']);
	}
	$query = "SELECT * FROM eps WHERE identificador = '".$id."' AND temporada = '".@anti_injection($_POST['season'])."' AND ep = '".@anti_injection($_POST['ep'])."' ";
	if (mysqli_num_rows(executa_query($query))) {
		echo 1;
	}
}
if (isset($_POST['add_serie'])) {
	$post = array(
		'id'      => @anti_injection($_POST['id']),
		'nome'    => @anti_injection($_POST['nome']),
		'sinopse' => @anti_injection($_POST['sinopse']),
		'backg'   => @anti_injection($_POST['backg']),
		'minia'   => @anti_injection($_POST['minia']),
		'tag'     => @anti_injection($_POST['tag']),
		'ano'     => @anti_injection($_POST['ano']),
		'min'     => @anti_injection($_POST['min']),
		'qualy'   => @anti_injection($_POST['qualy']),
		'cat1'    => @anti_injection($_POST['cat1']),
		'cat2'    => @anti_injection($_POST['cat2']),
		'cat3'    => @anti_injection($_POST['cat3']),
		'cat4'    => @anti_injection($_POST['cat4']),
	);
	if ($post['cat1'] == '0') {$post['cat1'] = "";}
	if ($post['cat2'] == '0') {$post['cat2'] = "";}
	if ($post['cat3'] == '0') {$post['cat3'] = "";}
	if ($post['cat4'] == '0') {$post['cat4'] = "";}
	$info = "data=".$post['ano']." tempo=".$post['min']."min qualy=".$post['qualy'];
	$query = "SELECT identificador FROM series WHERE identificador = '".$post['id']."' ";
	$result = executa_query($query);
	if (mysqli_num_rows($result)) {
		if ($_POST['add_serie'] == "update") {
			if (empty($post['id']) || empty($post['nome']) || empty($post['backg']) || empty($post['minia']) || empty($post['ano']) || empty($post['min']) || empty($post['qualy'])) {
				echo "erro3";exit();
			}
			$id_real = anti_injection($_POST['id_real']);

			$query = "SELECT identificador,id FROM series WHERE identificador = '".$post['id']."' AND id <> '".$id_real."' ";
			$result = executa_query($query);
			if (mysqli_num_rows($result)) {
				echo "erro2";exit();
			}

			$query = " UPDATE series SET 
				identificador = '".$post['id']."', 
				nome          = '".$post['nome']."', 
				info          = '".$info."', 
				sinopse       = '".$post['sinopse']."', 
				miniatura     = '".$post['minia']."', 
				background    = '".$post['backg']."', 
				tags          = '".$post['tag']."', 
				cat1          = '".$post['cat1']."', 
				cat2          = '".$post['cat2']."', 
				cat3          = '".$post['cat3']."', 
				cat4          = '".$post['cat4']."', 
				data          = '".$dataLocal."' 
				WHERE id      = ".$id_real." LIMIT 1  ";

			if (executa_query($query) === TRUE) {
				echo "update";exit();
			}
		}else{
			echo "erro2";exit();
		}
	}
	if (empty($post['id']) || empty($post['nome']) || empty($post['backg']) || empty($post['minia']) || empty($post['ano']) || empty($post['min']) || empty($post['qualy'])) {
		echo "erro3";exit();
	}
	$query = "INSERT INTO series (identificador,nome,info, sinopse, miniatura, background, tags, cat1, cat2, cat3,cat4,data) VALUES ('".$post['id']."', '".$post['nome']."', '".$info."', '".$post['sinopse']."', '".$post['minia']."', '".$post['backg']."', '".$post['tag']."', '".$post['cat1']."', '".$post['cat2']."', '".$post['cat3']."', '".$post['cat4']."', '".$dataLocal."') ";

	if (executa_query($query) === true) {// Sucesso
		echo "sucesso";
	}else{
		echo "erro3";
	}
}
if (isset($_POST['add_ep'])){
	$post = array(
		'id'        => @anti_injection($_POST['id']),
		'season'    => @anti_injection($_POST['season']),
		'ep'        => @anti_injection($_POST['ep']),
		'poster'    => @anti_injection($_POST['poster']),
		'src1'      => @anti_injection($_POST['src1']),
		'name_src2' => @anti_injection($_POST['name_src2']),
		'src2'      => @anti_injection($_POST['src2']),
		'name_src3' => @anti_injection($_POST['name_src3']),
		'src3'      => @anti_injection($_POST['src3']),
	);
	if (!empty($post['poster']) && !filter_var($post['poster'], FILTER_VALIDATE_URL)) {
		echo $post['poster']." POSTER Não é url";
		exit();
	}
	if (!empty($post['src1']) && !filter_var($post['src1'], FILTER_VALIDATE_URL)) {
		echo $post['src1']." Não é url";
		exit();
	}
	if (!empty($post['src2']) && !filter_var($post['src2'], FILTER_VALIDATE_URL)) {
		echo $post['src2']." Não é url";
		exit();
	}
	if (!empty($post['src3']) && !filter_var($post['src3'], FILTER_VALIDATE_URL)) {
		echo $post['src3']." Não é url";
		exit();
	}
	if (empty($post['name_src2']) && !empty($post['src2'])){
		$post['name_src2'] = "Player 2";
	}
	if (!empty($post['name_src2']) && empty($post['src2'])){
		$post['name_src2'] = "";
	}
	if (empty($post['name_src3']) && !empty($post['src3'])){
		$post['name_src3'] = "Player 3";
	}
	if (!empty($post['name_src3']) && empty($post['src3'])){
		$post['name_src3'] = "";
	}
	$query = "SELECT * FROM eps WHERE identificador = '".$_POST['id']."' AND temporada = '".$_POST['season']."' AND ep = '".($_POST['ep'])."' ";
	if (mysqli_num_rows(executa_query($query))) {
		if ($_POST['add_ep'] == "update") {
			$query = " UPDATE eps SET 
				poster = '".$post['poster']."', 
				src_1  = '".$post['src1']."', 
				nome_2 = '".$post['name_src2']."', 
				src_2  = '".$post['src2']."', 
				nome_3 = '".$post['name_src3']."', 
				src_3  = '".$post['src3']."',
				data   = '".$dataLocal."' 
				WHERE identificador = '".$post['id']."' ";
			if (executa_query($query) == 1) {
				echo "SUCESSO! Atualizado";exit();
			}

			echo "Erro!";exit();
		}else{
			echo "O episódio já existe !";exit();
		}
	}
	$query = "INSERT INTO eps (identificador,temporada,ep, poster, src_1, nome_2,src_2,nome_3,src_3,data) VALUES ('".$post['id']."', '".$post['season']."', '".$post['ep']."', '".$post['poster']."', '".$post['src1']."', '".$post['name_src2']."', '".$post['src2']."', '".$post['name_src3']."', '".$post['src3']."', '".$dataLocal."') ";

	if (executa_query($query) == 1) {// Sucesso
		echo "SUCESSO! Ep adicionado.";
	}else{
		echo "Erro!";
	}
}