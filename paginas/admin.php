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
			<div class="add add-serie">
				<div class="add_titulo">Adicionar Série</div>
				<form>
					<div>
						<label>Identificador</label>
						<input type="text" name="" placeholder="EXEMPLO: the-walking-dead">
						<div class="input_status">*Já existe</div>
					</div>

					<div>
						<label>Titulo</label>
						<input type="text" name="" placeholder="The Walking Dead">
						<div class="input_status">*Já existe</div>
					</div>

					<div>
						<label>Sinopse</label>
						<textarea></textarea>
						<div class="input_status">*Já existe</div>
					</div>

					<div>
						<label>Background</label>
						<input type="url" name="">
						<div class="input_status">*Já existe</div>
					</div>

					<div>
						<label>Miniatura</label>
						<input type="url" name="">
						<div class="input_status">*Já existe</div>
					</div>

					<div>
						<label>Tags</label>
						<input type="text" name="" placeholder="twd,serie de zumbi,mortos que andam">
						<div class="input_status">*Já existe</div>
					</div>

					<fieldset>
						<legend>INFO: Data/Tempo/Qualidade</legend>
						<input type="number" name="" value="2018">
						<input type="number" name="" value="40">
						<select>
							<option>360p</option>
							<option>480p</option>
							<option>720p</option>
							<option>1080p</option>
						</select>
					</fieldset>

					<div>
						<label>Categoria</label>
						<select id="cat1">
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

						<select id="cat2">
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

						<select id="cat3">
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

						<select id="cat4">
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
						<div class="input_status">*Já existe</div>
					</div>
					<div class="add_submit">
						<button>Adicionar</button>
					</div>
				</form>
			</div>
		</div>

		<div class="adm_aside a-2 right">
			<div class="container_adm account">
				<span>Admin <i>luisfeliperm</i></span>
				<a href="#">Editar</a>
				<a href="#">Sair</a>
				
			</div>
		</div>


		</div>



























		<?php
	}
	?>
</div>
</div>
