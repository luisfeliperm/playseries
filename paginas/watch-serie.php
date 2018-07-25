<?php
// Verifica se existe
$ler_ep = ler_db("series", "WHERE identificador = '".$url_serie."' ");
if (empty($ler_ep)) { // O link não existe
	echo "<div class='notfound'>Não encontrado</div>";exit();
}
foreach ($ler_ep as $ep_array) {
 	$dados_ep = array('nome' => $ep_array['nome'], 'info' => $ep_array['info'],'sinopse' => $ep_array['sinopse'] ,'miniatura' => $ep_array['miniatura'],'background' =>  $ep_array['background'],'tags' => $ep_array['tags'], 'viwer' => $ep_array['viwer'] );
}
$dados_ep['info'] = str_replace(' ','&',$dados_ep['info']);
$dados_ep['info'] = str_replace('_',' ',$dados_ep['info']);
parse_str($dados_ep['info'], $info_ep);
$viwer = $dados_ep['viwer'] + 1;
$query = "UPDATE series SET viwer = '".$viwer."' WHERE identificador = '".$url_serie."'  ";
@executa_query($query);
?>
<div class="watch_section width-90">
	<div class="thumb">
		<div class="w_nome"><?php echo $dados_ep['nome']; ?></div>
		<span class="qualy"><?php echo $info_ep['qualy'];?></span>
	</div>
	<div class="assistir">
		<?php 
		if (isset($_GET['s']) && !empty($_GET['s']) && $_GET['s'] > 0) {
			$season = anti_injection(intval($_GET['s']));
		}else{
			$season = 1;
		}
		if (isset($_GET['e']) && !empty($_GET['e']) && $_GET['e'] > 0) {
			$ep = anti_injection(intval($_GET['e']));
		}else{
			$ep = 1;
		}
		?>
		<style>
		.seasson {display:block;}
		.optionep{display: none;}
		</style>
		<div class="w_eps">
			<select class="w_input" onchange="alter_temp();" id="temp_select">
				<?php 
				// Lista temporadas
				$ler_temp = ler_db("eps", "WHERE identificador = '".$url_serie."' ORDER BY temporada ASC ", "DISTINCT temporada");
				if (empty($ler_temp)) {
					echo "<option>Sem temporada</option>";
				}else{
					foreach ($ler_temp as $temp_array) {
						?>
						<option <?php if(@$_GET['s']== $temp_array['temporada']){echo "selected";} ?> value="<?php echo $temp_array['temporada']; ?>"> <?php echo $temp_array['temporada']; ?>º Temporada</option>
						<?php
					}
				}
				?>
			</select>
			
			<select class="w_input" id="ep_select">
				<?php
				// Lista eps
				$ler_temp = ler_db("eps", "WHERE identificador = '".$url_serie."' ORDER BY temporada ASC ");
				if (empty($ler_temp)) {
					echo "<option>00</option>";
				}else{
					foreach ($ler_temp as $temp_array) {
					 	$list_ep = array('ep' => $temp_array['ep'],'s' => $temp_array['temporada'] );
						?>
						<option id="<?php echo 's'.$list_ep['s'].'e'.$list_ep['ep']; ?>" class="optionep s<?php echo $list_ep['s']; ?>" <?php if($season == $list_ep['s'] AND $ep == $list_ep['ep']){echo "selected";} ?> value="<?php echo $list_ep['ep']; ?>">EP <?php echo $list_ep['ep']; ?></option>
						<?php
					}
				}
				?>
			</select>
			<!-- EXIBE eps DA TEMPORADA selecionada -->
			<style>
				select .optionep.s<?php echo $season; ?>{
					display: block;
				}
			</style>
			<button class="w_input" onclick="troca();"><i class="fas fa-chevron-right"></i></button>
		</div>

		<div class="players_alt">
			<a href="javascript:void(0)" onclick="display_edit('report', 'block');" class="bug">Erro?</a>

			<span class='n_found' style="display: none;padding:2.5px;font-size: 18px;float: right;margin-left: 5px;"><i style="color:yellow;" class='fas fa-exclamation-triangle'></i> Ep não encontrado</span>

			<?php
			$get_play=@$_GET['player'];
			if ($get_play < 1) {
				$get_play = 1;
			}
			// Lista PLAYERS
			$ler_players = ler_db("eps", "WHERE identificador = '".$url_serie."' AND temporada = '".$season."' AND ep = '".$ep."'  ");
			if (!empty($ler_players)) {
				foreach ($ler_players as $play_array) {
				 	$list_play = array('1_src' => $play_array['src_1'],'nome_2' => $play_array['nome_2'], 'src_2' => $play_array['src_2'],'nome_3' => $play_array['nome_3'], '3_src' => $play_array['src_3'],'poster' => $play_array['poster']);

				 	if (!empty($list_play['nome_3'])) {
				 		if ($get_play == 3) {
				 			echo "<a href='?s=".$season."&e=".$ep."&player=3' class='active'>".$list_play['nome_3']."</a>";
				 		}else{
				 			echo "<a href='?s=".$season."&e=".$ep."&player=3'>".$list_play['nome_3']."</a>";
				 		}
				 	}
				 	if (!empty($list_play['nome_2'])) {
				 		if ($get_play == 2) {
				 			echo "<a href='?s=".$season."&e=".$ep."&player=2' class='active'>".$list_play['nome_2']."</a>";
				 		}else{
				 			echo "<a href='?s=".$season."&e=".$ep."&player=2'>".$list_play['nome_2']."</a>";
				 		}
				 	}
				 	if (!empty($list_play['1_src'])) {
				 		if ($get_play == 1 || !isset($_GET['player']) || empty($get_play)) {
					 		echo "<a href='?s=".$season."&e=".$ep."&player=1' class='active'>Principal</a>";
					 	}else{
					 		echo "<a href='?s=".$season."&e=".$ep."&player=1'>Principal</a>";
					 	}
				 	}
				}
			}else{
				echo "<style>.players_alt .n_found{display:block !important;}</style>";
			}
			?>
		</div>
		<?php 
		if ($get_play != "1") {
			
			?>
			<div class="diframePlay">
				<iframe class="iframePlay" src="<?php echo $play_array['src_'.$get_play];?>"></iframe>
			</div>
			<?php 
		}else{
			?>
			<div class="video">
				<video class="vjs-tech vsc-initialized" preload="none" poster="<?php echo @$list_play['poster']; ?>" controls="" >
					<source src="<?php echo @$list_play['1_src']; ?>" type="video/mp4">
				</video>
			</div>
			<?php 
		}
		?>
		
		<div class="controles">
			<?php
			if ($ep == 1) {
				echo "<a href='javascript:void(0);'  style='float:left;opacity:0.4;cursor:default;'>Voltar</a>";
			}else{
				echo "<a href='?s=".$season."&e=".($ep - 1)."'  style='float:left;'>Voltar</a>";
			} 

			$query = "SELECT * FROM eps WHERE identificador = '".$url_serie."' AND temporada = '".$season."' AND ep = '".($ep+1)."' ";
			if (!mysqli_num_rows(executa_query($query))) {
				echo "<a href='javascript:void(0);'  style='float:right;opacity:0.4;cursor:default;'>Proximo</a>";
			}else{
				echo "<a href='?s=".$season."&e=".($ep + 1)."' style='float:right;'>Proximo</a>";
			}
			?>

		</div>
	</div>
