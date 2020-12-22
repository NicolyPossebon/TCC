<?php
				
	//Logo que o usuário entra no sistema, não há nenhuma mensagem escolhida, ou seja, nenhum id no GET. 
	//O teste é feito para que, sempre que um usuário entrar, ele não ver um erro.
if(empty($_GET['id'])){

	echo '
		<div class="row mt-5 ml-4 mr-4 justify-content-center" style="background-color: #3CB371; ">
			<div class="col-6 texto-corpo text-center font-weight-bold" style="font-size: 1.2rem; background-color: #fff">
				Olá, seja bem vindo a nossa ouvidoria! 
			</div>
		</div>

		<div class="row mt-5 justify-content-center ">
			<div class="col-8 texto-corpo text-center text-dark" style="font-size: 1.2rem;">
				Aqui, além de acessar as informações e notícias refentes a Coordenação de Ações Inclusiva (CAI) e ao núcleos, 
				você também pode realizar denúncias. Para cadastrá-las, basta clicar no botão "Cadastrar Denuncia", em verde à 
				sua esquerda. Optando pelo anônimato, sua denuncia será encaminha até o ouvidor e o mesmo não terá acesso aos 
				seus dados.
			</div>
		</div>

		<div class="row mt-5 justify-content-center ">
			<div class="col-8 texto-titulo text-center text-dark font-weight-bold" style="font-size: 1.2rem;">
				    Por isso, você pode se sentir a vontade em denúnciar! 
				    <br> Estaremos ouvindo! 
			</div>
		</div>';

} else {

//CABEÇALHO DO CHAT
		
		//Id da denuncia.
		$id_denuncia = $_GET['id'];

		//Selecionando todas as informações da denuncia referente ao id vindo por get e executanto com o mysqli_query.
		$select_denuncia = "SELECT * FROM denuncia WHERE id_denuncia = $id_denuncia";
		$query_denuncia  = mysqli_query($conectar, $select_denuncia);

		//foreach pegando as informações da denuncia.
		foreach ($query_denuncia as $denuncia) {
			$titulo_denuncia    = $denuncia['titulo_denuncia'];
			$anonimato_denuncia = $denuncia['anonimato_denuncia'];
			$id_usuario         = $denuncia['id_usuario'];
			$data_denuncia      = substr( $denuncia['data_denuncia'], 0, 16);
		}

		//Se a denuncia for renomada.
		if ($anonimato_denuncia == 2){

			//Selecione as informações do usuario.
			$select_usuario = "SELECT * FROM usuario WHERE id_usuario = $id_usuario";
			$query_usuario  = mysqli_query($conectar, $select_usuario);

			//Pegue as informações.
			foreach ($query_usuario as $usuario) {
				$email_usuario = $usuario['email_usuario'];
				$nome_usuario  = $usuario['nome_usuario'];
				
				//Imprime as informações na tela.
				echo '
					<div class="row p-3 align-items-center" style="background-color: #716D6D">
						<div class="col text-left text-white" style="text-transform: uppercase; font-weight: 650;">
						'.$nome_usuario.'
						</div>

						<div class="col text-left text-white text-center" style="background-color: #3CB371; text-transform: uppercase; font-weight: 700;">'.$titulo_denuncia.'
						</div>

						<div class="col text-right text-white" style="text-transform: uppercase; font-weight: 650;">
						'.$data_denuncia.'
						</div>
					</div>
				';
			}

		//Se não for renomada, ou seja, anônima
		} else {

				//Imprime o texto padrão
				echo '
					<div class="row p-3 align-items-center" style="background-color: #716D6D">
						<div class="col text-left text-white" style="text-transform: uppercase; font-weight: 650;">
							Denuncia Anônima
						</div>

						<div class="col text-left text-white text-center" style="background-color: #3CB371; text-transform: uppercase; font-weight: 700;">
						'.$titulo_denuncia.'
						</div>

						<div class="col text-right text-white" style="text-transform: uppercase; font-weight: 650;">
						'.$data_denuncia.'
						</div>
					</div>
				';
		}

		//Depois do cabeçalho, há as possiveis sessions que podem aparecer. Essa é a do formato.
		echo '<div class="row justify-content-center mt-4"> 
					<div class="col-sm-9 col-md-8 col-lg-7 text-center"> ';		 
						if(isset($_SESSION['erros_formatos'])) {
							echo "<div class='alert alert-danger texto-corpo' style='font-size: 15px;' role='alert'>";
								echo $_SESSION['erros_formatos'];
							echo "</div>";
						}
		echo "
					</div>
				</div>";

//MENSAGEM DO CHAT.

		//Selecionando todas as mensagens da denúncia e executando o sql.
		$select_mensagem = "SELECT * FROM mensagem WHERE id_denuncia = $id_denuncia";
		$query_mensagem  = mysqli_query($conectar, $select_mensagem);

		//contando quantas mensagens tem.
		$rows_mensagem   = mysqli_num_rows($query_mensagem);

		echo "<div class='container-fluid' style='height: 325px; position: relative; overflow: auto'>";

		//Se houver uma mensagem ou mais, entra no if.
		if($rows_mensagem >= 1){

			//foreach percorrendo a query.
			foreach ($query_mensagem as $mensagem) {
				//Guardando nas variáveis.
				$endereco_mensagem = $mensagem['endereco_mensagem'];
				$tipo_mensagem     = $mensagem['tipo_mensagem'];
				$data_mensagem     = $mensagem['data_mensagem'];
				$id_usuario        = $mensagem['id_usuario'];

				//Se a mensagem do momento for do usuário logado na session, a formatação será diferente de caso não for.
				if($id_usuario == $_SESSION['id_usuario']){
					
					//Se a mensagem é do tipo 0, ou seja, texto.
					if($tipo_mensagem == 0){
						echo '
						<div class="row justify-content-end mt-1">
							<div class="col-6 mt-2 text-right">
								<div class="d-inline-flex p-3 verde rounded-left texto-corpo">
									'.$endereco_mensagem.'
								</div>
							</div>
						</div>';

					//Se a mensagem é do tipo 1, ou seja, imagem.
					}elseif($tipo_mensagem == 1){
						echo '
						<div class="row justify-content-end">
							<div class="col-6 text-right mt-2">
									<img src="'.$endereco_mensagem.'"" class="d-block w-100"></img>
							</div>
						</div>';

					//Se não for nenhuma das duas, significa que é áudio, o que restou.
					} else {
						echo "
						<div class='row justify-content-end'>
							<div class='col-6 text-right mt-2'>
							<audio preload='none' controls='controls'>
				                <source src='".$endereco_mensagem."'/>
				              </audio>
				            </div>
				        </div>";
					}

				//Caso o id da mensagem não bata com o usuário logado.
				} else {

					//0 = texto.
					if($tipo_mensagem == 0){
						echo '
						<div class = "row justify-content-start mt-1">
							<div class = "col-6 mb-2 text-left">
								<div class = "d-inline-flex p-3 vermelho rounded-right texto-corpo">
									'.$endereco_mensagem.' 
								</div>
							</div>
						</div> ';

					//1 = imagem.
					}elseif($tipo_mensagem == 1){
						echo '
						<div class="row justify-content-start">
							<div class="col-6 text-left mt-2">
									<img src="'.$endereco_mensagem.'"" class="d-block w-100"></img>
							</div>
						</div>';

					//2 = áudio.
					} else {
						echo "
						<div class='row justify-content-start'>
							<div class='col-6 text-left mt-2'>
							<audio preload='none' controls='controls'>
				                <source src='".$endereco_mensagem."'/>
				              </audio>
				            </div>
				        </div>";
					}
				}//fim do if dos id.
			}// fim do foreach.
		} else {
			//Caso for 0, não lista nada.
		}
		echo '</div>';

//MENSAGEM.

		echo '
			<hr>
			<!-- Formulário de Mensagem -->
			<form method="post" action="denuncia_mensagem_cadastro.php" enctype="multipart/form-data">
				<div class="row aling-itens-center ml-1 mr-1">
					
					<!-- Input Messagem -->
				    <div class="col-9 m-0 p-0">
				    	<input type="text" required
				    		   name="texto_mensagem" 
				    		   placeholder="Digite Aqui sua Mensagem!"
				    		   class="form-control rounded border-secondary texto-corpo">
				    		   <!--style="position:absolute; bottom:0; width: 100%;" -->
				    </div>
				

				    <!-- Hiddem pro ID Denuncia -->
					<input type="hidden" name="id_denuncia" value="'.$id_denuncia.'">

				    <!-- Input Arquivo -->
				    	
							<div class="form-grup col-1"> 
								<label for="imagem" class="btn text-white" style="background-color: #3CB371;"><i class="fas fa-folder-open"></i></label>
								<input type="file" class="form-control" style="display: none;" name="foto[]" multiple id="imagem" onchange="previewImagem()">
							</div>			        		
							        	
					<!-- Button -->
					<div class="col-2 m-0 p-0">
							<input type="submit" 
							       class=" form-control texto-buttons text-white btn rounded" 
							       name="ENVIAR"
							       style="background-color: #f35753; text-transform: uppercase;">


					</div>
				</div>

			</form>
	';
	}

?>