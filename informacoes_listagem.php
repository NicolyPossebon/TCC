<?php
	//session + banco.
	session_start();
	include_once("conectar.php");
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
		<link href="https://fonts.googleapis.com/css?family=Catamaran:100,200,300,400,500,600,700,800,900" rel="stylesheet">
		<link href="https://fonts.googleapis.com/css?family=Lato:100,100i,300,300i,400,400i,700,700i,900,900i" rel="stylesheet">

	</head>
	<body>

		<!-- Navbar -->
		<?php
			include("navbar.php");

			//Selecionando as descrições.
			$select_descricoes = "SELECT * FROM descricoes";
			//Executando o select.
			$query_descricoes  = mysqli_query($conectar, $select_descricoes);

			//Percorrendo as Informações.
			foreach ($query_descricoes as $dados_descricoes) {
				$cai      = $dados_descricoes['descricao_cai'];
				$napne    = $dados_descricoes['descricao_napne'];
				$neabi    = $dados_descricoes['descricao_neabi'];
				$nugedis  = $dados_descricoes['descricao_nugedis'];

				echo '
					<div class="row mb-5 mt-5">
						<div class="col-12 text-center">
							CAI
						</div>
					</div>

					<div class="row d-flex justify-content-around mb-5">

						<div class="col-2 text-center">
							 <a href="#" class="btn btn-dark btn-lg btn-block">NAPNE</a>
						</div>

						<div class="col-2 text-center">
							  <a href="#" class="btn btn-dark btn-lg btn-block">NEABI</a>
						</div>

						<div class="col-2 text-center">
						     <a href="#" class="btn btn-dark btn-lg btn-block">NUGEDIS</a>
						</div>

					</div>
				';

			}
		

		if(empty($_SESSION['tipo_usuario']) || $_SESSION['tipo_usuario'] == 2){
			//não faz nada
		} else if ($_SESSION['tipo_usuario'] == 1){
				echo '	
				<div class="container">
					<div class="row justify-content-center">
		  				<div class="col-10 mb-1 mt-4 ">
		  					<!-- Botão de Edição -->
							<a href="informacoes_editar_front.php">
								<i class="far fa-edit fa-1x"></i> 
								Editar
							</a>
						</div>
					</div>
				</div>';
				}
				
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
					        <h5 class="card-title">'.$titulo_noticia.'</h5>
					        <p class="card-text text-justify">'.$descricao_noticia.'...</p>
					        <a href="noticia_vermais_front.php?id_noticia='.$id_noticia.'" class="btn btn-outline-dark"> Ver mais</a>
					        </div>
					    </div>
			    </div>';
			} 
	    	}
	    }
	    echo "</div>";
		
		// Rodapé 
	
			include("rodape.php");
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