</div>
<div class="report" id="report">
	<form>
		<a href="javascript:void(0)" onclick="display_edit('report', 'none');"><i class="fas fa-times"></i></a>
		<label>Descreva o erro</label>
		<textarea id="report_msg"></textarea>
		<button onclick="return enviar();">Reportar</button>
	</form>
	<div id="resultado" style="text-align: center;"></div>
</div>
<style>
	.watch_section.width-90{margin-bottom: 35px;    margin-top: 12px;}
	.thumb{
		background-image: url(<?php echo $dados_ep['background']; ?>);
		width: 100%;height: 280px;
	    background-color: #000;
	    background-position: 10% 15%;
	    background-size: cover;
	    position: relative;
	    border-bottom: solid 1px #000;
	}
	.w_nome{
		font-size: 30px;
	    color: #a97272;    background: rgba(27, 27, 27, 0.7);
	    font-weight: 300;
	    text-shadow: 0px 1px 5px #000;
	    padding: 15px 2%;
	    position: absolute;top: 0;left: 0;
	    text-overflow: ellipsis;white-space: nowrap;overflow: hidden;
	    width: 100%;z-index: 1;
	}
	.thumb span.qualy {
	    position: absolute;bottom: 0;right: 0;
	    background-color: rgba(0, 0, 0, 0.5);
	    padding: 4px 10px;color: rgba(255, 255, 255, 0.7);
	}
	.assistir{background: rgba(16, 0, 0, 0.75);overflow: auto;}
	.assistir .w_eps{
		padding: 8px;border-bottom:1px solid #000;
		box-shadow: 0px 1px 0px 0px rgba(100,0,0,0.2);
	}
	.assistir .w_eps .w_input{
		padding: 8px;font-size: 14px;border:none;margin:0;
		background: transparent;color:#fff;outline:0;
	}
	.assistir .w_eps select option{background: #130000;color: #fff;padding: 8px;outline:0;}
	.assistir .w_eps button.w_input{cursor:pointer;transition: transform 0.3s;}
	.assistir .w_eps button.w_input:hover{
		-ms-transform: translate(4px, 0px); /* IE 9 */
    	-webkit-transform: translate(4px, 0px); /* Safari */
	    transform: translate(4px, 0px);
	}
	/* PLAYERS */
	.assistir .players_alt{width: 90%;margin:10px auto;overflow:auto;}
	.assistir .players_alt a:not(.bug){
		opacity: 0.3;border:1px solid #fff;padding:5px;font-size: 14px;float: right;
		margin-left: 5px;
	}
	.assistir .players_alt a.bug{opacity: 0.3;border:1px solid #fff;padding:5px;font-size: 14px;float: left;}
	.assistir .players_alt a:hover{opacity: 0.5;}
	.assistir .players_alt a.active{opacity: 0.1;cursor: default;}
	.assistir .video,.assistir .diframePlay{margin: 10px auto;display: block;width: 90%;}
	.assistir .video video{width: 100%;;margin:0;box-shadow: 0px 0px 2px rgba(0,0,0,0.7);}
	.assistir .diframePlay iframe.iframePlay{width: 100%;margin:0;box-shadow: 0px 0px 2px rgba(0,0,0,0.7);border:1px solid #211b1b;}
	@media screen and (min-width: 670px) {
		.assistir .diframePlay iframe.iframePlay{height: 400px;}
	}
	@media screen and (min-width: 400px) and (max-width: 669px) {
		.assistir .diframePlay iframe.iframePlay{height: 250px;}
	}
	@media screen and (max-width: 399px) {
		.assistir .diframePlay iframe.iframePlay{height: 200px;}
	}
	.assistir .controles{width: 90%;margin:5px auto;}
	.assistir .controles a{padding: 8px;border: 1px solid #fff;margin: 0px 0px 10px;}
	.assistir .controles a:hover{opacity: 0.5;}
	.report{
		height: 100%;
	    width: 100%;
	    display: none;
	    position: fixed;
	    z-index: 1;
	    top: 0;
	    left: 0;
	    background-color: rgb(0,0,0);
	    background-color: rgba(0,0,0, 0.5);
	}
	.report form{
		border:1px solid #111;
		margin:10px auto;padding: 10px;
		display:block;
		width: 95%;
		max-width: 350px;
		position: relative;
		background: #fff;color:#111;
		box-shadow: 0px 0px 3px rgba(0,0,0,0.5);
	}
	.report form a{position: absolute;top:2px;right: 10px;color:#333;}
	.report form label{margin: 0%;display: block;font-size: 20px;}
	.report form textarea{
		width: 100%;display: block;margin:4px auto;
		height: 100px;font-size: 15px;text-indent:10px;
	}
	.report form button{margin: 0%;display: block;font-size: 16px;}
</style>
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script>
	function alter_temp(){
		var temporada =document.getElementById('temp_select').value;
		$(".optionep").css("display", "none");
		$(".s"+temporada).css("display", "block");

		document.getElementById("s"+temporada+"e1").selected = "true";
	}
	function troca(){
		var temporada =document.getElementById('temp_select').value;
		var ep =document.getElementById('ep_select').value;
		window.location.href="./?s="+temporada+"&e="+ep;
	}

	function enviar(){
		var msg = document.getElementById("report_msg").value;
		var url =  window.location.href;
		$.post('/config/report.php',{msg: msg, url: url},function(data){
		 //mostrando o retorno do post		
		 if (data == 1 || data == 0) {
		 	display_edit('report', 'none');
		 }
		})
		return false;
	}
</script>