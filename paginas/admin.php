<link rel="stylesheet" type="text/css" href="/css/admin.css">
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<!-- Recomendados -->
<div class="container-cat" style="text-shadow:none;">
<div class="cat-conteudo width-90">
	<?php 
	if (isset($_POST['user']) && isset($_POST['pass'])) {
		$user = anti_injection($_POST['user']);$pass = anti_injection($_POST['pass']);
		$query = "SELECT * FROM admin WHERE user = '".$user."' AND pass = '".$pass."' AND nivel > 0";
		$result = executa_query($query);
		if (mysqli_num_rows($result)) {
			echo "<br><br><br><br>=> LOGADO";
			$_SESSION['user'] = $user;$_SESSION['pass'] = $pass;
		}
	}
	if (!isset($_SESSION['user'],$_SESSION['pass']) || empty($_SESSION['user']) || empty($_SESSION['pass'])) {
		// Não está logado
		?>
		<form class="login" method="post">
			<h1>Painel de administração</h1>
			<input type="text" name="user">
			<input type="password" name="pass">
			<a href="javascript:void(0);" onclick="display_edit('recup', 'block')">Recuperar</a>
			<button type="submit">Entrar</button>
		</form>
		<form class="recup" id="recup">
			<label for="r_user">Recuperar usuario</label>
			<input type="text" placeholder="Email ou Usuario" name="r_user" id="r_user">
			<button onclick="return recupera();">Recuperar</button>
			<br><div id="status"></div>
		</form>
		<script>
			function recupera(){
				document.getElementById("status").innerHTML = 'Aguarde...';
				var user = document.getElementById("r_user").value;
				$.post('/config/admin/recupera.php',{user: user},function(data){
				if (data == 1) {document.getElementById("status").innerHTML = 'Enviado!';}else{document.getElementById("status").innerHTML = 'Não enviado!';}
				})
				return false;
			}
		</script>
		<?php
	}else{ /******  TÁ LOGADO */
		?>
		<div class="adm">

		<div class="adm_aside a-1 left">
			<?php 
			if (!isset($_GET['pag']) OR $_GET['pag'] == "serie") { ?>
				<div class="add add-serie">
					<?php 
					$mod_edit=0;
					if (isset($_GET['edit']) && !empty($_GET['edit'])) {
						$edit=anti_injection($_GET['edit']);
						$query = "SELECT identificador FROM series WHERE identificador = '".$edit."' ";
						$result = executa_query($query);
						if (mysqli_num_rows($result)) {
							$mod_edit=1;

							$ler_edit = ler_db("series", "WHERE identificador = '".$edit."' ");
							if (!empty($ler_edit)) { // O link existe
								foreach ($ler_edit as $edit_array) {
								 	$d_edit = array('id_real' => $edit_array['id'],'id' => $edit_array['identificador'],'nome' => $edit_array['nome'], 'info' => $edit_array['info'], 'sinopse' => $edit_array['sinopse'], 'background' =>  $edit_array['background'],'miniatura' => $edit_array['miniatura'],'tags' => $edit_array['tags'] );

								 	$d_edit['info'] = str_replace(' ','&',$d_edit['info']);
									$d_edit['info'] = str_replace('_',' ',$d_edit['info']);
									$d_edit['info'] = str_replace('min','',$d_edit['info']);
									parse_str($d_edit['info'], $info_serie);
								}
							}

						}
					}
					?>
					<div class="add_titulo"><?php if($mod_edit==1){echo "<span class='left'>Editar Série</span><span class='right'><a href='/admin/'><i class='fas fa-chevron-left'></i></a> <a title='Excluir série' href='#''><i class='fas fa-trash-alt'></i></a></span>";}else{echo "Adicionar Série";}?></div>
					<form method="post">
						<div>
							<label for="form_adm_id">Identificador</label>
							<input value="<?php echo @$d_edit['id'];?>" required type="text" name="form_adm_id" id="form_adm_id" onkeyup="limiteCaract(this, 200);this.value = this.value.replace(/[^a-zA-Z1-9. -]/g,'').replace(/\s+/g, '-').replace('--', '-').toLowerCase();" onblur="valida('form_adm_id')">
							<div class="input_status" id="status_id"></div>
						</div>

						<div>
							<label for="form_adm_name">Nome</label>
							<input value="<?php echo @$d_edit['nome'];?>" required type="text" name="form_adm_name" id="form_adm_name" onkeyup="limiteCaract(this, 200);this.value = this.value.replace(/\s+/g,' ')" onblur="valida('form_adm_name')">
							<div class="input_status" id="status_title"></div>
						</div>

						<div>
							<label for="form_adm_sinopse">Sinopse</label>
							<textarea spellcheck id="form_adm_sinopse"  onkeyup="limiteCaract(this, 700);"  name="form_adm_sinopse"><?php echo @$d_edit['sinopse'];?></textarea>
						</div>

						<div>
							<label for="form_adm_backg">Background</label>
							<input value="<?php echo @$d_edit['background'];?>" required type="url" name="form_adm_backg" id="form_adm_backg" onkeyup="limiteCaract(this, 200);" onblur="valida('form_adm_backg');" >
							<div class="input_status" id="status_backg">*Já existe</div>
						</div>

						<div>
							<label for="form_adm_minia">Miniatura</label>
							<input value="<?php echo @$d_edit['miniatura'];?>" required type="url" name="form_adm_minia" id="form_adm_minia" onkeyup="limiteCaract(this, 200);" onblur="valida('form_adm_minia');">
							<div class="input_status" id="status_minia">*Já existe</div>
						</div>

						<div>
							<label for="form_adm_tag">Tags (twd,zumbi,terror)</label>
							<input value="<?php echo @$d_edit['tags'];?>" type="text" id="form_adm_tag" name="form_adm_tag" onkeyup="limiteCaract(this, 160);this.value = removeAcento(this.value).replace(';',',').replace(', ',',').replace(' ,',',')" >
							<div class="input_status" id="status_tag">*Já existe</div>
						</div>

						<fieldset>
							<legend>INFO: Data/Tempo/Qualidade</legend>
							<input type="number" name="form_adm_data" id="form_adm_data" value="<?php echo $info_serie['data'] ?? '2018'; ?>" title="Ano de lançamento">
							<input type="number" name="form_adm_min" id="form_adm_min" value="<?php echo $info_serie['tempo'] ?? '40'; ?>" title="Minutos">
							<select name="form_adm_qualy" id="form_adm_qualy">
								<option <?php if(@$info_serie['qualy']=="720p" ){echo "selected";}?>>720p</option>
								<option <?php if(@$info_serie['qualy']=="360p" ){echo "selected";}?>>360p</option>
								<option <?php if(@$info_serie['qualy']=="480p" ){echo "selected";}?>>480p</option>
								<option <?php if(@$info_serie['qualy']=="1080p" ){echo "selected";}?>>1080p</option>
							</select>
						</fieldset>

						<div>
							<label for="form_adm_">Categoria</label>
							<select id="cat1" name="cat1" class="cat">
								<option value="0">--</option>
								<option value="anime">Animes</option>
								<option value="acao">Ação</option>
								<option value="aventura">Aventura</option>
								<option value="drama">Drama</option>
								<option value="documentario">Documentário</option>
								<option value="terror">Terror</option>
								<option value="ficcao">Ficção</option>
								<option value="desenho">Desenho</option>
								<option value="suspense">Suspense</option>
								<option value="romance">Romance</option>
								<option value="comedia">Comedia</option>
							</select>
							<select id="cat2" name="cat2" class="cat">
								<option value="0">--</option>
								<option value="anime">Animes</option>
								<option value="acao">Ação</option>
								<option value="aventura">Aventura</option>
								<option value="drama">Drama</option>
								<option value="documentario">Documentário</option>
								<option value="terror">Terror</option>
								<option value="ficcao">Ficção</option>
								<option value="desenho">Desenho</option>
								<option value="suspense">Suspense</option>
								<option value="romance">Romance</option>
								<option value="comedia">Comedia</option>
							</select>
							<select id="cat3" name="cat3" class="cat">
								<option value="0">--</option>
								<option value="anime">Animes</option>
								<option value="acao">Ação</option>
								<option value="aventura">Aventura</option>
								<option value="drama">Drama</option>
								<option value="documentario">Documentário</option>
								<option value="terror">Terror</option>
								<option value="ficcao">Ficção</option>
								<option value="desenho">Desenho</option>
								<option value="suspense">Suspense</option>
								<option value="romance">Romance</option>
								<option value="comedia">Comedia</option>
							</select>
							<select id="cat4" name="cat4" class="cat">
								<option value="0">--</option>
								<option value="anime">Animes</option>
								<option value="acao">Ação</option>
								<option value="aventura">Aventura</option>
								<option value="drama">Drama</option>
								<option value="documentario">Documentário</option>
								<option value="terror">Terror</option>
								<option value="ficcao">Ficção</option>
								<option value="desenho">Desenho</option>
								<option value="suspense">Suspense</option>
								<option value="romance">Romance</option>
								<option value="comedia">Comedia</option>
							</select>
							<div class="input_status" id="status_info">*Já existe</div>
						</div>
						
						<div class="add_submit">
							
							<button type='submit' class="right" onclick="return enviar();"><?php if ($mod_edit==1) {echo "Salvar";}else{echo"Adicionar";}?></button>
							<span id="carregando" class="right"><img src="http://gifimage.net/wp-content/uploads/2018/04/loading-gif-animado-11.gif"></span>
						</div>
					</form>
					<script type="text/javascript">
						function enviar(){
							display_edit('carregando', 'block');
							var Identificador = document.getElementById('form_adm_id').value;
							var nome = document.getElementById('form_adm_name').value;
							var sinopse = document.getElementById('form_adm_sinopse').value;
							var backg = document.getElementById('form_adm_backg').value;
							var minia = document.getElementById('form_adm_minia').value;
							var tag = document.getElementById('form_adm_tag').value;
							var ano = document.getElementById('form_adm_data').value;
							var min = document.getElementById('form_adm_min').value;
							var qualy = document.getElementById('form_adm_qualy').value;
							var cat1 = document.getElementById('cat1').value;
							var cat2 = document.getElementById('cat2').value;
							var cat3 = document.getElementById('cat3').value;
							var cat4 = document.getElementById('cat4').value;
							$.post('/config/admin/valida_add_serie.php',{<?php if($mod_edit==1){echo "id_real: ".$d_edit['id_real'].",";}?>add: '<?php if($mod_edit==1){echo "update";}else{echo "1";}?>', id: Identificador, nome: nome,sinopse: sinopse,backg: backg,minia: minia, tag: tag, ano: ano,min: min,qualy: qualy,cat1: cat1,cat2: cat2,cat3: cat3,cat4: cat4},function(data){
							 //mostrando o retorno do post		
							 if (data == "erro2") {
							 	display_edit('resultado','block');
							 	display_edit('sub_result2','block');
							 	display_edit('carregando', 'none');
							 }
							 if (data == "erro3") {
							 	display_edit('resultado','block');
							 	display_edit('sub_result3','block');
							 	display_edit('carregando', 'none');
							 }
							 if (data == "sucesso") {
							 	display_edit('resultado','block');
							 	display_edit('sub_result1','block');
							 	display_edit('carregando', 'none');
							 }
							 if (data == "update") {
							 	display_edit('resultado','block');
							 	display_edit('sub_result4','block');
							 	display_edit('carregando', 'none');
							 }
							})
							return false;
						}
					</script>
				</div>
			<?php
			} ?>
		</div>
	
		<div class="adm_aside a-2 right">
			<div class="container_adm account">
				<span>Admin <i>luisfeliperm</i> <b>NIVEL: #1</b></span>
				<a href="#">Editar</a>
				<a href="#">Sair</a>
			</div>
			<div class="container_adm sql">
				<label>Query SQL:</label>
				<input type="text" name="">
				<button>exc</button>
			</div>
			<div class="container_adm links">
				<a href="#">Adicionar Série</a>
				<a href="#">Editar Série</a>
				<a href="#">Adicionar Epsódio</a>
				<a href="#">Editar Epsódio</a>
				<a href="#">Usuarios</a>
			</div>
		</div>


		</div>
		<div id="resultado">
			<div class="sub_result" id="sub_result1">
				<div class="result_title">Pronto!</div>
				<div class="result_msg">
					<a href="#" target="_blank">The Walking Dead</a>
				</div>
				<div class="result_close" onclick="display_edit('resultado','none');display_edit('sub_result1','none');display_edit('sub_result2','none');display_edit('sub_result3','none');display_edit('sub_result4','none');"><a href="javascript:void(0);">[Fechar]</a></div>
			</div>
			
			<div class="sub_result" id="sub_result2">
				<div class="result_title">A serie já existe!</div>
				<div class="result_msg">
					<button  id="edit_serie" onclick="window.location.href='./?pag=serie&edit='+document.getElementById('form_adm_id').value ">EDITAR</button>
				</div>
				<div class="result_close" onclick="display_edit('resultado','none');display_edit('sub_result1','none');display_edit('sub_result2','none');display_edit('sub_result3','none');display_edit('sub_result4','none');"><a href="javascript:void(0);">[Fechar]</a></div>
			</div>

			<div class="sub_result" id="sub_result3">
				<div class="result_title">Erro!</div>
				<div class="result_msg">
					Verifique os campos e tente novamente
				</div>
				<div class="result_close" onclick="display_edit('resultado','none');display_edit('sub_result1','none');display_edit('sub_result2','none');display_edit('sub_result3','none');display_edit('sub_result4','none');"><a href="javascript:void(0);">[Fechar]</a></div>
			</div>

			<div class="sub_result" id="sub_result4">
				<div class="result_title">Ok, de F5!</div>
				<div class="result_msg">
					Série atúalizada
				</div>
				<div class="result_close" onclick="display_edit('resultado','none');display_edit('sub_result1','none');display_edit('sub_result2','none');display_edit('sub_result3','none');display_edit('sub_result4','none');"><a href="javascript:void(0);">[Fechar]</a></div>
			</div>
			
		</div>

		<?php
	}
	?>
