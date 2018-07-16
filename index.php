<!-- luisfeliperm -->
<?php
include_once($_SERVER['DOCUMENT_ROOT']."/config.php");
?>
<!DOCTYPE html>
<html>
<head lang="pt-br">
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
				<li><a href="/categoria/documentario/">Documentarios</a></li>
				<li><a href="/categoria/animes/">Animes</a></li>
				<li><a href="/categoria/mais-visitados/">Mais vistos</a></li>
			</ul>

			<ul class="menu_mob" id="menu_mob">
				<li id="close_menu"><a href="javascript:void(0)" onclick="display_edit('menu_mob', 'none');document.body.style.overflow = 'auto';"><i class="fas fa-times"></i></a></li>
				<li><a href="/">Inicio</a></li>
				<li><a href="/categoria/documentario/">Documentarios</a></li>
				<li><a href="/categoria/animes/">Animes</a></li>
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
		<a href="/categoria/desenhos/">Desenhos</a>
		<a href="/categoria/suspense/">Suspense</a>
		<a href="/categoria/romance/">Romance</a>
		<a href="/categoria/acao/">Ação</a>
		<a href="/categoria/aventura/">Aventura</a>
		<a href="/categoria/comedia/">Comedia</a>
	</div>
	<!-- Inclui PÁGINAS -->
	<?php
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
		<li><a target="_blank" href="http://www.facebook.com/">Contato</a></li>
		<li><a target="_blank" href="http://facebook.com/">Sugerir Series</a></li>
		<li><a href="/sobre/">Sobre</a></li>
	</ul>
	<ul>
		<li><a href="https://ouo.io/BfKHcS">Anuncios</a></li>
		<li><a href="#">Assistir no celular</a></li>
		<li><a href="#">Dicas</a></li>
	</ul>
	<ul>
		<li><a target="_blank" href="https://ouo.io/n0g60">Travando?</a></li>
		<li><a target="_blank" href="https://ouo.io/BfKHcS">AdBlock</a></li>
		<li><a href="#">Players</a></li>
	</ul>
	<div class="coping">
		PlaySeries 2018 - Criado por <i>luisfeliperm</i>
	</div>
</footer>
</body>
</html>