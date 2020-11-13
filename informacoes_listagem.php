<?php
	//session + banco.
	session_start();
	include_once("conectar.php");
	//Selecionando as descrições.
	$select_descricoes = "SELECT * FROM descricao";
	//Executando o select.
	$query_descricoes  = mysqli_query($conectar, $select_descricoes);
	//Pegando as infos.
	$descricoes        = mysqli_fetch_assoc($query_descricoes);	
?>
<!DOCTYPE html>
<html>
<head>
	<title>Informações</title>
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
		<link href = "https://fonts.googleapis.com/css2? family = Montserrat + Subrayada: wght @ 700 & family = Nanum + Gothic & family = Open + Sans & family = Playball & family = Roboto: ital, wght @ 1.900 & display = swap "rel =" stylesheet ">
		<link href="https://fonts.googleapis.com/css2?family=Katibeh&family=Roboto:ital,wght@0,700;1,300&display=swap" rel="stylesheet">
		<link href="https://fonts.googleapis.com/css2?family=Big+Shoulders+Display:wght@700&family=Katibeh&family=Roboto:wght@400;700&display=swap" rel="stylesheet">
		<link href="https://fonts.googleapis.com/css2?family=Staatliches&display=swap" rel="stylesheet">
	</head>
	<body>

		<header>
			<!-- Navbar -->
			<?php
				include_once('navbar.php')
			?>

			<div class="header-content">
				<h1 style="font-family: 'Staatliches', cursive; font-size: 50px" class="text-white texto-topicos mt-3 mb-4"> BEM VINDO</h1>
				<p class="text-white texto-corpo">Aqui você encontrará informações sobre a Coordenação de Ações Inclusivas e os núcleos do campus Frederico Whestphalen e os Núcelos que a compõe.</p>
				<button class="btn mt-4 texto-buttons" style="background-color: #3CB371;" >SAIBA MAIS</button>
			</div>
		</header>

