<main class="container-cat">
	<div class="cat-conteudo width-90">
		<h1>Resultados para: <?php echo charsEspe(@$_GET['key']); ?></h1>
		<div class="list-films">
			<?php
			$key = @anti_injection(charsEspe($_GET['key']));
			$total_exib = "15"; // número de registros por página
			$pagina = @anti_injection(intval($_GET['p']));
			if (!isset($pagina) || $pagina < 1) {
				$pag_n = "1";
			} else {
				$pag_n = $pagina;
			}
			$inicio = $pag_n - 1;
			$inicio = $inicio * $total_exib;

			$ler = ler_db("series", "WHERE (nome LIKE '%".$key."%' OR tags LIKE '%".$key."%')  ORDER BY id DESC LIMIT ".$inicio.",".$total_exib.";");
			if (empty($key)) {
				$ler = ler_db("series", "  ORDER BY id ASC LIMIT ".$inicio.",".$total_exib.";");
			}
			if (!empty($ler)) {
				foreach ($ler as $lers) { 
					$lers['info'] = str_replace(' ','&',$lers['info']);
					$lers['info'] = str_replace('_',' ',$lers['info']);
					parse_str($lers['info'], $info_serie);
					?>
					<article class="filme">
						<img alt="<?php echo $lers['nome'];?>" src="<?php echo $lers['miniatura'];?>">
						<div class="info">
							<div class="dadosFilm">
								<h1 class="InfTitulo"><?php echo $lers['nome'];?></h1>
								<p class="InfoDataTime mininfo"><i class="fas fa-clock"></i> <?php echo $info_serie['tempo']. " ".$info_serie['data'];?></p>
								<p class="InfoCategoria mininfo"><i class="fas fa-film"></i> 
									<?php 
									echo "<span class='capitalize'>".Charscategoria($lers['cat1'])."</span> "."<span class='capitalize'>".Charscategoria($lers['cat2'])."</span> "."<span class='capitalize'>".Charscategoria($lers['cat3'])."</span> "."<span class='capitalize'>".$lers['cat4']."</span> ";
									?>
								</p>
								<p class="InfoNumTempor mininfo"><i class="fas fa-video"></i> <?php echo mysqli_num_rows(executa_query("SELECT DISTINCT temporada FROM eps WHERE identificador = '".$lers['identificador']."' ORDER BY temporada ASC ")) ?? 0;?> Temporadas</p>
								<p class="InfoSinopse" title="<?php echo $lers['sinopse'];?>"><?php echo $lers['sinopse'];?></p>
							</div>
							<div class="overflowDark"></div>
							<div class="ver">
								<a href="/watch/serie/<?php echo $lers['identificador'];?>/"><i class="far fa-play-circle"></i></a>
							</div>
						</div>
					</article>
				<?php 
				}
			}else{
				?>
				<div style="font-size: 25px;text-shadow:none;margin: 10px 0px;">Sem resultados</div>
				<?php
			}
			?>
		</div>
	</div>
	<div class="paginacao">
		<?php 
		$tr = mysqli_num_rows(executa_query("SELECT * FROM series WHERE (nome LIKE '%".$key."%' OR tags LIKE '%".$key."%') ;")); // verifica o número total de registros
		$tp = $tr / $total_exib; // verifica o número total de páginas
		if ($pag_n>1) {
			echo "<a href='?p=".($pag_n -1)."'><i class='fas fa-angle-double-left'></i></a>";
		}else{
			echo "<a href='javascript:void(0)' style='opacity:0.5;cursor:default;'><i class='fas fa-angle-double-left'></i></a>";
		}
		// http://rberaldo.com.br/limitando-o-numero-de-links-em-uma-paginacao/
		$tp2 = $tp;
		if (is_float($tp)) {
			$tp2 = ($tp2+1);
		}
		$max_links = 10;

		$links_laterais = ceil($max_links / 2);

		$inicio = $pag_n - $links_laterais;
		$limite = $pag_n + $links_laterais;

		for ($i = $inicio; $i <= $limite; $i++){
			if ($i == $pag_n){
				echo "<a class='active' href='./?p=".$i."'>".$i."</a>";
		 	}else{
				if ($i >= 1 && $i <= $tp2){
			   		echo "<a href='./?p=".$i."'>".$i."</a>";
			  	}
		 	}
		}
		if ($pag_n<$tp) {
			echo "<a href='?p=".($pag_n +1)."'><i class='fas fa-angle-double-right'></i></a>";
		}else{
			echo "<a href='javascript:void(0)' style='opacity:0.5;cursor:default;'><i class='fas fa-angle-double-right'></i></a>";
		}

		?>
	</div>
</main>