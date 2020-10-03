<?php
	
	session_start();
	include_once("conectar.php");

	//ID da notícias escolhida.
	$id_noticia = $_GET['id_noticia'];

	//Select pegando todas as infos dela.
	$select_noticia = "SELECT * FROM noticia WHERE id_noticia = $id_noticia";

	//Query executando o select.
	$query_noticia = mysqli_query($conectar, $select_noticia);

	//Foreach percorrendo elas;
	foreach ($query_noticia as $dados_noticia) {
		$titulo_noticia    = $dados_noticia['titulo_noticia'];
		$descricao_noticia = $dados_noticia['descricao_noticia'];
		$data_noticia      = $dados_noticia['data_noticia'];	
	}

?>

<!DOCTYPE html>

<html lang="pt-br">

	<head>

		<title>Notícia X</title>

			<!-- Meta tag Obrigatória -->
		    <meta charset="utf-8">
		    <!-- Meta tag responsiva -->
		    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

		    <!-- Link Bootstrap -->
		    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous"> 
		    <!-- Link dos Icons -->
		    <link rel="stylesheet" type="text/css" href="icons/css/all.css">
		    <!-- CSS -->
		    <link rel="stylesheet" type="text/css" href="./css/style.css">
			<!-- Fontes -->
			<link href="https://fonts.googleapis.com/css?family=Catamaran:100,200,300,400,500,600,700,800,900" rel="stylesheet">
			<link href="https://fonts.googleapis.com/css?family=Lato:100,100i,300,300i,400,400i,700,700i,900,900i" rel="stylesheet">
			<!-- JQuery -->
			<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

	</head>
	<body>			

		<?php
			include("navbar.php");
		?>

		<div class="container">
			<div class="row justify-content-center mb-5 pt-2 mt-2 bg-primary ">
				<div class="col-sm-12 col-md-10 col-lg-10 p-3 mt-4 rounded-lg text-center bg-success">

					<!-- Título -->
					<div class="row">
						<div class="col">
							<p class="titulo text-center"><?php echo $titulo_noticia; ?></p>
						</div>
					</div>
					
					<!-- Data -->
					<div class="row">
						<div class="col">
							<p class="text-left data">Publicado em <?php echo substr($data_noticia, 0, 16) ?></p>
						</div>
					</div>

					<!-- Foto -->
					<?php
						//Select pegando todos os arquivos relacionados a notícia.
						$select_arquivo = "SELECT * FROM arquivo_noticia WHERE id_noticia = $id_noticia";

						//Query executando o select.
						$query_arquivo = mysqli_query($conectar, $select_arquivo);

							//Foreach percorrendo os dados.
							foreach ($query_arquivo as $tipo) {
								
								//Se for == 1, é foto, logo o carrousel é implementado.
								if($tipo['tipo_arquivo_noticia'] == 1){
									
									echo ' 
									<div class="row">
										<div class="col">
											<div id="carouselExampleControls" class="carousel slide"              data-ride="carousel">
											  	<div class="carousel-inner"> ';

											  		//
												  	foreach($query_arquivo as $key => $midia){

												  		if($key == 0){
			               									echo "<div class='carousel-item active'>";			
			             								} else {
			                								echo "<div class='carousel-item'>";		
			              								}

			              								echo "
			              								<img src='".$midia['endereco_arquivo_noticia']."' class='d-block w-100'></img>
			                 							</div> ";
												  	}
													echo'   
													
													  <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
													    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
													    <span class="sr-only">Previous</span>
													  </a>
													  <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
													    <span class="carousel-control-next-icon" aria-hidden="true"></span>
													    <span class="sr-only">Next</span>
													  </a>
												</div>
											</div>
										</div>
									</div> '; 

								// Se o tipo == 2, Áudio;
								

							} else if ($tipo['tipo_arquivo_noticia'] == 2){
		               				echo "
		                 				<div class='row'>
		                 					<div class='col bg-danger'>
		                 						<br>
		                 							<audio preload='none' controls='controls'>
		                         			  			<source src='".$tipo['endereco_arquivo_noticia']."'/>
		                        			 		</audio> <br>
		                        			 	<br>
		                        			</div>
		                        		</div>";
	              			
	              				//Se o tipo == 3, vídeo
	              				} else if($tipo['tipo_arquivo_noticia'] ==3){	
									echo $tipo['endereco_arquivo_noticia'];	
									echo '
										<div class="row mt-3">
											<div class="col">
												<iframe width="560" height="315" src="'.$tipo['endereco_arquivo_noticia'].'" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
											</div>
										</div>';
								}
							}
						?>

					
					<!-- Descrição -->
					<div class="row">
						<div class="col">
							<p class="texto text-justify"><?php echo $descricao_noticia; ?></p>
						</div>
					</div>


					<?php 

						if(empty($_SESSION['tipo_usuario']) || $_SESSION['tipo_usuario'] == 2){
							//faz nada
						} else {
							echo '
								<!-- Botões -->
								<div class="row">
									<div class="col text-center">
							 			<a class="btn rounded vermelho botoes" href="noticias_editar_front.php?id_noticia='.$id_noticia.'">
											<i class="far fa-edit fa-1x"></i> 		
											Editar		
										</a>
							 			<a class="btn rounded vermelho botoes" 
							 			   href="noticia_excluir_back.php?id='.$id_noticia.'" 
							 			   data-confirm="Tem certeza que deseja excluir o item selecionado?">
							 				<i class="far fa-trash-alt fa-1x"></i>
							 				Excluir
							 			</a>
									</div>
								</div>
							';
						}
					?>
						
				</div>
			</div>
		</div>
		

		<script type="text/javascript">
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
		</script>
		

		<?php
			include("rodape.php");
		?>

  		<!-- Icons -->
  		<script type="text/javascript" src="icons/js/all.js"></script> 
	    <!-- Bootstrap: jQuery, Popper.js, Plugin JS  -->
	    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
	    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
	    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
	</body>
</html>
