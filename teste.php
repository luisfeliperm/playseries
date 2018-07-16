<?php
include_once($_SERVER['DOCUMENT_ROOT']."/config.php");


$total_exib = "10"; // número de registros por página

$pagina = anti_injection(intval($_GET['p']));
if (!isset($pagina) || $pagina < 1) {
	$pag_n = "1";
} else {
	$pag_n = $pagina;
}

$inicio = $pag_n - 1;
$inicio = $inicio * $total_exib;


$ler_ep = ler_db("teste", " LIMIT ".$inicio.",".$total_exib."");
foreach ($ler_ep as $ep_array) {
 	$dados_ep = array('id' => $ep_array['id']);
 	echo $dados_ep['id']."<br>";
}




$tr = mysqli_num_rows(executa_query('SELECT * FROM teste;')); // verifica o número total de registros
$tp = $tr / $total_exib; // verifica o número total de páginas


$anterior = $pag_n -1;
$proximo = $pag_n +1;
if ($pag_n>1) {
	echo " <a href='?p=$anterior'><- Anterior</a> ";
}
echo "|";
if ($pag_n<$tp) {
	echo " <a href='?p=$proximo'>Próxima -></a>";
}


