<!-- luisfeliperm -->
<?php
include_once($_SERVER['DOCUMENT_ROOT']."/config/config.php");
include_once($_SERVER['DOCUMENT_ROOT']."/config/visualizacoes.php");
?>
<!DOCTYPE html>
<html>
<head lang="pt-br">
	<!-- SEO -->
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta property="og:locale" content="pt_BR">
	<meta property="og:type" content="website"/>
	<meta property="og:site_name" content="Xploitvid">
	<meta http-equiv="content-language" content="pt-br">
	<?php 
	/**** SEO **/
	if (!empty($url_serie)) {
		if (isset($_GET['player'])) {echo "<meta name='robots' content='noindex,follow'>";}
		$seo_ler_serie = ler_db("series", "WHERE identificador = '".$url_serie."' ");
		if (!empty($seo_ler_serie)) { // O link existe
			foreach ($seo_ler_serie as $ep_array) {

			 	$dados_ep = array('nome' => $ep_array['nome'], 'info' => $ep_array['info'],'sinopse' => $ep_array['sinopse'] ,'miniatura' => $ep_array['miniatura'],'background' =>  $ep_array['background'],'tags' => $ep_array['tags'], 'viwer' => $ep_array['viwer'],'data' => $ep_array['data'] );
			}
			$dados_ep['info'] = str_replace(' ','&',$dados_ep['info']);
			$dados_ep['info'] = str_replace('_',' ',$dados_ep['info']);
			parse_str($dados_ep['info'], $info_ep);

			if (isset($_GET['s']) && !empty($_GET['s']) && $_GET['s'] > 0 && isset($_GET['e']) && !empty($_GET['e']) && $_GET['e'] > 0) {
				$season = anti_injection(intval($_GET['s']));
				$ep = anti_injection(intval($_GET['e']));
				$query = "SELECT * FROM eps WHERE identificador = '".$url_serie."' AND temporada = '".$season."' AND ep = '".$ep."' ";
				if (mysqli_num_rows(executa_query($query))) {
					// O EP EXISTE
					$titulo_meta = $dados_ep['nome']." ".$season." Temporada Episódio ".$ep." dublado ".$info_ep['qualy'];
					?>
					<title>Assistir <?php echo $titulo_meta?></title>
					<meta property="og:title" content="Assista <?php echo $titulo_meta;?>" />
					<meta name="twitter:title" content="Assista <?php echo $titulo_meta; ?>">
					<meta name="description" content="Assistir <?php echo $titulo_meta;?> online dublado hd 720p de graça, sem anuncios. Assista series livre de anuncios.">
					<meta property="og:description" content="Assistir <?php echo $titulo_meta;?>"/>
					<meta name="twitter:description" content="Assistir <?php echo $titulo_meta;?>">
					<meta property="og:image" content="<?php echo $dados_ep['background']; ?>"/>
					<meta name="twitter:image" content="<?php echo $dados_ep['background']; ?>">
					<meta name="Keywords" content="<?php echo $dados_ep['tags'];?>,hd,dublado,assistir,sem anuncios,playseries,temporada,ep">
					<meta property="article:section" content="<?php echo $dados_ep['nome'];?>"/>
					<?php $meta_url =  "http://".$_SERVER['SERVER_NAME']."/".$url_serie."/?s=".$season."&e=".$ep; ?>
					<meta property="og:url" content="<?php echo $meta_url;?>">
					<?php
					// Dados do EP em si 
					$seo_ep = ler_db("eps", "WHERE identificador = '".$url_serie."' AND temporada = '".$season."' AND ep = '".$ep."'  ");
					if (!empty($seo_ep)) {
						foreach ($seo_ep as $play_array) {
							$list_play = array('data' => $play_array['data']);
							echo "<meta name='date' content='". date('Y-m-d\TH:i:s',  strtotime($list_play['data']))."'>";
						}
					}else{
						?><meta name='date' content="<?php echo date('Y-m-d\TH:i:s',  strtotime($dados_ep['data']));?>"><?php 
					}
				}else{// O EP NÃO EXISTE
					echo "<title>Episódio não encontrado</title>";
				}
			}else{// Apenas info da serie, não do ep
				?>
				<title>Assistir <?php echo $dados_ep['nome'];?> dublado</title>
				<meta property="og:title" content="Assista <?php echo $dados_ep['nome'];?>" />
				<meta name="twitter:title" content="Assista <?php echo $dados_ep['nome']; ?>">
				<meta name="description" content="Assistir <?php echo $dados_ep['nome'];?> online dublado hd 720p de graça, sem anuncios. Assista series livre de anuncios.">
				<meta property="og:description" content="Assistir <?php echo $dados_ep['nome'];?>"/>
				<meta name="twitter:description" content="Assistir <?php echo $dados_ep['nome'];?>">
				<meta property="og:image" content="<?php echo $dados_ep['background']; ?>"/>
				<meta name="twitter:image" content="<?php echo $dados_ep['background']; ?>">
				<meta name="Keywords" content="<?php echo $dados_ep['tags'];?>,hd,dublado,assistir,sem anuncios,playseries,temporada,ep">
				<meta property="article:section" content="<?php echo $dados_ep['nome'];?>"/>
				<?php $meta_url =  "http://".$_SERVER['SERVER_NAME']."/".$url_serie."/";?>
				<meta property="og:url" content="<?php echo $meta_url;?>">
				<meta name='date' content="<?php echo date('Y-m-d\TH:i:s',  strtotime($dados_ep['data']));?>">
				<?php
			}
		}else{$epNExiste=TRUE; /* Link não existe */ echo "<title>Não encontrado</title>";}
	}else{ // padrão
		?>
		<title>PlaySeries</title>
		<meta property="og:title" content="PlaySeries" />
		<meta name="twitter:title" content="PlaySeries">
		<meta name="description" content="Assistir series e animes online dublado hd 720p de graça, sem anuncios. Assista series livre de anuncios.">
		<meta property="og:description" content="Assistir series e animes online dublado hd 720p de graça, sem anuncios. "/>
		<meta name="twitter:description" content="Assistir series e animes online dublado hd 720p de graça, sem anuncios. ">
		<meta property="og:image" content="/img/logo.png"/>
		<meta name="twitter:image" content="/img/logo.png">
		<meta name="Keywords" content="series,assistir,de graça,hd,720p,dublado,pirata,sem anuncios,site de filmes,online,playseries">
		<meta property="article:section" content="Home"/>
		<meta property="og:url" content="http://<?php echo $_SERVER['SERVER_NAME'] ?>/ ">
		<?php
	}
	?>
	<link rel="icon" type="image/png" href="/img/favicon.png" />
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="/css/layout.css">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<script src="/js/site.js"></script>
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.10/css/all.css" integrity="sha384-+d0P83n9kaQMCwj8F4RJB66tzIwOKmrdb46+porD/OvrJ+37WqIM7UoBtwHO6Nlg" crossorigin="anonymous">
</head>
<body>
<header>
	<div class="title_site">
		<figure><img src="/img/logo.png"></figure>
	</div>
	<div class="menu">
		<div class="show_menu"><a href="javascript:void(0)" onclick="display_edit('menu_mob', 'block');document.body.style.overflow = 'hidden';"><i class="fas fa-bars"></i></a></div>
		<nav id="nav_menu">
			<ul class="menu_desk">
				<li><a href="/">Inicio</a></li>
				<li><a href="/categoria/documentario/">Documentarios</a></li>
				<li><a href="/categoria/anime/">Animes</a></li>
				<li><a href="/categoria/mais-visitados/">Mais vistos</a></li>
			</ul>

			<ul class="menu_mob" id="menu_mob">
				<li id="close_menu"><a href="javascript:void(0)" onclick="display_edit('menu_mob', 'none');document.body.style.overflow = 'auto';"><i class="fas fa-times"></i></a></li>
				<li><a href="/">Inicio</a></li>
				<li><a href="/categoria/documentario/">Documentarios</a></li>
				<li><a href="/categoria/anime/">Animes</a></li>
				<li><a href="/categoria/mais-visitados/">Mais vistos</a></li>
			</ul>
		</nav>
		<div class="menu_dir">
			<div class="menu_user">
				<form class="busc_desk" method="get" action="/busca/">
					<a href="#" style="padding-left: 2px;padding-right: 2px;"><i class="fas fa-search"></i></a>
					<input name="key" type="search" name="" placeholder="Pesquisar">
				</form>
				<a href="javascript:void(0)" class="btn_show_search" onclick="display_edit('fundo_preto', 'block');"><i class="fas fa-search"></i></a>
				<span class="teste" style="color:#fff;padding: 0px 15px;font-size: 17px;">PlaySeries</span>
			</div>
		</div>
		<div id="fundo_preto">
			<span class="close_fp" title="Fechar" onclick="display_edit('fundo_preto', 'none');">×</span>
			<div class="fundo_p-content">
				<form class="busca" method="get" action="/busca/">
					<input type="text" name="key">
					<button type="submit"><i class="fas fa-search"></i></button>
				</form>
			</div>
			
		</div>
	</div>
