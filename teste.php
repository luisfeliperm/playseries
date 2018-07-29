<?php 
		$tr = mysqli_num_rows(executa_query("SELECT * FROM series ")); // verifica o número total de registros
		$tp = $tr / $total_exib; // verifica o número total de páginas
		if ($pag_n>1) {
			echo "<a href='?p=".($pag_n -1)."'><i class='fas fa-angle-double-left'></i></a> ";
		}else{
			echo "<a href='javascript:void(0)' style='opacity:0.5;cursor:default;'><i class='fas fa-angle-double-left'></i></a> ";
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
				echo " <span>" . $i . "</span> ";
		 	}else{
				if ($i >= 1 && $i <= $tp2){
			   		echo " <a href=\"./?p=" . $i . "\">" . $i . "</a> ";
			  	}
		 	}
		}






		if ($pag_n<$tp) {
			echo "<a href='?p=".($pag_n +1)."'><i class='fas fa-angle-double-right'></i></a>";
		}else{
			echo "<a href='javascript:void(0)' style='opacity:0.5;cursor:default;'><i class='fas fa-angle-double-right'></i></a> ";
		}
		?>