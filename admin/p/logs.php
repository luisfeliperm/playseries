
<div style="margin-top:5px;color:green;font-size: 20px;text-align:center;">DELETE FROM bot WHERE id IN ( '80', '80')</div>
<?php 
if (isset($_GET['info'])) {
	$ler = ler_db("logs", " WHERE id = '".anti_injection($_GET['info'])."' ");
	foreach ($ler as $lers) {
		echo "
			<div class='kjk3'>
			<b>ID </b>".$lers['id']."<br>
			<b>Data </b>".$lers['data']."<br>
			<b>url </b>".$lers['url']."<br>
			<b>ip </b>".$lers['ip']."<br>
			<b>dispositivo </b>".$lers['dispositivo']."<br>
			<b>User Agent </b>".$lers['http_user_agent']."<br>
			<b>local </b>".$lers['local']." <br>
		";

	}
}else{
	$ler = ler_db("logs", " ");
	foreach ($ler as $lers) {
	echo  "<div class='log'>
		  	<b style=color:green>ID:</b> ".$lers['id']."
		  	<b style=color:green>IP:</b> ".$lers['ip']."
		  	<b style=color:green>DATA:</b> ".$lers['data']."
		  	<a href='/admin/?p=logs.php&info=".$lers['id']."' style='color:red;padding:0px 15px;' > ? </a>
		   </div>";
	}
}
?>
<style type="text/css">
.kjk3 b{
	color:green;
}
.kjk3 span{
	color:blue;font-weight:bold;
}
.log{padding: 1px;margin:2px;border: 1px solid #444;}
</style>
