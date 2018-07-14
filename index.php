<!DOCTYPE html>
<html>
<head>
	<title>PlaySeries</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="/css/layout.css">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<script src="/js/site.js"></script>
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.10/css/all.css" integrity="sha384-+d0P83n9kaQMCwj8F4RJB66tzIwOKmrdb46+porD/OvrJ+37WqIM7UoBtwHO6Nlg" crossorigin="anonymous">
</head>
<body>
<header>
	<div class="title_site">
		<figure>
			<img src="/logo.png">
			<figcaption></figcaption>
		</figure>
	</div>
	<div class="menu">
		<div class="show_menu"><a href="javascript:void(0)" onclick="display_edit('menu_mob', 'block');document.body.style.overflow = 'hidden';"><i class="fas fa-bars"></i></a></div>
		<nav id="nav_menu">
			<ul class="menu_desk">
				<li><a href="/">Inicio</a></li>
				<li><a href="/categoria/series/">Series</a></li>
				<li><a href="/categoria/filmes/">Filmes</a></li>
				<li><a href="/categoria/animes/">Animes</a></li>
			</ul>

			<ul class="menu_mob" id="menu_mob">
				<li id="close_menu"><a href="javascript:void(0)" onclick="display_edit('menu_mob', 'none');document.body.style.overflow = 'auto';"><i class="fas fa-times"></i></a></li>
				<li><a href="/">Inicio</a></li>
				<li><a href="/categoria/series/">Series</a></li>
				<li><a href="/categoria/filmes/">Filmes</a></li>
				<li><a href="/categoria/animes/">Animes</a></li>
			</ul>
		</nav>
		<div class="menu_dir">
			<div class="menu_user">
				<form class="busc_desk" method="get" action="/procurar/">
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
				<form class="busca" method="get" action="/procurar/">
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
		<li>Top 5 series</li>
		<li><a href="#">Prison Break</a></li>
		<li><a href="#">Sobrenatural</a></li>
		<li><a href="#">The Walking Dead</a></li>
		<li><a href="#">Breaking Bad</a></li>
		<li><a href="#">Game Of Thrones</a></li>
		<li><a href="#">Stranger Things</a></li>
		<li><a href="#">Vikings</a></li>
	</ul>
	<ul>
		<li>Filmes</li>
		<li><a href="#">As cronicas de narnia</a></li>
		<li><a href="#">Harry Potter</a></li>
		<li><a href="#">It a coisa</a></li>
		<li><a href="#">O exterminador do futuro</a></li>
		<li><a href="#">Divirgente</a></li>
		<li><a href="#">Maze Runner</a></li>
	</ul>
</aside>
<section class="conteudo">
	<div class="links_categoria">
		<a href="/categoria/filmes/">Filmes</a>
		<a href="/categoria/series/">Series</a>
		<a href="/categoria/animes/">Animes</a>
		<a href="/categoria/desenhos/">Desenhos</a>
		<a href="/categoria/romance/">Romance</a>
		<a href="/categoria/acao/">Ação</a>
		<a href="/categoria/aventura/">Aventura</a>
		<a href="/categoria/comedia/">Comedia</a>
		<a href="/categoria/documentario/">Documentario</a>
	</div>
	<!-- Inclui PÁGINAS -->
	<?php
	$pagina = @$_GET['p'];
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
		<li><a href="/contato/">Contato</a></li>
		<li><a href="/contato/">Sugerir Filmes</a></li>
		<li><a href="/sobre/">Sobre</a></li>
	</ul>
	<ul>
		<li><a href="/ajuda/#anuncios">Anuncios</a></li>
		<li><a href="/ajuda/#playmobile">Assistir no celular</a></li>
		<li><a href="/ajuda/#dicas">Dicas</a></li>
	</ul>
	<ul>
		<li><a href="/ajuda/#travando">Travando?</a></li>
		<li><a target="_blank" href="https://chrome.google.com/webstore/detail/adblock/gighmmpiobklfepjocnamgkkbiglidom?hl=pt-BR">AdBlock</a></li>
		<li><a href="/ajuda/#players">Players</a></li>
	</ul>
	<div class="coping">
		PlaySeries 2018 - Criado por <i>luisfeliperm</i>
	</div>
</footer>
</body>
</html>