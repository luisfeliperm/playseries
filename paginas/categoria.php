<div class="container-cat">
	<div class="cat-conteudo width-90">
		<div class="cat_nome" style="text-transform: uppercase;"><?php echo $_GET['cat'];?></div>
		<div class="list-films">
			<?php
			$cat = @anti_injection($_GET['cat']);
			$total_exib = "10"; // número de registros por página
			$pagina = @anti_injection(intval($_GET['p']));
			if (!isset($pagina) || $pagina < 1) {
				$pag_n = "1";
			} else {
				$pag_n = $pagina;
			}
			$inicio = $pag_n - 1;
			$inicio = $inicio * $total_exib;
			$ler = ler_db("series", "WHERE (cat1 = '".$cat."' OR cat2 = '".$cat."' OR cat3 = '".$cat."' OR cat4 = '".$cat."' )  ORDER BY id DESC LIMIT ".$inicio.",".$total_exib.";");

			if ($cat == "mais-visitados") {
				$ler = ler_db("series", "  ORDER BY viwer DESC,id DESC LIMIT ".$inicio.",".$total_exib.";");
			}
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
								<div class="InfTitulo"><?php echo $lers['nome'];?></div>
								<div class="InfoDataTime mininfo"><i class="fas fa-clock"></i> <?php echo $info_serie['tempo']. " ".$info_serie['data'];?></div>
								<div class="InfoCategoria mininfo"><i class="fas fa-film"></i> 
									<?php 
									echo "<span class='capitalize'>".$lers['cat1']."</span> "."<span class='capitalize'>".$lers['cat2']."</span> "."<span class='capitalize'>".$lers['cat3']."</span> "."<span class='capitalize'>".$lers['cat4']."</span> ";
									?>
								</div>							
								<div class="InfoNumTempor mininfo"><i class="fas fa-video"></i> 2 Temporadas</div>
								<div class="InfoSinopse" title="<?php echo $lers['sinopse'];?>"><?php echo $lers['sinopse'];?> </div>
							</div>
							<div class="overflowDark"></div>
							<div class="ver">
								<a href="/watch/serie/<?php echo $lers['identificador'];?>/"><i class="far fa-play-circle"></i></a>
							</div>
						</div>
					</div>
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
		$tr = mysqli_num_rows(executa_query("SELECT * FROM series WHERE (cat1 = '".$cat."' OR cat2 = '".$cat."' OR cat3 = '".$cat."' OR cat4 = '".$cat."' ) ;")); // verifica o número total de registros
		if ($cat == "mais-visitados"){
			$tr = mysqli_num_rows(executa_query("SELECT * FROM series"));
		}
		$tp = $tr / $total_exib; // verifica o número total de páginas
		if ($pag_n>1) {
			echo "<a href='?p=".($pag_n -1)."'><i class='fas fa-angle-double-left'></i></a> ";
		}else{
			echo "<a href='javascript:void(0)' style='opacity:0.5;cursor:default;'><i class='fas fa-angle-double-left'></i></a> ";
		}
		if ($pag_n<$tp) {
			echo "<a href='?p=".($pag_n +1)."'><i class='fas fa-angle-double-right'></i></a>";
		}else{
			echo "<a href='javascript:void(0)' style='opacity:0.5;cursor:default;'><i class='fas fa-angle-double-right'></i></a> ";
		}
		?>
	</div>
	<style>
				.paginacao{margin:20px 0px;text-align: center;display:block;}
				.paginacao a{
					font-size: 15px;color:#968484;;
				    text-shadow: none;
				    padding: 5px 5px;
				    margin: 0px 5px;
				}
	</style>
</div>