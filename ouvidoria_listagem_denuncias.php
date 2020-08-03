<?php 

	$id_usuario = $_SESSION['id_usuario'];

	if($_SESSION['tipo_usuario'] == 2){
		
		echo '

			<!-- BOTÃO QUE "CHAMA O FORM DE CADASTRO" -->
			<div class="row">
				<div class="col">
					<button type="button" 
							id="mostrar-form" 
							class="btn btn-lg btn-block btn-outline-success texto-login mt-3 mb-2"> 
						<i class="fas fa-plus mr-2"></i>
					    Cadastrar Denúncia
					</button>
				</div>
			</div>

			<!-- FORM DE CADASTRO -->
			<form id="cadastrar" action="denuncia_cadastro.php" method="post" style="display:none">
				
				<!--TÍTULO -->
				<div class="row text-center">
					<div class="col-12">
						<input type="text" 
						       class="form-control mt-2" 
						       placeholder="De um Título a Denúncia" 
						       name="titulo_denuncia" required>
					</div>
			    </div>
								  
				<!-- ANONIMATO-->
			    <div class="row justify-content-center">
					<div class="col-5">
						<input type="radio" required name="anonimato_denuncia" value="1"> 
						Anônima
					</div>
					<div class="col-5 text-right">
						<input type="radio" required name="anonimato_denuncia" value="2"> 
							Renomada
					</div>
			    </div>
								    
				<!-- BUTTON -->
				<div class="row justify-content-center">
					<div class="col-10">					    
						<input type="submit" class="btn btn-block btn-outline-success mt-2 mb-2 texto-login" value="Cadastrar">
						<hr>
					</div>
			    </div>
			</form> ';

		//como o usuário não é adm, só as suas denuncias devem ser selecionadas
		$select = "SELECT * FROM  denuncia
				   WHERE id_usuario = $id_usuario 
			       ORDER BY data_denuncia DESC";

		//query exeutando o select
		$query = mysqli_query($conectar, $select);

		//foreach pra conseguir as infos da denuncia
		foreach ($query as $denuncia) {
			$id              = $denuncia['id_denuncia'];
			$titulo_denuncia = $denuncia['titulo_denuncia'];

		//Listagem do titulo das denúncias + opção de CRUD
			echo '
				
				<!-- CRUD -->
				<div class="row">
					<div class="col-3">
						<a  href="#" 
		                    class="btn btn-outline-dark btn-block texto-login mb-2 text-center" 
		                    data-toggle="collapse" 
						    data-target="#collapseExample'.$id.'"
			                role="button" 
			                aria-expanded="false" 
						    aria-controls="collapseExample'.$id.'">
						'.$id.'
						</a>
		            </div>
						              
					<div class="col-9">
						<a  href="ouvidoria_front.php?id='.$id.'" 
						    class="btn btn-outline-dark btn-block texto-login mb-2 text-center">
						    '.$titulo_denuncia.'
						</a>
		           </div>		
  				</div>

  								
  				<div class="row mb-2 collapse" id="collapseExample'.$id.'">
  					<div class="col-6">
						<a href="#"  
						   class="btn btn-outline-warning texto-login btn-block">
						<i class="fas fa-pen mr-1"></i>
						Editar 
						</a>
					</div>
									
					<div class="col-6">
						<a href="#"
						   class="btn btn-block texto-login btn-outline-danger">
						Excluir
						<i class="fas fa-trash ml-1"></i> 
						</a>
					</div>

				</div>';
		}//fim do foreach.
						
						
		//Se o usuário for adm...
		} else if($_SESSION['tipo_usuario'] == 1){
					
			//Selecionando informações de todas as denúncias.
			$select = "SELECT * FROM denuncia 
			           ORDER BY data_denuncia DESC";
			
			//query executando o select.		
			$query = mysqli_query($conectar, $select);

			//foreache pra obter as informações.
			foreach ($query as $denuncia) {
				$id              = $denuncia['id_denuncia'];
				$titulo_denuncia = $denuncia['titulo_denuncia'];

 				//Listagem dos títulos
				echo '
					<div class="row">
						<div class="col">
							<a  href="ouvidoria_front.php?id='.$id.'" 
						        class="btn btn-outline-dark btn-block texto-login mb-2 text-center">
						        '.$titulo_denuncia.'
			                </a>
  						</div>
  					</div>';

			}//fim do foreach.

		}//fim do else if
						
?>

	<script>
		//Função toggle + evento click responsável
		//pelo efeito do cadastro da denúncia
		$("#mostrar-form").click(function () {
			$("#cadastrar").toggle();
		})
    </script>