</div>
</div>

<script>
function valida(campo){
	var elemento = document.getElementById(campo);
	if (campo == "form_adm_id"){
		if (<?php echo $mod_edit;?> == 1 && elemento.value == "<?php echo @$edit; ?>") {
			display_edit('status_id','none');
			return false;
		}
		$.post('/config/admin/valida_add_serie.php',{valida: 1, valor_id: elemento.value},function(data){
		 if (data == 1) {
		 	document.getElementById('status_id').style.display = 'block';
		 	document.getElementById('status_id').innerHTML = "<span style=color:#6b7b1a><i style='color:#6b7b1a' class='fas fa-exclamation-triangle'></i> ATENÇÃO: Essa serie já existe! <a href='./?pag=serie&edit="+elemento.value+"' style='color:#0061ff;'>[EDITAR]</a></span>";
		 }else{document.getElementById('status_id').style.display = 'none';}
		})
	}
	if (campo == "form_adm_name"){
		if (<?php echo $mod_edit;?> == 1 && elemento.value.replace(/\s+/g, '').toLowerCase() == "<?php echo strtolower(str_replace(" ","",@$d_edit['nome'])); ?>") {
			display_edit('status_title','none');
			return false;
		}
		$.post('/config/admin/valida_add_serie.php',{valida: 2, valor_id: elemento.value},function(data){
		 if (data == 1) {
		 	document.getElementById('status_title').style.display = 'block';
		 	document.getElementById('status_title').innerHTML = "<span style=color:#a50924>Este nome já existe (ignore)</span>";
		 }else{document.getElementById('status_title').style.display = 'none';}
		})
	}
	if (campo == "form_adm_backg") {
		function is_url(str) {
		    var regexp = /(ftp|http|https):\/\/(\w+:{0,1}\w*@)?(\S+)(:[0-9]+)?(\/|\/([\w#!:.?+=&%@!\-\/]))?/
		    //Retorna true en caso de que la url sea valida o false en caso contrario
		    return regexp.test(str);
		 }
		var Url = elemento.value;
		if(!is_url(Url)){// URL valida 
			document.getElementById('status_backg').style.display = 'block';
		 	document.getElementById('status_backg').innerHTML = "<span style=color:red>URL incorreta!</span>";
		}else{document.getElementById('status_backg').style.display = 'none';}
	}
	if (campo == "form_adm_minia") {
		function is_url(str) {
		    var regexp = /(ftp|http|https):\/\/(\w+:{0,1}\w*@)?(\S+)(:[0-9]+)?(\/|\/([\w#!:.?+=&%@!\-\/]))?/
		    //Retorna true en caso de que la url sea valida o false en caso contrario
		    return regexp.test(str);
		 }
		var Url = elemento.value;
		if(!is_url(Url)){// URL valida 
			document.getElementById('status_minia').style.display = 'block';
		 	document.getElementById('status_minia').innerHTML = "<span style=color:red>URL incorreta!</span>";
		}else{document.getElementById('status_minia').style.display = 'none';}
	}
}
function removeAcento(text){
    text = text.replace(new RegExp('[ÁÀÂÃ]','gi'), 'a');
    text = text.replace(new RegExp('[ÉÈÊ]','gi'), 'e');
    text = text.replace(new RegExp('[ÍÌÎ]','gi'), 'i');
    text = text.replace(new RegExp('[ÓÒÔÕ]','gi'), 'o');
    text = text.replace(new RegExp('[ÚÙÛ]','gi'), 'u');
    text = text.replace(new RegExp('[Ç]','gi'), 'c');
    return text;                 
}
</script>