</header>

<main>
<aside>
	<ul>
		<li>Top 6 series</li>
		<li><a href="/watch/serie/prison-break/">Prison Break</a></li>
		<li><a href="/watch/serie/sobrenatural/">Sobrenatural</a></li>
		<li><a href="/watch/serie/the-walking-dead/">The Walking Dead</a></li>
		<li><a href="/watch/serie/Breaking-bad/">Breaking Bad</a></li>
		<li><a href="/watch/serie/game-of-thrones">Game Of Thrones</a></li>
		<li><a href="/watch/serie/stranger-things/">Stranger Things</a></li>
	</ul>
	<ul>
		<li>Recomendados</li>
		<li><a href="/watch/serie/la-casa-de-papel/">Lá Casa de Papel</a></li>
		<li><a href="/watch/serie/naruto/">Naruto</a></li>
		<li><a href="/watch/serie/the-flash/">The Flash</a></li>
		<li><a href="/watch/serie/arrow/">Arrow</a></li>
		<li><a href="/watch/serie/riverdale/">Riverdale</a></li>
		<li><a href="/watch/serie/lucifer/">Lúcifer</a></li>
		<li><a href="/watch/serie/13-reasons-why/">13 Reasons Why</a></li>
		<li><a href="/watch/serie/naruto-shippuden/">Naruto Shippuden</a></li>
		<li><a href="/watch/serie/3-por-cento/">3%</a></li>
		<li><a href="/watch/serie/death-note/">Death Note</a></li>
		<li><a href="/watch/serie/the-100/">The100</a></li>
		<li><a href="/watch/serie/the-originals/">The Originals</a></li>
		<li><a href="/watch/serie/o-atirador/">O Atirador</a></li>
		<li><a href="/watch/serie/the-vampire-diaries/">The Vampire Diaries</a></li>
		<li><a href="/watch/serie/american-horror-story/">American Horror Story</a></li>
		<li><a href="/watch/serie/os-simpsons/">Os simpsons</a></li>
	</ul>
