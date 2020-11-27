<?php
	//session + banco.
	session_start();
	include_once("conectar.php");

	//ID da notícias escolhida.
	$id_noticia = $_GET['id_noticia'];

	//Select pegando todas as infos dela.
	$select_noticia = "SELECT * FROM noticia WHERE id_noticia = $id_noticia";

	//Query executando o select.
	$query_noticia = mysqli_query($conectar, $select_noticia);

	//Transformando os dados da noticia em array.
	$noticia = mysqli_fetch_assoc($query_noticia);
?>

<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<title>Notícias</title>

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
		<!-- JQuery -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
		<!-- Fontes -->
		<link href = "https://fonts.googleapis.com/css2? family = Montserrat + Subrayada: wght @ 700 & family = Nanum + Gothic & family = Open + Sans & family = Playball & family = Roboto: ital, wght @ 1.900 & display = swap "rel =" stylesheet ">
		<link href="https://fonts.googleapis.com/css2?family=Katibeh&family=Roboto:ital,wght@0,700;1,300&display=swap" rel="stylesheet">
		<link href="https://fonts.googleapis.com/css2?family=Big+Shoulders+Display:wght@700&family=Katibeh&family=Roboto:wght@400;700&display=swap" rel="stylesheet">
		<link href="https://fonts.googleapis.com/css2?family=Staatliches&display=swap" rel="stylesheet">

	</head>
	<body>			

		<!-- navbar -->
		<?php
			include("navbar.php");
		?>

		<div class="container">
			<div class="row justify-content-center mb-5 pt-2 mt-2 ">
				<div class="col-sm-12 col-md-10 col-lg-10 p-3 mt-4 rounded-lg text-center">

					<!-- TÍTULO -->
					<div class="row">
						<div class="col">
							<p class="titulo text-center texto-titulo" style=" text-transform: uppercase; font-weight: 700;"><?php echo $noticia['titulo_noticia'];?></p>
						</div>
					</div>
					
					<!-- DATA -->
					<div class="row">
						<div class="col">
							<p class="text-left data texto-corpo">Publicado em <?php echo substr($noticia['data_noticia'], 0, 16) ?></p>
						</div>
					</div>

					<!-- MÍDIAS -->
					<?php

						//Select pegando todos os arquivos do tipo 1 (foto).
						$select_foto = "SELECT * FROM arquivo_noticia WHERE id_noticia = $id_noticia and tipo_arquivo_noticia = 1";

						//Query executando o select.
						$query_foto = mysqli_query($conectar, $select_foto);

						//contando o número de retornos.
						$rows = mysqli_num_rows($query_foto);

						//Se houver algum, faz o carrossel.
						if($rows >= 1){
								
							echo ' 
								<div class="row">
									<div class="col">
										<div id="carouselExampleControls" class="carousel slide"              data-ride="carousel">
											<div class="carousel-inner"> ';

											  	//
											  	foreach($query_foto as $key => $midia){
											  		
											  		if($key == 0){	
			               								echo "
			               									<div class='carousel-item active'>
			               										<img src='".$midia['endereco_arquivo_noticia']."' class='d-block w-100'></img>
			                 								</div> ";			
			             								} else {
			             									echo $key;
			                								echo "
			                								<div class='carousel-item'>
			                									<img src='".$midia['endereco_arquivo_noticia']."' class='d-block w-100'></img>
			                 								</div> ";		
			              								}
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
							} 

							//OBS: foi necessário separar as consultas de foto das de áudio e vídeo pois estava acontecendo  erro na key do foreach. O problema só acontecia quando havia mais de um tipo de mídia, por isso separei as consultas e deu certo.

							//Select puxando todos os tipos, menos o 1 que é foto.
							$select_arquivos = "SELECT * FROM arquivo_noticia
												WHERE id_noticia = $id_noticia and tipo_arquivo_noticia != 1";

							//Query executando.
							$query_arquivos = mysqli_query($conectar, $select_arquivos);

							//Foreach percorrendo.
							foreach ($query_arquivos as $tipoarquivos) {
							
								//2 = Aúdio.
								if ($tipoarquivos['tipo_arquivo_noticia'] == 2){
		               				echo "
		                 				<div class='row'>
		                 					<div class='col'>
		                 						<br>
		                 							<audio preload='none' controls='controls'>
		                         			  			<source src='".$tipoarquivos['endereco_arquivo_noticia']."'/>
		                        			 		</audio> <br>
		                        			 	<br>
		                        			</div>
		                        		</div>";
	              			
	              				//3 = Vídeo.
	              				} else if($tipoarquivos['tipo_arquivo_noticia'] == 3){		
									echo '
										<div class="row mt-3">
											<div class="col">
												<iframe width="560" height="315" src="'.$tipoarquivos['endereco_arquivo_noticia'].'" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen>
												</iframe>
											</div>
										</div>';
								}
							}
						?>

					
					<!-- DESCRIÇÃO -->
					<div class="row">
						<div class="col">
							<p class="texto text-justify texto-corpo"><?php echo $noticia['descricao_noticia'];?></p>
						</div>
					</div>

					<!-- BOTÕES -->
					<?php 
						if(empty($_SESSION['tipo_usuario']) || $_SESSION['tipo_usuario'] == 2){
							//Se eu coloco pra testar $_SESSION['tipo_usuario'] == 1, que seria o adm, quando não a session, ou seja, quando não há ninguém logado, apresenta erro.
						} else {
							echo '
								<div class="row">
									<div class="col text-center">
							 			<a class="btn rounded botoes texto-buttons text-white" style="background-color: #3CB371;" href="noticias_editar_front.php?id_noticia='.$id_noticia.'">
											<i class="far fa-edit fa-1x"></i> 		
											EDITAR		
										</a>
							 			<a class="btn rounded vermelho botoes texto-buttons text-white" 
							 			   href="noticia_excluir_back.php?id='.$id_noticia.'" 
							 			   data-confirm="Tem certeza que deseja excluir o item selecionado?">
							 				<i class="far fa-trash-alt fa-1x"></i>
							 				EXCLUIR
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
		//Função para aparecer a caixinha de confiramção para excluir a denuncia.
		  $(document).ready(function(){
			$('a[data-confirm]').click(function(ev){
				var href = $(this).attr('href');
				if(!$('#confirm-delete').length){
					$('body').append('<div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"><div class="modal-dialog"><div class="modal-content"><div class="modal-header texto-buttons">EXCLUIR ITEM<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button></div><div class="modal-body texto-corpo">Tem certeza de que deseja excluir esta denúncia?</div><div class="modal-footer"><button type="button" class="btn texto-buttons text-white" style="background-color: #3CB371" data-dismiss="modal">CANCELAR</button><a class="btn texto-buttons text-white" style="background-color: #B22222" id="dataComfirmOK">APAGAR</a></div></div></div></div>');
				}
				$('#dataComfirmOK').attr('href', href);
		        $('#confirm-delete').modal({show: true});
				return false;
				
			});
		});
		</script>
		
		<!-- RODAPÉ -->
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
