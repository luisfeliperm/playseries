<!-- Recomendados -->
<div class="container-cat">
	<div class="cat-conteudo width-90">
		<div class="cat_nome">Novos</div>
		<div class="list-films">
			<?php
			$ler = ler_db("series", "ORDER BY id DESC LIMIT 10;");
			if (!empty($ler)) {
				foreach ($ler as $lers) { 
					$lers['info'] = str_replace(' ','&',$lers['info']);
					$lers['info'] = str_replace('_',' ',$lers['info']);
					parse_str($lers['info'], $info_serie);
					?>
					<div class="filme">
						<img src="<?php echo $lers['miniatura'];?>">
						<div class="info">
							<div class="dadosFilm">
								<div class="InfTitulo"><?php echo $lers['titulo'];?></div>
								<div class="InfoDataTime mininfo"><i class="fas fa-clock"></i> <?php echo $info_serie['tempo']. " ".$info_serie['data'];?></div>
								<div class="InfoCategoria mininfo"><i class="fas fa-film"></i> 
									<?php 
									echo "<span class='capitalize'>".$lers['cat1']."</span> "."<span class='capitalize'>".$lers['cat2']."</span> "."<span class='capitalize'>".$lers['cat3']."</span> "."<span class='capitalize'>".$lers['cat4']."</span> ";
									?>
								</div>
								<div class="InfoNumTempor mininfo"><i class="fas fa-video"></i> 2 Temporadas</div>
								<div class="InfoSinopse" title="<?php echo $lers['sinopse'];?>"><?php echo $lers['sinopse'];?></div>
								</div>
							<div class="overflowDark"></div>
							<div class="ver">
								<a href="/watch/serie/<?php echo $lers['nome'];?>/"><i class="far fa-play-circle"></i></a>
							</div>
						</div>
					</div>
			<?php 
				}
			} 
			?>
		</div>
	</div>
</div>
