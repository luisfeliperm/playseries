<?php 
$ler = ler_db("views");
if (!empty($ler)) {
	foreach ($ler as $lers) {$total = intval($lers['total']);}
	if (!isset($_COOKIE['faj3kl24j']) && $_SERVER['REMOTE_ADDR'] != "168.227.88.30") {
		// insere na DB
		$query = "UPDATE views SET total = '".($total+ 1)."' ";
		if (executa_query($query) == 1) {// Sucesso
			setcookie("faj3kl24j", ($total+ 1), time()+3600*24*30*12*5, "/");
		}
	}
}else{
	$query = "INSERT INTO views (total) VALUES ('1') ";
	@executa_query($query);
}
?>