<!-- CAI -->
		<div class="container mt-5">
			<div class="row texto-topicos justify-content-center mt-4"> A CAI </div>
			<div class="row texto-subtopicos justify-content-center">Conheça mais sobre a CAI do campus Frederico Whestphalen.</div>
			
			<div class="row mt-5">
				<div class="col bg-white text-center">			
					<!-- titulo CAI -->
					<h1 class="mt-5 texto-titulo">COORDENAÇÃO DE AÇÕES INCLUSIVAS</h1><br>	
					<!-- descrição CAI-->
					<p class="texto-corpo text-justify"><?php echo $descricoes['cai_descricao']; ?></p>
					<!-- button -->
					<button type="button" class="btn texto-buttons" style="background-color: #3CB371;" data-toggle="modal" data-target="#cai">SABER MAIS</button>
					<!-- Modal -->
							<div class="modal fade" id="cai" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
							  	<div class="modal-dialog">
							    	<div class="modal-content">
							      		<div class="modal-header">
								      		<h5 class="modal-title texto-corpo" style="font-size: 20px; text-decoration: underline #3CB371;" id="staticBackdropLabel">SAIBA MAIS SOBRE A CAI</h5>
								        	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								          		<span aria-hidden="true">&times;</span>
								        	</button>
							     		</div>
							      		<div class="modal-body">
							      			<p class="text-justify texto-corpo"><?php echo $descricoes['cai_descricao'];?></p>
							       			<br><img class="text-center" src="./img/cai/cai.png">
							      		</div>
									      <div class="modal-footer">
									        <button type="button" style="background-color: #3CB371;" class="btn texto-buttons" data-dismiss="modal">ENTENDIDO</button>
									      </div>
							    	</div>
							  	</div>
							</div>
						
						
					<!-- botão de edição -->
					<?php
						if(empty($_SESSION['tipo_usuario']) || $_SESSION['tipo_usuario'] == 2){
							//não faz nada
						} else if ($_SESSION['tipo_usuario'] == 1){
							echo '	
						  		<!-- Botão de Edição -->		
									<button type="button" class="btn texto-buttons" style="background-color: #3CB371;" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo"> <i class="far fa-edit fa-1x"></i> EDITAR</button>	';
						} 
					?>

					<!-- Modal Edição -->
					<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
						<div class="modal-dialog">
						    <div class="modal-content">
						  		<div class="modal-header text-center">
						        	<h5 class="modal-title texto-corpo"  id="exampleModalLabel">EDITE AS DESCRIÇÕES!</h5>
						        	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						          		<span aria-hidden="true">&times;</span>
						        	</button>
						     	</div>
						      	<div class="modal-body texto-corpo">
						       		<form action="informacoes_editar_back.php" method="post">    
										<label for="#" class="texto-buttons">CAI</label>
										<input type="text" class="form-control" name="descricao_cai" value="<?php echo $descricoes['cai_descricao']; ?>"  placeholder="" required data-length="10">
										<label for="#" class="texto-buttons">NAPNE</label>
										<input type="text" class="form-control" name="descricao_napne" value="<?php echo $descricoes['napne_descricao']; ?>"  placeholder="" required data-length="10">
										<label for="#" class="texto-buttons">NEABI</label>
										<input type="text" class="form-control" name="descricao_neabi" value="<?php echo $descricoes['neabi_descricao']; ?>"  placeholder="" required data-length="10">
										<label for="#" class="texto-buttons">NUGEDIS</label>
										<input type="text" class="form-control" name="descricao_nugedis" value="<?php echo $descricoes['nugedis_descricao']; ?>"  placeholder="" required data-length="10">
										 <button type="button" class="btn mt-2 texto-buttons text-white" style="background-color: #f35753" data-dismiss="modal">CANCELAR</button>
							        	<button type="submit" class="btn mt-2 texto-buttons text-white" style="background-color: #3CB371;">CONFIRMAR</button>
						       		</form>
						      	</div>
						    </div>
						 </div>
					</div>
				</div>

				<!-- Carroseul -->
				<div class="col bg-light shadow-sm">
					<div id="carouselExampleCaptions" class="carousel slide" data-ride="carousel">
					  <ol class="carousel-indicators">
					    <li data-target="#carouselExampleCaptions" data-slide-to="0" class="active"></li>
					    <li data-target="#carouselExampleCaptions" data-slide-to="1"></li>
					    <li data-target="#carouselExampleCaptions" data-slide-to="2"></li>
					  </ol>
					  <div class="carousel-inner">
					    <div class="carousel-item active">
					      <img src="./img/carrousel1.png" class="d-block w-100" alt="...">
					    </div>
					    <div class="carousel-item">
					      <img src="./img/carrousel2.png" class="d-block w-100" alt="...">
					    </div>
					    <div class="carousel-item">
					      <img src="./img/carrousel3.png" class="d-block w-100" alt="...">
					    </div>
					  </div>
					  <a class="carousel-control-prev" href="#carouselExampleCaptions" role="button" data-slide="prev">
					    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
					    <span class="sr-only">Previous</span>
					  </a>
					  <a class="carousel-control-next" href="#carouselExampleCaptions" role="button" data-slide="next">
					    <span class="carousel-control-next-icon" aria-hidden="true"></span>
					    <span class="sr-only">Next</span>
					  </a>
					</div>
				</div>
			</div>
		</div>

