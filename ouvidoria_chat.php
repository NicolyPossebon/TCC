
			<?php
				
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
				}


				//cabeçalho com informações do usuario

				} else {

				//cabeçalho sem as informações

				}



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
							<div class="row justify-content-end">
								<div class="col-6 text-right mb-1">
									<div class="d-inline-flex p-3 vermelho rounded-left">
						 				'.$texto_mensagem.'
						 			</div>
						        </div>
						    </div>';
					} else {
						echo '
							<div class="row justify-content-start">
								<div class="col-6 mb-1 text-left">
									<div class="d-inline-flex p-3 verde rounded-right">
										'.$texto_mensagem.'
									</div>
								</div>
							</div>
						';
					}

				}//fim do foreach

			?>
	



			<!-- Formulário de Mensagem -->
			<form method="post" action="denuncia_mensagem_cadastro.php">
				<div class="row aling-itens-center" style="height: 500px;">
					
					<!-- Input Messagem -->
				    <div class="col-10 m-0 p-0">
				    	<input type="text" 
				    		   name="texto_mensagem" 
				    		   class="form-control footer rounded-0"
				    		   style="position:absolute; bottom:0; width: 100%;"
				    		   required>
				    </div>
						        		
					<!-- Hiddem pro ID Denuncia -->
					<input type="hidden" name="id_denuncia" value="<?php echo $id_denuncia; ?>">
							        	
					<!-- Button -->
					<div class="col-2 m-0 p-0">
							<input type="submit" 
							       class="footer form-control texto-login btn btn-success rounded-0" 
							       name="Enviar"
							       style="position:absolute; bottom:0;">
					</div>
				</div>

			</form>
	
