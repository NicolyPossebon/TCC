<?php 

    //MINI PERFIL

	//Id do usuario.
	$id_usuario = $_SESSION['id_usuario'];

	//Pegando informações referentes oa id da sessão.
	$select_usuario      = "SELECT * FROM usuario WHERE id_usuario = $id_usuario";
	$query_usuario       = mysqli_query($conectar, $select_usuario);
	$informacoes_usuario = mysqli_fetch_array($query_usuario);

	//Listando as informações obtidas no select
	echo '
		<div class="row">
			<div class="col text-center">
				<i class="fas fa-user-circle fa-6x mt-3"></i>
			</div>
		</div>
		<div class="row">
			<div class="col text-center">
				'.$informacoes_usuario['nome_usuario'].'
			</div>
		</div>
		<div class="row">
			<div class="col text-center">
				'.$informacoes_usuario['email_usuario'].'
				<hr>
			</div>
		</div>

	';

    //BOTÃO DE CADASTRO + FORM DE CADASTRO DA DENU

    //Se o usuario é do tipo 2, é um usuário "comum".
	if($_SESSION['tipo_usuario'] == 2){
		
		echo '

			<!-- Botão que "chama" o formulário de cadastro. -->
			<div class="row">
				<div class="col">
					<button type="button" 
							id="mostrar-form" 
							class="btn btn-lg btn-block btn-outline-success texto-login mt-2 mb-2"> 
						<i class="fas fa-plus mr-2"></i>
					    Cadastrar Denúncia
					</button>
				</div>
			</div>

			<!-- Form de Cadastro. -->
			<form id="cadastrar" action="denuncia_cadastro.php" method="post" style="display:none">
				
				<!-- Título.-->
				<div class="row text-center">
					<div class="col-12">
						<input type="text" 
						       class="form-control mt-2" 
						       placeholder="De um Título a Denúncia" 
						       name="titulo_denuncia" required>
					</div>
			    </div>
								  
				<!-- Anonimato.-->
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
								    
				<!-- Button. -->
				<div class="row justify-content-center">
					<div class="col-10">					    
						<input type="submit" class="btn btn-block btn-outline-success mt-2 mb-2 texto-login" value="Cadastrar">
						<hr>
					</div>
			    </div>
			</form> ';

		//LISTAGEM DAS DENÚNCIA 

		//como o usuário não é adm, só as suas denuncias devem ser selecionadas
		$select = "SELECT * FROM  denuncia
				   WHERE id_usuario = $id_usuario 
			       ORDER BY data_denuncia DESC";

		//query exeutando o select
		$query = mysqli_query($conectar, $select);

		//foreach pra conseguir as infos da denuncia
		foreach ($query as $denuncia) {
			echo $id              = $denuncia['id_denuncia'];
			$titulo_denuncia = $denuncia['titulo_denuncia'];

		    //Listagem do titulo das denúncias.
			echo '
			<div class="row">
					<div class="col-2 mr-0 pr-0">
						<a  href="#" 
		                    class="btn btn-outline-dark rounded-0 btn-block texto-login mb-2 text-center" 
		                    data-toggle="collapse" 
						    data-target="#collapseExample'.$id.'"
			                role="button" 
			                aria-expanded="false" 
						    aria-controls="collapseExample'.$id.'">
						<i class="fas fa-caret-down"></i>
						</a>
		            </div>
						              
					<div class="col-10 ml-0 pl-0">
						<a  href="ouvidoria_front.php?id='.$id.'" 
						    class="btn btn-outline-dark btn-block rounded-0 texto-login mb-2 text-center">
						    '.$titulo_denuncia.'
						</a>
		           </div>		
  				</div>

  				<!-- Botões do CRUD. -->	
  				<div class="row mb-2 collapse" id="collapseExample'.$id.'">
  					<div class="col-6">
						<a href=""  
						   class="btn btn-outline-warning texto-login btn-block"
						   data-toggle="modal" data-target="#exampleModal" data-whateverid="'.$id.'"
						   data-whatevertitulo="'.$titulo_denuncia.'">
						<i class="fas fa-pen mr-1"></i>
						Editar 
						</a>
					</div>
									
					<div class="col-6">
						<a href="denuncia_excluir.php?id='.$id.'"
						   class="btn btn-block texto-login btn-outline-danger"
						   data-confirm="Tem certeza que deseja excluir essa denúncia?">
						Excluir
						<i class="fas fa-trash ml-1"></i> 
						</a>
					</div>
				</div>

				<!-- MODAL -->
					<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  						<div class="modal-dialog">
    						<div class="modal-content">
      							<div class="modal-header"> 
       								<h5 class="modal-title" id="exampleModalLabel">Editar Denúncia</h5>
        							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
          								<span aria-hidden="true">&times;</span>
        							</button>
      							</div>
      							<div class="modal-body">
       								<form method="post" action="denuncia_edicao.php">
          								<div class="form-group">
								            <label for="recipient-name" class="col-form-label">Título da Denúncia</label>
								            <input type="text" class="form-control" name="titulo_denuncia" id="recipienttitulo">
								        </div>
     										<input type="hidden" name="id_denun" id="recipientid">
		     		      				<div class="modal-footer">
									        <button type="submit" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
									        <button type="submit" class="btn btn-primary">Editar</button>
		      							</div>
        							</form>
							      </div>
							    </div>
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

		//Função para aparecer a caixinha de confiramção para excluir a denuncia
		  $(document).ready(function(){
			$('a[data-confirm]').click(function(ev){
				var href = $(this).attr('href');
				if(!$('#confirm-delete').length){
					$('body').append('<div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"><div class="modal-dialog"><div class="modal-content"><div class="modal-header bg-danger text-white">EXCLUIR ITEM<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button></div><div class="modal-body">Tem certeza de que deseja excluir esta denúncia?</div><div class="modal-footer"><button type="button" class="btn btn-success" data-dismiss="modal">Cancelar</button><a class="btn btn-danger text-white" id="dataComfirmOK">Apagar</a></div></div></div></div>');
				}
				$('#dataComfirmOK').attr('href', href);
		        $('#confirm-delete').modal({show: true});
				return false;
				
			});
		});

		//Função para editar com modal
		$('#exampleModal').on('show.bs.modal', function (event) {
		  var button = $(event.relatedTarget) // Button that triggered the modal
		  var recipientid     = button.data('whateverid') // Extract info from data-* attributes
		  var recipienttitulo = button.data('whatevertitulo')
		  // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
		  // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
		  var modal = $(this)
		  modal.find('.modal-title').text('New message to ' + recipient)
		  modal.find(#recipientid).val(recipientid)
		  modal.find(#recipienttitulo).val(recipienttitulo)
		})


    </script>