<?php $mod_edit='0';?><link rel="stylesheet" type="text/css" href="/css/admin.css">
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<!-- Recomendados -->
<div class="container-cat" style="text-shadow:none;">
<div class="cat-conteudo width-90">
	<?php 
	if (isset($_POST['Loginemail']) && isset($_POST['Loginpass'])) {
		$email = anti_injection($_POST['Loginemail']);$pass = anti_injection($_POST['Loginpass']);
		$query = "SELECT * FROM admin WHERE email = '".$email."' AND pass = '".$pass."' AND nivel > 0";
		$result = executa_query($query);
		if (mysqli_num_rows($result)) {$_SESSION['email'] = $email;$_SESSION['pass'] = $pass;}
	}
	if (!isset($_SESSION['email'],$_SESSION['pass']) || empty($_SESSION['email']) || empty($_SESSION['pass'])) {
		// Não está logado
		?>
		<form class="login" method="post">
			<h1>Painel de administração</h1>
			<input type="email" name="Loginemail">
			<input type="password" name="Loginpass">
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
		$ler_u= ler_db("admin", "WHERE email = '".$_SESSION['email']."'");
		foreach ($ler_u as $arrayU) {$admNivel = $arrayU['nivel'];}
		
		?>
		<div class="adm">
		<div class="adm_aside a-1 left">
			<?php 
			if (!isset($_GET['pag']) OR @$_GET['pag'] == "serie") { ?>
				<div class="add add-serie">
					<?php 
					if (isset($_GET['edit']) && !empty($_GET['edit'])) {
						$edit=anti_injection($_GET['edit']);
						$query = "SELECT identificador FROM series WHERE identificador = '".$edit."' ";
						$result = executa_query($query);
						if (mysqli_num_rows($result)) {
							$mod_edit='serie';

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
					<div class="add_titulo"><?php if($mod_edit=='serie'){echo "<span class='left'>Editar Série</span><span class='right'><a href='/admin/'><i class='fas fa-chevron-left'></i></a> <a title='Excluir série' onclick=\"dell('serie',null,'".$d_edit['id']."' );\"  href='javascript:void(0);''><i class='fas fa-trash-alt'></i></a></span>";}else{echo "Adicionar Série";}?></div>
					<div class="form">
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
							
							<button type='submit' class="right" onclick="return enviar();"><?php if ($mod_edit=='serie') {echo "Salvar";}else{echo"Adicionar";}?></button>
							<span id="carregando" class="right"><img src="http://www.mytreedb.com/uploads/mytreedb/loader/ajax_loader_gray_32.gif"></span>
						</div>
					</div>
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
							$.post('/config/admin/valida_add_serie.php',{<?php if($mod_edit=='serie'){echo "id_real: ".$d_edit['id_real'].",";}?>add_serie: '<?php if($mod_edit=='serie'){echo "update";}else{echo "1";}?>', id: Identificador, nome: nome,sinopse: sinopse,backg: backg,minia: minia, tag: tag, ano: ano,min: min,qualy: qualy,cat1: cat1,cat2: cat2,cat3: cat3,cat4: cat4},function(data){
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
			}
			if (isset($_GET['pag']) && @$_GET['pag'] == "ep") { 
				if (isset($_GET['mod_edit']) && @$_GET['mod_edit'] == "ep") {
					$mod_edit = "ep";
				}
				?>
			<div class="add add-serie">
				<?php // Verifica se a serie existe
				$ep_id = @anti_injection($_GET['id']);
				$ler_serie = ler_db("series", "WHERE identificador = '".$ep_id."' ");
				if (empty($ler_serie) || !isset($_GET['id']) || empty($_GET['id'])) { ?>
					<div class="add_titulo">
						<?php 
						if (isset($_GET['select_edit'])){echo"[EDITAR] EPISÓDIO";}else{echo "Adicionar Episódio <b>1ª Etapa</b>";}?>
						
					</div>
					<div class="form" id="addEpETAPA1">
						<div>
							
							
							<?php 
							if (isset($_GET['select_edit'])){
								?>
								<label for="upEpSelect">Qual o ID da série ?</label>
								<input required type="text" id="upEpSelect" onkeyup="limiteCaract(this, 200);this.value = this.value.replace(/[^a-zA-Z1-9. -]/g,'').replace(/\s+/g, '-').replace('--', '-').toLowerCase();edita_texto('status_upEpSelect','');">
								<div class="junto">
									<label>Temporada:</label>
									<input type="number" id="season">
									<label>Episódio:</label>
									<input type="number" id="ep">
								</div>

								<div class="add_submit">
									<button onclick="valida('upEpSelect')" class="right">Editar</button>
									<span style="padding: 6px 8px;display:block;" id="status_upEpSelect"></span>
								</div>
								<?php
							}else{
								?>
								<label for="idSerieForAddEP">Qual o ID da série ?</label>
								<input required type="text" id="idSerieForAddEP" onkeyup="limiteCaract(this, 200);this.value = this.value.replace(/[^a-zA-Z1-9. -]/g,'').replace(/\s+/g, '-').replace('--', '-').toLowerCase();edita_texto('statusidSerieForAddEP','');">

								<div class="add_submit">
									<button onclick="valida('idSerieForAddEP')" class="left">Verificar</button>
									<span style="padding: 6px 8px;display:block;" id="statusidSerieForAddEP"></span>
								</div>
								<?php
							}
							?>
							
						</div>
					</div> <?php
				}else{
					foreach ($ler_serie as $serie_array) {
					 	$serie = array('nome' => $serie_array['nome']);
					}
					
					$last_temp = "1";$last_ep = "0";

					if ($mod_edit == "ep") {
						$season = @anti_injection($_GET['s']);
						$ep = @anti_injection($_GET['e']);
						$ler_ep = ler_db("eps", "WHERE identificador = '".$ep_id."' AND temporada = '".$season."' AND ep = '".$ep."' ");
						if (!empty($ler_ep)){ // Md editar
							$ler_ep = ler_db("eps", "WHERE identificador = '".$ep_id."' AND temporada = '".$season."' AND ep = '".$ep."' ");
							foreach ($ler_ep as $serie_array) {
							 	$epArray = array('idReal' => $serie_array['id'],'poster' => $serie_array['poster'], 'src1' => $serie_array['src_1'], 'nsrc2' => $serie_array['nome_2'], 'src2' => $serie_array['src_2'], 'nsrc3' => $serie_array['nome_3'],'src3' => $serie_array['src_3']);
							}
							?>
							<div class="add_titulo"><b>[EDITAR] </b><?php echo $serie['nome']." S".$season."E".$ep;?></div>
							<div class="form">
								<div style="overflow:auto">
									<a onclick="dell('ep','<?php echo $epArray['idReal'];?>',null);" href="javascript:void(0)" style="font-size: 14px;" class="right">EXCLUIR</a>
								</div>
								<div>
									<label>Poster</label>
									<input type="url" id="poster" value="<?php echo $epArray['poster'];?>">
								</div>
								<div style="border:1px solid #929191;padding-bottom: 5;">
									<div style="background: #983e3e;overflow: auto;color: #fff;text-shadow: 0px 0px 1px black;margin:0;padding:5px;">Players (No minímo 1 player)</div>
									<div style="margin:10px;" id="src_1">
										<label for="input_src1">Link direito</label>
										<input type="url" id="input_src1" value="<?php echo $epArray['src1'];?>">
									</div>
									<div style="margin:10px;border:1px solid #929191;padding:8px;" id="src_2">
										<label for="input_src_n2" style="margin:0">Nome</label>
										<input style="margin-bottom:10px" maxlength="15" placeholder="YouTube,RedeCanais, etc..." type="text" id="input_src_n2" value="<?php echo $epArray['nsrc2'];?>">
										<label for="input_src2" style="margin:0">Embed</label>
										<input style="margin-bottom:10px" type="url" id="input_src2" value="<?php echo $epArray['src2'];?>">
									</div>
									<div style="margin:10px;border:1px solid #929191;padding:8px;" id="src_3">
										<label for="input_src_n3" style="margin:0">Nome</label>
										<input style="margin-bottom:10px" maxlength="15" placeholder="YouTube,RedeCanais, etc..." type="text" id="input_src_n3" value="<?php echo $epArray['nsrc3'];?>">
										<label for="input_src3" style="margin:0">Embed</label>
										<input style="margin-bottom:10px" type="url" id="input_src3" value="<?php echo $epArray['src3'];?>">
									</div>
								</div>
								<div class="add_submit">
									<button type='submit' class="right" onclick="return add_ep();">Salvar</button>
									<span id="carregando" class="right"><img src="http://www.mytreedb.com/uploads/mytreedb/loader/ajax_loader_gray_32.gif"></span>
								</div>
								<script>
								function add_ep(){
									var season = '<?php echo $season;?>';
									var ep = "<?php echo $ep;?>";
									var poster = document.getElementById('poster').value;
									var input_src1 = document.getElementById('input_src1').value;
									var name_src2 = document.getElementById('input_src_n2').value;
									var input_src2 = document.getElementById('input_src2').value;
									var name_src3 = document.getElementById('input_src_n3').value;
									var input_src3 = document.getElementById('input_src3').value;

									if(!is_url(poster) && poster.length > 0 ){// URL valida 
										alert('A url do POSTER não é válida!');return false;
									}
									if (input_src1.length < 1 && input_src2.length < 1 && input_src3.length < 1) {
										alert('Adicione no pelo menos 1 player');
										return false;
									}
									if(!is_url(input_src1) && input_src1.length > 0 ){// URL valida 
										alert('Player 1, verifique!');return false;
									}
										if(!is_url(input_src2) && input_src2.length > 0 ){// URL valida 
										alert('Player 2, verifique!');return false;
									}
									if(!is_url(input_src3) && input_src3.length > 0 ){// URL valida 
										alert('Player 3, verifique!');return false;
									}

									$.post('/config/admin/valida_add_serie.php',{add_ep: 'update',id: '<?php echo $ep_id;?>',season: season,ep: ep,poster: poster,src1: input_src1,name_src2: name_src2,src2: input_src2,name_src3: name_src3,src3: input_src3},function(data){
										
									 alert(data);
									})
								}
							</script>
							</div>
							<?php
						}else{$mod_edit = '0';}
					}
					if ($mod_edit != "ep") { // ADD
						?>
						<div class="add_titulo">Adicionar Episódio <b><?php echo $serie['nome'];?></b></div>
						<div class="form" id="addEpETAPA1">
							<div>
								<b>Total:</b>
								<span><?php $last_temp=mysqli_num_rows(executa_query("SELECT DISTINCT temporada FROM eps WHERE identificador = '".$ep_id."' ORDER BY temporada ASC ")) ?? 1;echo $last_temp;?> Temporadas</span>
								<span><?php echo mysqli_num_rows(executa_query("SELECT id FROM eps WHERE  identificador = '".$ep_id."' "));?> Epísódios</span>
								<?php 
								$ler_temp = @ler_db("eps", "WHERE identificador = '".$ep_id."' AND temporada = '".$last_temp."' ORDER BY ep DESC LIMIT 1 ");
								if (!empty($ler_temp)) { 
									foreach ($ler_temp as $ep_array) {$last_ep =$ep_array['ep'];}
								}
								?>
							</div>
							<div><b>Parou em: </b><?php echo $last_temp." Temporada Ep ".$last_ep;?></div>
							<div class="junto">
								<label>Season:</label>
								<input onclick="valida('status_select_ep');" onkeyup="valida('status_select_ep');" type="number" id="season" min="1" max="<?php echo ($last_temp+1);?>" value="<?php if ($last_temp=="0") {echo "1";}else{echo $last_temp;}?>">
								<label>Ep:</label>
								<input onclick="valida('status_select_ep');" onkeyup="valida('status_select_ep');" type="number" id="ep" min="1" value="<?php echo ($last_ep+1);?>">
								<div style="padding:6px;color:#111;background-color: #ffffcc;border-left: 6px solid #ffeb3b;display:none" id="status_select_ep">O ep já existe</div>
							</div>
							<div>
								<label>Poster</label>
								<input type="url" id="poster">
							</div>
							<div style="border:1px solid #929191;padding-bottom: 5;">
								<div style="background: #983e3e;overflow: auto;color: #fff;text-shadow: 0px 0px 1px black;margin:0;padding:5px;">Players (No minímo 1 player)</div>
								<div style="margin:10px;" id="src_1">
									<label for="input_src1">Link direito</label>
									<input type="url" id="input_src1">
								</div>
								<div style="margin:10px;display:none;border:1px solid #929191;padding:8px;" id="src_2">
									<label for="input_src_n2" style="margin:0">Nome</label>
									<input style="margin-bottom:10px" maxlength="15" placeholder="YouTube,RedeCanais, etc..." type="text" id="input_src_n2">
									<label for="input_src2" style="margin:0">Embed</label>
									<input style="margin-bottom:10px" type="url" id="input_src2">
								</div>
								<div style="margin:10px;display:none;border:1px solid #929191;padding:8px;" id="src_3">
									<label for="input_src_n3" style="margin:0">Nome</label>
									<input style="margin-bottom:10px" maxlength="15" placeholder="YouTube,RedeCanais, etc..." type="text" id="input_src_n3">
									<label for="input_src3" style="margin:0">Embed</label>
									<input style="margin-bottom:10px" type="url" id="input_src3">
								</div>
								<div style="margin:10px;">
									<button id="add_buton" onclick="add_src('add')" style="display:inline-block;background:transparent;border:1px solid;color:#774646;cursor:pointer;padding:2px 4px;"><i class="fas fa-plus"></i></button>

									<button id="remove_button" onclick="add_src('remove')" style="display:none;background:transparent;border:1px solid;color:#774646;cursor:pointer;padding:2px 4px;"><i class="fas fa-minus"></i></button>
								</div>
								
							</div>
							<input type="hidden" id="erros_ep">
							<div class="add_submit">
								<button type='submit' class="right" onclick="return add_ep();">Adicionar</button>
								<span id="carregando" class="right"><img src="http://www.mytreedb.com/uploads/mytreedb/loader/ajax_loader_gray_32.gif"></span>
							</div>
							<script>
								function add_ep(){
									var season = document.getElementById('season').value;
									var ep = document.getElementById('ep').value;
									var poster = document.getElementById('poster').value;
									var input_src1 = document.getElementById('input_src1').value;
									var name_src2 = document.getElementById('input_src_n2').value;
									var input_src2 = document.getElementById('input_src2').value;
									var name_src3 = document.getElementById('input_src_n3').value;
									var input_src3 = document.getElementById('input_src3').value;
									var erros_ep = document.getElementById('erros_ep').value;
									if (erros_ep == "1") {alert('O ep já existe!');return false;}
									function is_url(str){
									    var regexp = /(ftp|http|https):\/\/(\w+:{0,1}\w*@)?(\S+)(:[0-9]+)?(\/|\/([\w#!:.?+=&%@!\-\/]))?/
									    //Retorna true en caso de que la url sea valida o false en caso contrario
									    return regexp.test(str);
									}
									if(!is_url(poster) && poster.length > 0 ){// URL valida 
										alert('A url do POSTER não é válida!');return false;
									}
									if (input_src1.length < 1 && input_src2.length < 1 && input_src3.length < 1) {
										alert('Adicione no pelo menos 1 player');
										return false;
									}
									if(!is_url(input_src1) && input_src1.length > 0 ){// URL valida 
										alert('Player 1, verifique!');return false;
									}
										if(!is_url(input_src2) && input_src2.length > 0 ){// URL valida 
										alert('Player 2, verifique!');return false;
									}
									if(!is_url(input_src3) && input_src3.length > 0 ){// URL valida 
										alert('Player 3, verifique!');return false;
									}

									$.post('/config/admin/valida_add_serie.php',{add_ep: '1',id: '<?php echo $ep_id;?>',season: season,ep: ep,poster: poster,src1: input_src1,name_src2: name_src2,src2: input_src2,name_src3: name_src3,src3: input_src3},function(data){
										
									 if (data == "1") {
									 	display_edit('resultado','block');
									 	display_edit('sub_result5','block');
									 }else{
									 	alert(data);
									 }
									})
								}
								
							</script>
						</div>
						<?php 
					}
					?>
					
				<?php }
				?>
				
			</div>
			<?php } 
			if (isset($_GET['pag']) && @$_GET['pag'] == "user" && $admNivel == '2') {?>
				<div class="add" style="overflow:auto;margin-top: 10px;">
					<button class="left" onclick="window.location.href='/admin/?pag=user&editar'">Novo</button>
					<form method="get" action="./" class="right" style="max-width: 210px;width:100%;">
						<input type="hidden" name="pag" value="user">
						<input class="left" style="width: calc(100% - 61px);" type="text" name="b">
						<button class="left" style="width: 60px;">Busca</button>
					</form>
				</div>
				<?php 
				if (isset($_GET['dell'])) {
					$dell = anti_injection($_GET['dell']);
					$query = "DELETE FROM admin WHERE id = '".$dell."'";
					executa_query($query);
				}
				if (!isset($_GET['editar'])) {
					if (isset($_GET['b']) && !empty($_GET['b'])) {
						$key = anti_injection($_GET['b']);
						$ler_u= ler_db("admin","WHERE email LIKE '%".$key."%' ORDER BY id ");
						echo "<a style='display:table;margin:10px 0px;border:1px solid;padding:5px;' href='./'>Voltar</a>";
					}else{$ler_u= ler_db("admin");}
					?>
					<ul class="list_user">
					<?php 
					if (!empty($ler_u)) {
						foreach ($ler_u as $arrayU) {
							$us = array('id'=>$arrayU['id'],'email' => $arrayU['email'],'pass' => $arrayU['pass'],'nivel' => $arrayU['nivel'] );
							echo "<li><span class='nivel".$us['nivel']."'>#".$us['nivel']." </span>
								".$us['email']." ".$us['pass']." <a href=\"./?pag=user&editar=".$us['email']."\">Editar</a> <a href='/admin/?pag=user&dell=".$us['id']."'>Delete</a></li>";
						}
					}
					?>
					</ul>
					<style type="text/css">
						.list_user{margin-top: 10px;}
						.list_user li{padding: 5px 0px;color:#fff;}
						.list_user li span.nivel0{color:#ce0000;}
						.list_user li span.nivel1{color:#0050ff;}
						.list_user li span.nivel2{color:#17e800;}
						.list_user li a{text-decoration:underline;}
					</style>
				<?php 
				}else{
					echo "<a style='display:table;margin:10px 0px;border:1px solid;padding:5px;' href='./?pag=user'>Voltar</a>";
					$us['nivel']='1';
					if (isset($_GET['editar']) && !empty(@$_GET['editar'])) {
						$ler_u= ler_db("admin","WHERE email = '".anti_injection($_GET['editar'])."' ");
						if (!empty($ler_u)) {
							foreach ($ler_u as $arrayU) {
								$us = array('id' => $arrayU['id'],'email' => $arrayU['email'],'pass' => $arrayU['pass'],'nivel' => $arrayU['nivel'] );
							}
						}
					}
					?>
					<form method="post" onsubmit="return validaUp();" class="adm_user">
						<input required value="<?php echo @$us['email'];?>" type="email" name="Useremail" placeholder="email" id="useremail">
						<input minlength="2" required value="<?php echo @$us['pass'];?>" type="text" name="Userpass" placeholder="Senha" id="userpass">
						<div style="overflow:auto">
							<select class="left" name="Usernivel" id="nivel">
								<option value="0" <?php if($us['nivel']=="0"){echo "selected";};?>>Inativo</option>
								<option value="1" <?php if($us['nivel']=="1"){echo "selected";};?>>Admin</option>
								<option value="2" <?php if($us['nivel']=="2"){echo "selected";};?>>Master</option>
							</select>
							<button class="right" type="submit" >Update/Add</button>
						</div>
					</form>
					<div style="color:#fff;text-align:center;margin:10px;">
						<?php 
						$email = @anti_injection($_POST['Useremail']);
						$pass  = @anti_injection($_POST['Userpass']);
						$nivel = @anti_injection($_POST['Usernivel']);
						if (!empty($email) && !empty($pass) && isset($_POST['Usernivel']) && $nivel < 3 && $nivel >= 0 ) {
							
							if (isset($us['id'])) {
								# atualiza
								$query = "SELECT * FROM admin WHERE email = '".$email."' AND id <> '".$us['id']."' ";
								if (!mysqli_num_rows(executa_query($query))) {
									
									$query = " UPDATE admin SET 
									email    = '".$email."', 
									pass     = '".$pass."', 
									nivel    = '".$nivel."' 
									WHERE id = ".$us['id']." ";

									if (executa_query($query) == 1) {
										echo "Pronto!";
									}
								}else{echo "O email já existe";}
							}else{
								$query = "SELECT * FROM admin WHERE email = '".$email."' ";
								if (mysqli_num_rows(executa_query($query))) {
									echo $email." Já existe";
								}else{
									$query = "INSERT INTO admin (email,pass,nivel) VALUES ('".$email."','".$pass."','".$nivel."') ";

									if (executa_query($query) === true) {// Sucesso
										echo "sucesso";
									}else{
										echo "Erro";
									}
								}
							}

						} 
						?>
					</div>
					<script>
						function validaUp(){
							var email = document.getElementById('useremail').value;
							var pass = document.getElementById('userpass').value;
							var nivel = document.getElementById('nivel').value;
							if (email == "" || pass.length < 5) {
								alert('Verifique os campos');
								return false;
							}
						}
					</script>
					<style>
					form.adm_user{
						max-width: 200px;display:block;margin:0 auto;
					}
					form.adm_user input{
						display:block;margin:2px 0px;width: 100%;
					}
					</style>
					<?php
				}
			}
			?>

		</div>
		<div class="adm_aside a-2 right">
			<div class="container_adm account">
				<span>Admin <i style="font-size: 15px;"><?php echo $_SESSION['email'];?></i> <b>NIVEL: #<?php echo $admNivel;?></b></span>
				<a href="/config/config.php?sair=1">Sair</a>
			</div>
			<div class="container_adm sql">
				<label class="left">SQL:</label>
				<input class="left" type="text" id="sql">
				<button class="left" onclick="sql();">exc</button> <div id="status_sql"></div>
			</div>
			<div class="container_adm links">
				<div class="link"><a href="/admin/?pag=serie">Adicionar Série</a></div>
				<div class="link">
					<a href="javascript:void(0);" onclick="
					if (document.getElementById('DivSearchSerieforEdit').style.display != 'block'){
						display_edit('DivSearchSerieforEdit','block');
					}else{
						display_edit('DivSearchSerieforEdit','none');
					}
					">Editar Série</a>
					<div id="DivSearchSerieforEdit" class="sub_link">
						<input id="SearchSerieforEdit" type="text" onkeyup="limiteCaract(this, 200);this.value = this.value.replace(/[^a-zA-Z1-9. -]/g,'').replace(/\s+/g, '-').replace('--', '-').toLowerCase();">
						<button onclick="valida('SearchSerieforEdit')">Check</button>
						<div id="StatusSearchSerieforEdit" class="status"></div>
					</div>
				</div>
				<div class="link"><a href="/admin/?pag=ep">Adicionar Epsódio</a></div>
				<div class="link"><a href="/admin/?pag=ep&select_edit">Editar Epsódio</a></div>
				<div class="link"><a href="/admin/?pag=user">Usuarios</a></div>
			</div>
			<div class="container_adm" style="text-align:right;">
				<span style="color:#ddd"><?php $ler_edit=ler_db("views","ORDER BY id DESC LIMIT 1");if(!empty($ler_edit)){foreach($ler_edit as $edit_array){echo$edit_array['total'];}}?> Vizualizações</span>
			</div>
		</div>


		</div>
		<div id="resultado" >
			<div class="sub_result" id="sub_result1">
				<div class="result_title">Pronto!</div>
				<div class="result_msg">
					<a href="#" target="_blank" onclick="this.href = '/watch/serie/'+document.getElementById('form_adm_id').value+'/'">Vizualizar</a>

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
			<!-- EP -->
			<div class="sub_result" id="sub_result5">
				<div class="result_title">Ok, de F5!</div>
				<div class="result_msg">
					Epísódio adicionado!
				</div>
				<div class="result_close" onclick="display_edit('resultado','none');display_edit('sub_result5','none');"><a href="javascript:void(0);">[Fechar]</a></div>
			</div>
			
		</div>

		<?php
	}
	?>
</div>
</div>

<script>
function dell(oq,id,identificador) {
    var r = confirm("Deseja excluir!");
    if (r == true) {
        $.post('/config/admin/valida_add_serie.php',{dell: oq, id: id,identificador: identificador},function(data){
		 	alert(data);
		})
    }else{
        return false;
    }
}
function sql(){
	if (<?php echo $admNivel;?> < 2) {
		edita_texto("status_sql", "Você não tem permissão!");
		return false;
	}
	edita_texto("status_sql", "<img src='http://www.mytreedb.com/uploads/mytreedb/loader/ajax_loader_gray_32.gif'>");
	var sql = document.getElementById('sql').value;
	$.post('/config/admin/valida_add_serie.php',{sql: sql},function(data){
	 if (data == 1) {
	 	edita_texto("status_sql", "<span style='color:green;'>Sucesso</span>");
	 }else{
	 	edita_texto("status_sql", "Erro");
	 }
	})
}
function valida(campo){
	var elemento = document.getElementById(campo);
	if (campo == "form_adm_id" || campo == "SearchSerieforEdit" || campo == "idSerieForAddEP"){
		if ('<?php echo $mod_edit;?>' == 'serie' && elemento.value == "<?php echo @$edit; ?>" && campo != "SearchSerieforEdit" && campo != "idSerieForAddEP") {
			display_edit('status_id','none');
			return false;
		}
		if (campo == "SearchSerieforEdit") {
		 	edita_texto("StatusSearchSerieforEdit","<img style='width:29px;margin-top:5px;' src='http://www.mytreedb.com/uploads/mytreedb/loader/ajax_loader_gray_32.gif' >");
		}
		if (campo == "idSerieForAddEP") {
		 	edita_texto("statusidSerieForAddEP","<img style='width:13px;margin-left:10px;' src='http://www.mytreedb.com/uploads/mytreedb/loader/ajax_loader_gray_32.gif' >");
		}
		$.post('/config/admin/valida_add_serie.php',{valida: 1, valor_id: elemento.value},function(data){
		 if (data == 1) {
		 	if(campo == "SearchSerieforEdit") {
		 		edita_texto("StatusSearchSerieforEdit","<a href='./?pag=serie&edit="+elemento.value+"'>EDITAR</a> ");
		 	}if(campo == "form_adm_id"){
		 		document.getElementById('status_id').style.display = 'block';
		 		document.getElementById('status_id').innerHTML = "<span style=color:#6b7b1a><i style='color:#6b7b1a' class='fas fa-exclamation-triangle'></i> ATENÇÃO: Essa serie já existe! <a href='./?pag=serie&edit="+elemento.value+"' style='color:#0061ff;'>[EDITAR]</a></span>";
		 	}if(campo == "idSerieForAddEP") {
		 		edita_texto("statusidSerieForAddEP","<a class='right' href='./?pag=ep&id="+elemento.value+"'>Continuar</a> ");
		 	}
		 }else{
		 	if (campo == "SearchSerieforEdit") {
		 		edita_texto("StatusSearchSerieforEdit","<span style='color:red;margin-top:5px;display:block;'>Não encontrado</span>");
		 		if (elemento.value.length < 1) {
		 			edita_texto("StatusSearchSerieforEdit","");
		 		}
		 	}if(campo == "form_adm_id"){
		 		document.getElementById('status_id').style.display = 'none';
		 	}if(campo == "idSerieForAddEP") {
		 		edita_texto("statusidSerieForAddEP","<span style='margin-left:10px;'>Não encontrado</span>");
		 	}
		 }
		})
	}
	if (campo == "form_adm_name"){
		if ('<?php echo $mod_edit;?>' == 'serie' && elemento.value.replace(/\s+/g, '').toLowerCase() == "<?php echo strtolower(str_replace(" ","",@$d_edit['nome'])); ?>") {
			display_edit('status_title','none');
			return false;
		}
		$.post('/config/admin/valida_add_serie.php',{valida: 2, valor_id: elemento.value},function(data){
		 if (data == 1) {
		 	document.getElementById('status_title').style.display = 'block';
		 	document.getElementById('status_title').innerHTML = "<span style=color:#a50924>Este nome já existe (ignore)</span>";
		 }else{document.getElementById('status_title').style.display = 'none';}
		})
	}if (campo == "form_adm_backg") {
		function is_url(str){
		    var regexp = /(ftp|http|https):\/\/(\w+:{0,1}\w*@)?(\S+)(:[0-9]+)?(\/|\/([\w#!:.?+=&%@!\-\/]))?/
		    //Retorna true en caso de que la url sea valida o false en caso contrario
		    return regexp.test(str);
		}
		var Url = elemento.value;
		if(!is_url(Url)){// URL valida 
			document.getElementById('status_backg').style.display = 'block';
		 	document.getElementById('status_backg').innerHTML = "<span style=color:red>URL incorreta!</span>";
		}else{document.getElementById('status_backg').style.display = 'none';}
	}if (campo == "form_adm_minia") {
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
	}if (campo == "status_select_ep" || campo == "upEpSelect") {
		var season = document.getElementById('season').value;
		var ep = document.getElementById('ep').value;
		if (campo == "upEpSelect") {
			var id2 = document.getElementById('upEpSelect').value;
		}
		$.post('/config/admin/valida_add_serie.php',{valida: '3', id: '<?php echo @$ep_id;?>',id2:id2, season: season, ep: ep},function(data){
		 if (data == 1) {
		 	if (campo == "status_select_ep") {
		 		display_edit('status_select_ep','block');
		 		document.getElementById('erros_ep').value = "1";
		 	}
		 	if (campo == "upEpSelect") {
		 		edita_texto("status_upEpSelect","<a href='./?pag=ep&id="+id2+"&mod_edit=ep&s="+season+"&e="+ep+"'>EDITAR</a> ");
		 	}
		 	
		 }else{
		 	if (campo == "status_select_ep") {
		 		display_edit('status_select_ep','none');document.getElementById('erros_ep').value = "";
		 	}
		 	if (campo == "upEpSelect") {
		 		edita_texto("status_upEpSelect","O <a target='blank' href='/watch/serie/"+id2+"/?s="+season+"&e="+ep+"'>ep</a> não existe! ");
		 	}
		 	
		 }
		})
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
function add_src(acao){
	if (acao == "add") {
		if (document.getElementById('src_2').style.display != "block") {
			display_edit('src_2', 'block');
			display_edit('remove_button', 'inline-block');
		}else {
			display_edit('src_3', 'block');
			display_edit('add_buton', 'none');
		}
	}
	if (acao == "remove") {
		if (document.getElementById('src_3').style.display == "block") {
			display_edit('src_3', 'none');
			display_edit('add_buton', 'inline-block');
			document.getElementById('input_src_n3').value="";
			document.getElementById('input_src3').value="";
		}else {
			display_edit('src_2', 'none');
			display_edit('remove_button', 'none');
			document.getElementById('input_src_n2').value="";
			document.getElementById('input_src2').value="";
		}
	}
}
</script>