<!-- NÚCLEOS -->
		<div class="container-fluid mt-5 mb-5 bg-white">
			<div class="row texto-topicos justify-content-center mt-5"> NÚCLEOS </div>

				<div class="row texto-subtopicos justify-content-center"> 
					Conheça um pouco mais sobre os núcelos. 
				</div>

					<div class="row mt-5 row-cols-1 row-cols-md-3 mb-5">
						
						<!-- NAPNE -->
						<div class="col mb-5 text-center align-items-center">  
							<h1 class="texto-titulo">NAPNE</h1>
							<p class="texto-corpo"><?php echo substr($descricoes['napne_descricao'], 0, 300)."..."; ?></p>
							<button type="button" style="background-color: #3CB371;" class="btn texto-buttons" data-toggle="modal" data-target="#napne">SABER MAIS</button>
							<!-- Modal -->
							<div class="modal fade" id="napne" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
							  	<div class="modal-dialog">
							    	<div class="modal-content">
							      		<div class="modal-header">
								      		<h5 class="modal-title texto-corpo" style="font-size: 20px; text-decoration: underline #3CB371;" id="staticBackdropLabel">SAIBA MAIS SOBRE O NAPNE</h5>
								        	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								          		<span aria-hidden="true">&times;</span>
								        	</button>
							     		</div>
							      		<div class="modal-body">
							      			<p class="text-justify texto-corpo"><?php echo $descricoes['napne_descricao'];?></p>
							       			<br><img class="text-center" src="./img/napne/bandeira_napne.png">
							      		</div>
									      <div class="modal-footer">
									        <button type="button" style="background-color: #3CB371;" class="btn texto-buttons" data-dismiss="modal">ENTENDIDO</button>
									      </div>
							    	</div>
							  	</div>
							</div>
						</div>

						<!--NEABI -->
						<div class="col mb-5 text-center">		
							<h1 class="texto-titulo">NEABI</h1>
							<p class="texto-corpo"><?php echo substr($descricoes['neabi_descricao'], 0, 300)."..."; ?></p>
							<button type="button" style="background-color: #3CB371;" class="btn texto-buttons" data-toggle="modal" data-target="#neabi">SABER MAIS</button>
							<!--Modal -->
							<div class="modal fade" id="neabi" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
							  	<div class="modal-dialog">
							    	<div class="modal-content">
							      		<div class="modal-header">
								      		<h5 class="modal-title texto-corpo" style="font-size: 20px; text-decoration: underline #3CB371;" id="staticBackdropLabel">SAIBA MAIS SOBRE O NEABI</h5>
								        	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								          		<span aria-hidden="true">&times;</span>
								        	</button>
							     		</div>
							      		<div class="modal-body">
							      			<p class="text-justify texto-corpo"><?php echo $descricoes['neabi_descricao'];?></p>
							       			<br><img class="text-center" src="./img/neabi/bandeira_neabi.png">
							      		</div>
									      <div class="modal-footer">
									        <button type="button" style="background-color: #3CB371;" class="btn texto-buttons" data-dismiss="modal">ENTENDIDO</button>
									      </div>
							    	</div>
							  	</div>
							</div>
						</div>
						
						<!-- NUGEDIS -->
						<div class="col mb-5 text-center">
							<h1 class="texto-titulo">NUGEDIS</h1>
							<p class="texto-corpo"><?php echo substr($descricoes['nugedis_descricao'], 0, 300)."..."; ?></p>
							<button type="button" style="background-color: #3CB371;" class="btn texto-buttons" data-toggle="modal" data-target="#nugedis">SABER MAIS</button>
			
							<!-- Modal -->
							<div class="modal fade" id="nugedis" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
							  	<div class="modal-dialog">
							    	<div class="modal-content">
							      		<div class="modal-header">
								      		<h5 class="modal-title texto-corpo" style="font-size: 20px; text-decoration: underline #3CB371;" id="staticBackdropLabel">SAIBA MAIS SOBRE O NUGEDIS</h5>
								        	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								          		<span aria-hidden="true">&times;</span>
								        	</button>
							     		</div>
							      		<div class="modal-body">
							      			<p class="text-justify texto-corpo"><?php echo $descricoes['nugedis_descricao'];?></p>
							       			<br><img class="text-center" src="./img/nugedis/banderia_nugedis.png">
							      		</div>
									      <div class="modal-footer">
									        <button type="button" style="background-color: #3CB371;" class="btn texto-buttons" data-dismiss="modal">ENTENDIDO</button>
									      </div>
							    	</div>
							  	</div>
							</div>
						</div>
				</div>
			</div>
			
