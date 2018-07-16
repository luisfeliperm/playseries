<?php
$url_serie = anti_injection($_GET['url_serie']);
// Verifica se existe
$ler_ep = ler_db("series", "WHERE nome = '".$url_serie."' ");
if (empty($ler_ep)) { // O link não existe
	echo "<div class='notfound'>Não encontrado</div>";exit();
}
foreach ($ler_ep as $ep_array) {
 	$dados_ep = array('titulo' => $ep_array['titulo'], 'info' => $ep_array['info'],'sinopse' => $ep_array['sinopse'] ,'miniatura' => $ep_array['miniatura'],'background' =>  $ep_array['background'],'tags' => $ep_array['tags'] );
}
$dados_ep['info'] = str_replace(' ','&',$dados_ep['info']);
$dados_ep['info'] = str_replace('_',' ',$dados_ep['info']);
parse_str($dados_ep['info'], $info_ep);
?>
<div class="watch_section width-90">
	<div class="thumb">
		<div class="w_titulo"><?php echo $dados_ep['titulo']; ?></div>
		<span class="qualy"><?php echo $info_ep['qualy'];?></span>
	</div>
	<div class="assistir">
		<div class="w_eps">
			<select class="w_input">
				<option>1º Temporada</option>
				<option>2º Temporada</option>
			</select>
			<select class="w_input">
				<option>EP 1</option>
				<option>1</option>
				<option>1</option>
				<option>1</option>
			</select>
			<button class="w_input"><i class="fas fa-chevron-right"></i></button>
		</div>
		<div class="players_alt">
			<a href="#" class="bug">Erro?</a>
			<a href="#" class="active">Principal</a>
		</div>
		<div class="video">
			<video class="vjs-tech vsc-initialized" preload="none" poster="http://digitalspyuk.cdnds.net/16/07/980x490/landscape-1455811108-ustv-the-walking-dead-s06e10-still-01.jpg" controls="" >
				<source src="https://pgli3j.oloadcdn.net/dl/l/wX3dLAdDW1E4RpIp/DAPU607OeWE/S3R13.Pr1s0n.Br34k+S01+x+E01+-+Dub.mp4" type="video/mp4">
			</video>
		</div>
		<div class="controles">
			<a href="#" style="float:left;">Voltar</a>
			<a href="#" style="float:right;">Proximo</a>
		</div>
	</div>
</div>
<style>
	.watch_section{margin-bottom: 35px;}
	.thumb{
		#background-image: url(https://image.tmdb.org/t/p/w780/mkmB5hAJFb0xnOhu8cLRJqX3ZAQ.jpg);
		background-image: url(<?php echo $dados_ep['background']; ?>);
		width: 100%;
	    height: 280px;
	    background-color: #000;
	    background-position: 10% 15%;
	    background-size: cover;
	    position: relative;
	    border-bottom: solid 1px #000;
	}
	.w_titulo{
		font-size: 30px;
	    color: #a97272;    background: rgba(27, 27, 27, 0.7);
	    font-weight: 300;
	    text-shadow: 0px 1px 5px #000;
	    padding: 15px 2%;
	    position: absolute;
	    top: 0;
	    left: 0;
	    text-overflow: ellipsis;
	    white-space: nowrap;
	    overflow: hidden;
	    width: 100%;
	    z-index: 1;
	}
	.thumb span.qualy {
	    position: absolute;
	    bottom: 0;
	    right: 0;
	    background-color: rgba(0, 0, 0, 0.5);
	    padding: 4px 10px;
	    color: rgba(255, 255, 255, 0.7);
	}
	.assistir{
		background: rgba(16, 0, 0, 0.75);overflow: auto;
	}
	.assistir .w_eps{
		padding: 8px;
		border-bottom:1px solid #000;
		box-shadow: 0px 1px 3px red;
		box-shadow: 0px 1px 0px 0px rgba(100,0,0,0.2);
	}
	.assistir .w_eps .w_input{
		padding: 8px;font-size: 14px;
		border:none;margin:0;
		background: transparent;color:#fff;outline:0;
	}
	.assistir .w_eps select option{
		background: #130000;color: #fff;
		padding: 8px;outline:0;
	}
	.assistir .w_eps button.w_input{cursor:pointer;transition: transform 0.3s;}
	.assistir .w_eps button.w_input:hover{
		-ms-transform: translate(4px, 0px); /* IE 9 */
    	-webkit-transform: translate(4px, 0px); /* Safari */
	    transform: translate(4px, 0px);
	}
	/* PLAYERS */
	.assistir .players_alt{
		width: 90%;margin:10px auto;overflow:auto;
	}
	.assistir .players_alt a:not(.bug){
		opacity: 0.3;border:1px solid #fff;padding:5px;font-size: 14px;float: right;
		margin-left: 5px;
	}
	.assistir .players_alt a.bug{
		opacity: 0.3;border:1px solid #fff;padding:5px;font-size: 14px;float: left;
	}
	.assistir .players_alt a:hover{
		opacity: 0.5;
	}
	.assistir .players_alt a.active{
		opacity: 0.1;cursor: default;
	}

	.assistir .video{
		margin: 10px auto;
		display: block;width: 90%;
	}
	.assistir .video video{
		width: 100%;margin:0;box-shadow: 0px 0px 2px rgba(0,0,0,0.7);
	}
	.assistir .controles{
		width: 90%;margin:5px auto;
	}
	.assistir .controles a{
		padding: 8px;border: 1px solid #fff;margin: 0px 0px 10px;
	}
	.assistir .controles a:hover{
		--background:rgba(255,255,255,0.4);
		opacity: 0.5;
	}
</style>