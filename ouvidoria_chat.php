<?php
				
	//Logo que o usuário entra no sistema, não há nenhuma mensagem escolhida, ou seja, nenhum id. 
	// O teste é feito para que, sempre que um usuário entrar, ele não ver o erro.
	if(empty($_GET['id'])){

		echo '

			<div class="row mt-5 texto-corpo">
			 	<div class="col text-center text-dark font-weight-bold" style="font-size: 1.2rem;">
					Olá, seja bem vindo a nossa ouvidoria!
				</div>
			</div>

			<div class="row mt-5 justify-content-center ">
			 	<div class="col-8 text-center text-dark font-weight-bold texto-corpo" style="font-size: 1.2rem;">
				        Lorem Ipsum é simplesmente um texto fictício da indústria de impressão e composição.
				        LoremIpsum tem sido o texto fictício padrão da indústria desde os anos 1500, quando um 
				        mpressor desconhecido pegou uma galé do tipo e embaralhou para fazer um livro de amostra
				        de tipos.
				</div>
			</div>

			<div class="row mt-5 justify-content-center ">
			 	<div class="col-8 texto-corpo text-center text-dark font-weight-bold" style="font-size: 1.2rem;">
				       Por isso, você pode se sentir a vontade em denúnciar! Estaremos ouvindo.
				</div>
			</div>

		';

	} else {

		//ESSA PARTE FAZ O CABEÇALHO
		//Id da denuncia.
		$id_denuncia = $_GET['id'];

		//Selecionando todas as informações da denuncia referente ao id vindo por get 
		//e executanto com o mysqli_query
		$select_denuncia = "SELECT * FROM denuncia WHERE id_denuncia = $id_denuncia";
		$query_denuncia  = mysqli_query($conectar, $select_denuncia);

		//foreach pegando as informações da denuncia
		foreach ($query_denuncia as $denuncia) {
			$titulo_denuncia    = $denuncia['titulo_denuncia'];
			$anonimato_denuncia = $denuncia['anonimato_denuncia'];
			$id_usuario         = $denuncia['id_usuario'];
			$data_denuncia      = substr( $denuncia['data_denuncia'], 0, 16);
		}

		//Se a denuncia for renomada
		if ($anonimato_denuncia == 2){

			//Selecione as informações do usuario
			$select_usuario = "SELECT * FROM usuario WHERE id_usuario = $id_usuario";
			$query_usuario  = mysqli_query($conectar, $select_usuario);

			//Pegue as informações
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

		//PARTE QUE LISTA O CHAT
		//Selecionando todas as mensagens da denuncia do id vindo por get 
		//e executanto com o mysqli_query
		$select_mensagens = "SELECT * FROM mensagem WHERE id_denuncia = $id_denuncia";
		$query_mensagens  = mysqli_query($conectar, $select_mensagens);

		//foreach pegando as mensagens
		foreach ($query_mensagens as $mensagens) {
			$id_usuario     = $mensagens['id_usuario'];
			$id_mensagem    = $mensagens['id_mensagem'];
			$texto_mensagem = $mensagens['texto_mensagem'];
			$data_mensagem  = $mensagens['data_mensagem'];

			if($id_usuario == $_SESSION['id_usuario']){
				echo '
					<div class="row justify-content-end mt-1">
						<div class="col-6 text-right mb-1">
							<div class="d-inline-flex p-3 vermelho rounded-left texto-corpo" style="background-color: #f35753">
						 		'.$texto_mensagem.'
						 	</div>
				        </div>
				    </div>';
			} else {
				echo '
					<div class="row justify-content-start mt-1">
						<div class="col-6 mb-1 text-left">
							<div class="d-inline-flex p-3 verde rounded-right texto-corpo">
								'.$texto_mensagem.'
							</div>
						</div>
					</div>';
			}

		}//fim do foreach

		$select_arquivos = "SELECT * FROM arquivo_denuncia WHERE id_denuncia = $id_denuncia";
		$query_arquivos  = mysqli_query($conectar, $select_arquivos);

		foreach ($query_arquivos as $arquivos) {
			$endereco_arquivo = $arquivos['endereco_arquivo_denuncia'];
			$tipo_arquivo     = $arquivos['tipo_arquivo_denuncia'];
			$data_arquivo     = $arquivos['data_arquivo_denuncia'];
			$id_usuario       = $arquivos['id_usuario'];

			if($id_usuario == $_SESSION['id_usuario']){
				if($tipo_arquivo == 1){
					echo '
					<div class="row justify-content-end">
						<div class="col-6 text-right mb-1">
								<img src="'.$endereco_arquivo.'"" class="d-block w-100"></img>
						</div>
					</div>';

				} else {
					echo "
					<div class='row justify-content-end'>
						<div class='col-6 text-right mb-1'>
						<audio preload='none' controls='controls'>
			                <source src='".$endereco_arquivo."'/>
			              </audio>
			            </div>
			        </div>";
				}
			} else {
				if($tipo_arquivo == 1){
					echo '
					<div class="row justify-content-start">
						<div class="col-6 text-left mb-1">
								<img src="'.$endereco_arquivo.'"" class="d-block w-100"></img>
						</div>
					</div>';

				} else {
					echo "
					<div class='row justify-content-start'>
						<div class='col-6 text-left mb-1'>
						<audio preload='none' controls='controls'>
			                <source src='".$endereco_arquivo."'/>
			              </audio>
			            </div>
			        </div>";
				}

			}

		}

		//PARTE DO CADASTRO DAS MENSGANS E ARQUIVOS
		echo '
			<!-- Formulário de Mensagem -->
			<form method="post" action="denuncia_mensagem_cadastro.php" enctype="multipart/form-data">
				<div class="row aling-itens-center" style="height: 500px;">
					
					<!-- Input Messagem -->
				    <div class="col-5 m-0 p-0">
				    	<input type="text" 
				    		   name="texto_mensagem" 
				    		   placeholder="Digite Aqui sua Mensagem!"
				    		   class="form-control footer rounded"
				    		   style="position:absolute; bottom:0; width: 100%;"
				    		   required>
				    </div>
				

				    <!-- Hiddem pro ID Denuncia -->
					<input type="hidden" name="id_denuncia" value="'.$id_denuncia.'">

				    <!-- Input Arquivo -->
				    	
							<div class="form-grup col-4 mb-3"> 
								<input type="file" class="form-control" name="foto[]" multiple id="imagem" onchange="previewImagem()">
							</div>			        		
							        	
					<!-- Button -->
					<div class="col-2 m-0 p-0">
							<input type="submit" 
							       class="footer form-control texto-login btn rounded-0" 
							       name="Enviar"
							       style="position:absolute; bottom:0; background-color: #f35753">

					</div>
				</div>

			</form>
	';
	}

?>