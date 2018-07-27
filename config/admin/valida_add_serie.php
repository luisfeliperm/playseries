<?php
include_once($_SERVER['DOCUMENT_ROOT']."/config/config.php");
if ($admin == 0) {
	exit();
}
$valor = @anti_injection($_POST['valor_id']) ?? NULL;
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
	$query = "SELECT * FROM eps WHERE identificador = '".@anti_injection($_POST['id'])."' AND temporada = '".@anti_injection($_POST['season'])."' AND ep = '".@anti_injection($_POST['ep'])."' ";
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
				cat4          = '".$post['cat4']."' 
				WHERE id      = ".$id_real." LIMIT 1  ";



			executa_query($query);
			echo "update";exit();
		}else{
			echo "erro2";exit();
		}
		
	}
	if (empty($post['id']) || empty($post['nome']) || empty($post['backg']) || empty($post['minia']) || empty($post['ano']) || empty($post['min']) || empty($post['qualy'])) {
		echo "erro3";exit();
	}
	

	$query = "INSERT INTO series (identificador,nome,info, sinopse, miniatura, background, tags, cat1, cat2, cat3,cat4) VALUES ('".$post['id']."', '".$post['nome']."', '".$info."', '".$post['sinopse']."', '".$post['backg']."', '".$post['minia']."', '".$post['tag']."', '".$post['cat1']."', '".$post['cat2']."', '".$post['cat3']."', '".$post['cat4']."') ";

	if (executa_query($query) == 1) {// Sucesso
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
		echo "O episódio já existe !";exit();
	}



	$query = "INSERT INTO eps (identificador,temporada,ep, sinopse, miniatura, background, tags, cat1, cat2, cat3,cat4) VALUES ('".$post['id']."', '".$post['nome']."', '".$info."', '".$post['sinopse']."', '".$post['backg']."', '".$post['minia']."', '".$post['tag']."', '".$post['cat1']."', '".$post['cat2']."', '".$post['cat3']."', '".$post['cat4']."') ";

	if (executa_query($query) == 1) {// Sucesso
		echo "sucesso";
	}else{
		echo "erro3";
	}
	echo "1";

}