<!-- NOTÍCIAS -->
	<div class="container-fluid">
		<div class="row texto-topicos justify-content-center mt-4">AS NOTÍCIAS</div>
			<div class="row texto-subtopicos justify-content-center mb-4">Por aqui você pode acompanhar as notícias da coordenação.</div>
	
			<?php	
				
				$select_noticia = "SELECT * FROM noticia ORDER BY id_noticia DESC LIMIT 3";
				$query_noticia = mysqli_query($conectar, $select_noticia);

				echo '<div class="row row-cols-1 row-cols-md-3 mb-5 pt-3 mr-3 ml-3">';
			    foreach ($query_noticia as $dados_noticia) {
			    	$id_noticia        = $dados_noticia['id_noticia'];
			    	$titulo_noticia    = $dados_noticia['titulo_noticia'];
			    	$data_noticia      = $dados_noticia['data_noticia'];
			    	$descricao_noticia = substr($dados_noticia['descricao_noticia'], 0, 125);

			    	$select_arquivo = "SELECT * FROM arquivo_noticia 
			    					   WHERE id_noticia = $id_noticia 
			    					   ORDER BY id_arquivo_noticia ASC LIMIT 1";
			    	$query_arquivo  = mysqli_query($conectar, $select_arquivo);
			    	$rows = mysqli_num_rows($query_arquivo);

			    	if($rows > 0) {
				    	foreach ($query_arquivo as $dados_arquivo) {
				    		$endereco_arquivo = $dados_arquivo['endereco_arquivo_noticia'];
				    		$tipo_arquivo     = $dados_arquivo['tipo_arquivo_noticia'];	

				    		//Se for imagem.
							if($tipo_arquivo == 1){
							   echo ' 
						  			<div class="col mb-4">
									    <div class="card shadow rounded">
									      <img src="'.$endereco_arquivo.'" class="card-img-top" style=" width: 100%;
				  						height: 250px;" alt="...">
									      <div class="card-body text-center">
									        <h5 class="card-title texto-corpo">'.$titulo_noticia.'</h5>
									        <p class="card-text text-justify texto-corpo">'.$descricao_noticia.'...</p>
									        <a href="noticia_vermais_front.php?id_noticia='.$id_noticia.'" class="btn texto-buttons" style="background-color: #3CB371;"> VER MAIS</a>
									        </div>
									    </div>
							    </div>';
							//Se for áudio.
							} else if($tipo_arquivo == 2){
								echo ' 
						  			<div class="col mb-4">
									    <div class="card shadow rounded">
									      <img src="./img/audio.png" class="card-img-top" style=" width: 100%;
				  						height: 250px;" alt="...">
									      <div class="card-body text-center">
									        <h5 class="card-title texto-corpo">'.$titulo_noticia.'</h5>
									        <p class="card-text text-justify texto-corpo">'.$descricao_noticia.'...</p>
									        <a href="noticia_vermais_front.php?id_noticia='.$id_noticia.'" class="btn texto-buttons" style="background-color: #3CB371;"> VER MAIS</a>
									        </div>
									    </div>
							    	</div>';

							//Se for vídeo.
							} else if($tipo_arquivo == 3){
								echo ' 
						  			<div class="col mb-4">
									    <div class="card shadow rounded">
									      <img src="./img/video.png" class="card-img-top" style=" width: 100%;
				  						height: 250px;" alt="...">
									      <div class="card-body text-center">
									        <h5 class="card-title texto-corpo">'.$titulo_noticia.'</h5>
									        <p class="card-text text-justify texto-corpo">'.$descricao_noticia.'...</p>
									       <a href="noticia_vermais_front.php?id_noticia='.$id_noticia.'" class="btn texto-buttons" style="background-color: #3CB371;"> VER MAIS</a>
									        </div>
									    </div>
							    	</div>';

							}
						}//fim do foreache
					//Se não tiver nenhum tipo, é texto
			   		} else if ($rows == 0) {
						echo ' 
				  			<div class="col mb-4">
							    <div class="card shadow rounded">
							      <img src="./img/texto.png" class="card-img-top" style=" width: 100%;
		  						height: 250px;" alt="...">
							      <div class="card-body text-center">
							        <h5 class="card-title texto-corpo"> NI E DI </h5>
							        <p class="card-text text-justify texto-corpo">'.$descricao_noticia.'...</p>
							        <a href="noticia_vermais_front.php?id_noticia='.$id_noticia.'" class="btn texto-buttons" style="background-color: #3CB371;"> VER MAIS</a>
							        </div>
							    </div>
					    	</div>';
					}
				}//fim do foreach
			    echo "</div> </div>";
			// Rodapé 
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