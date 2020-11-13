<?php 
	session_start();
	include ("conectar.php");
?>

<!DOCTYPE html>
<html>
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
		<!-- Fontes -->
		<link href = "https://fonts.googleapis.com/css2? family = Montserrat + Subrayada: wght @ 700 & family = Nanum + Gothic & family = Open + Sans & family = Playball & family = Roboto: ital, wght @ 1.900 & display = swap "rel =" stylesheet ">
		<link href="https://fonts.googleapis.com/css2?family=Katibeh&family=Roboto:ital,wght@0,700;1,300&display=swap" rel="stylesheet">
		<link href="https://fonts.googleapis.com/css2?family=Big+Shoulders+Display:wght@700&family=Katibeh&family=Roboto:wght@400;700&display=swap" rel="stylesheet">
		<link href="https://fonts.googleapis.com/css2?family=Staatliches&display=swap" rel="stylesheet">


</head>
<body>

	
	<?php
		// NAVBAR 
		include_once("navbar.php");


		if(empty($_SESSION['tipo_usuario']) || $_SESSION['tipo_usuario'] == 2){
			//não faz nada
		} else if ($_SESSION['tipo_usuario'] == 1){
		echo '	
		<div class="container">
			<div class="row justify-content-center">
  				<div class="col-10 mb-1 mt-4 ">
  					<a href="noticias_cadastro_front.php" class="btn botoes-texto texto-buttons cinza shadow btn-lg btn-block" style="font-size: 20px;">
  						Cadastrar Nova Notícia
  					</a>
				</div>
			</div>
		</div>';
		}

		

		$select_noticia = "SELECT * FROM noticia ORDER BY id_noticia DESC";
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


	    	   if($tipo_arquivo == 1){
			   		echo ' 
		  			<div class="col mb-4">
					    <div class="card shadow rounded">
					      <img src="'.$endereco_arquivo.'" class="card-img-top" style=" width: 100%;
  						height: 250px;" alt="...">
					      <div class="card-body text-center">
					        <h5 class="card-title texto-corpo" style="text-transform: uppercase">'.$titulo_noticia.'</h5>
					        <p class="card-text text-justify texto-corpo">'.$descricao_noticia.'...</p>
					        <a href="noticia_vermais_front.php?id_noticia='.$id_noticia.'" class="btn texto-buttons"  style="background-color: #f35753"> VER MAIS</a>
					        </div>
					    </div>
			    	</div>';
				} else if($tipo_arquivo == 2){
					echo ' 
		  			<div class="col mb-4">
					    <div class="card shadow rounded">
					      <img src="./img/audio.png" class="card-img-top" style=" width: 100%;
  						height: 250px;" alt="...">
					      <div class="card-body text-center">
					        <h5 class="card-title">'.$titulo_noticia.'</h5>
					        <p class="card-text text-justify">'.$descricao_noticia.'...</p>
					        <a href="noticia_vermais_front.php?id_noticia='.$id_noticia.'" class="btn texto-buttons"  style="background-color: #f35753"> VER MAIS</a>
					        </div>
					    </div>
			    	</div>';

				} else if($tipo_arquivo == 3){
					echo ' 
		  			<div class="col mb-4">
					    <div class="card shadow rounded">
					      <img src="./img/video.png" class="card-img-top" style=" width: 100%;
  						height: 250px;" alt="...">
					      <div class="card-body text-center">
					        <h5 class="card-title">'.$titulo_noticia.'</h5>
					        <p class="card-text text-justify">'.$descricao_noticia.'...</p>
					        <a href="noticia_vermais_front.php?id_noticia='.$id_noticia.'" class="btn texto-buttons"  style="background-color: #f35753"> VER MAIS</a>
					        </div>
					    </div>
			    	</div>';
				}
				} 
			} else if ($rows == 0) {
				echo ' 
		  			<div class="col mb-4">
					    <div class="card shadow rounded">
					      <img src="./img/texto.png" class="card-img-top" style=" width: 100%;
  						height: 250px;" alt="...">
					      <div class="card-body text-center">
					        <h5 class="card-title"> NI E DI </h5>
					        <p class="card-text text-justify">'.$descricao_noticia.'...</p>
					        <a href="noticia_vermais_front.php?id_noticia='.$id_noticia.'" class="btn texto-buttons"  style="background-color: #f35753"> VER MAIS</a>
					        </div>
					    </div>
			    	</div>';
			}
			
	    	
	    
	    }

	    
	    echo '</div>';
	?>

	<!-- RODAPÉ -->
	<?php
		include_once("rodape.php");
	?>

  	<!-- Icons -->
  	<script type="text/javascript" src="icons/js/all.js"></script> 
    <!-- Tamplete -->
  	<script src="vendor/jquery/jquery.min.js"></script>
   	<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- Bootstrap: jQuery, Popper.js, Plugin JS  -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>
</html>