</aside>
<section class="conteudo">
	<div class="links_categoria width-90">
		<a href="/categoria/drama/">Drama</a>
		<a href="/categoria/terror/">Terror</a>
		<a href="/categoria/ficcao/">Ficção</a>
		<a href="/categoria/desenho/">Desenhos</a>
		<a href="/categoria/suspense/">Suspense</a>
		<a href="/categoria/romance/">Romance</a>
		<a href="/categoria/acao/">Ação</a>
		<a href="/categoria/aventura/">Aventura</a>
		<a href="/categoria/comedia/">Comedia</a>
	</div>
	<!-- Inclui PÁGINAS -->
	<?php
	function Charscategoria($char){
	$char = str_replace("mais-visitados","Mais Vistos",$char);
	$char = str_replace("ficcao","Ficção",$char);
	$char = str_replace("acao","Ação",$char);
	$char = str_replace("documentario","Documentário",$char);
	$char = str_replace("/","&#47;",$char);
	$char = str_replace("'","&#39;",$char);
	return $char;
	}
	$pagina = @$_GET['pi'];
	if (isset($pagina)) {
		$file_pagina = $_SERVER['DOCUMENT_ROOT']."/paginas/".$pagina;
		if(file_exists(stream_resolve_include_path($file_pagina))){
			include_once $file_pagina;
		}else{
			echo "<br><br>Está página Não existe". $file_pagina;
		}
	}else{
		include_once $_SERVER['DOCUMENT_ROOT']."/paginas/home.php";
	}
	?>
</section>
</main>

<footer>
	<ul>
		<li><a href="/admin/">Login</a></li>
		<li><a target="_blank" href="http://www.facebook.com/">Contato</a></li>
		<li><a target="_blank" href="http://facebook.com/">Sugerir Series</a></li>
	</ul>
	<ul>
		<li><a href="/sobre/">Sobre</a></li>
		<li><a href="https://ouo.io/BfKHcS">Anuncios</a></li>
		<li><a href="#">Dicas</a></li>
	</ul>
	<ul>
		<li><a target="_blank" href="https://ouo.io/n0g60">Travando?</a></li>
		<li><a target="_blank" href="https://ouo.io/BfKHcS">AdBlock</a></li>
		<li><a href="#">Players</a></li>
	</ul>
	<div class="coping">
		PlaySeries 2018 - Criado por <i><a target="_blank" title="Criador" href="https://www.facebook.com/luiss.felipe.16">luisfeliperm</a></i>
	</div>
</footer>
</body>
</html>