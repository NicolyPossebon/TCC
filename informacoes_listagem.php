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
		?>

        <header  class = " masthead " img=".img/texto.png" >
            <div  class = " container " >
                <div  class = " masthead-subheading " > Bem-vindo ao nosso estúdio! </ div >
                <div  class = " masthead-header text-uppercase " > Prazer em conhecê-lo </ div >
                <A  class = " btn btn-primário btn-xl texto maiúsculas js-scroll-trigger " href =" #services " > Tell Me More </ a >
            </div >
        </header >
        <?php
			//Selecionando as descrições.
			$select_descricoes = "SELECT * FROM descricao";
			//Executando o select.
			$query_descricoes  = mysqli_query($conectar, $select_descricoes);

			//Percorrendo as Informações.
			foreach ($query_descricoes as $dados_descricoes) {
				$cai      = $dados_descricoes['cai_descricao'];
				$napne    = $dados_descricoes['napne_descricao'];
				$neabi    = $dados_descricoes['neabi_descricao'];
				$nugedis  = $dados_descricoes['nugedis_descricao'];

				echo '
						<div class="row text-center mt-5 d-flex justify-content-around">
							<div class="col-3">
								<button class="cinza btn-lg btn-block text-white" type="button" data-toggle="collapse" data-target="#collapse" aria-expanded="false" aria-controls="collapseExample">
					    			CAI
					  			</button>
					  		</div>
					  	</div>

					  	<div class="row mt-5 text-center justify-content-center">
							<div class="col-8">
								<div class="collapse" id="collapse">
								    <div class="card card-body">
								    	'.$cai.'
								    </div>
								</div>
							</div>
						</div>
					
					<div class="container" id="mygroup">
						<div class="row text-center mt-5 d-flex justify-content-around">
							<div class="col-3">
								<button class="cinza btn-lg btn-block text-white" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
					    			NAPNE
					  			</button>
					  		</div>

					  		<div class="col-3">
								<button class="cinza btn-lg btn-block text-white" type="button" data-toggle="collapse" data-target="#collapseExample2" aria-expanded="false" aria-controls="collapseExample">
					    			NEABI
					  			</button>
					  		</div>

					  		<div class="col-3">
								<button class="cinza btn-lg btn-block text-white" type="button" data-toggle="collapse" data-target="#collapseExample3" aria-expanded="false" aria-controls="collapseExample">
					    			NUGEDIS
					  			</button>
							</div>
						</div>

						<div class="row mt-5">
							<div class="col">
								<div class="collapse" id="collapseExample" data-parent="#mygroup">
								    <div class="card card-body">
								    	'.$napne.'
								    	<br>
								    	<a href="#" class="btn btn-outline-dark btn-sm"> 
								    		<i class="far fa-eye"></i> Ver Mais
								    	</a>
								    </div>
								</div>

								<div class="collapse" id="collapseExample2" data-parent="#mygroup">
								    <div class="card card-body">
								    	'.$neabi.'
								    	<a href="#" class="btn btn-outline-dark btn-sm"> 
								    		<i class="far fa-eye"></i> Ver Mais
								    	</a>
								    </div>
								</div>
						
								<div class="collapse" id="collapseExample3" data-parent="#mygroup">
				  					<div class="card card-body">
				   						'.$nugedis.'
				   						<a href="#" class="btn btn-outline-dark btn-sm"> 
								    		<i class="far fa-eye"></i> Ver Mais
								    	</a>
				  					</div>
								</div>
							</div>
						</div>	
					</div>';

			}
		

		/*if(empty($_SESSION['tipo_usuario']) || $_SESSION['tipo_usuario'] == 2){
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
				} */
				
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
			} else if($tipo_arquivo == 2){
				echo ' 
		  			<div class="col mb-4">
					    <div class="card shadow rounded">
					      <img src="./img/audio.png" class="card-img-top" style=" width: 100%;
  						height: 250px;" alt="...">
					      <div class="card-body text-center">
					        <h5 class="card-title">'.$titulo_noticia.'</h5>
					        <p class="card-text text-justify">'.$descricao_noticia.'...</p>
					        <a href="noticia_vermais_front.php?id_noticia='.$id_noticia.'" class="btn btn-outline-dark"> Ver mais</a>
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
					        <a href="noticia_vermais_front.php?id_noticia='.$id_noticia.'" class="btn btn-outline-dark"> Ver mais</a>
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
					        <a href="noticia_vermais_front.php?id_noticia='.$id_noticia.'" class="btn btn-outline-dark"> Ver mais</a>
					        </div>
					    </div>
			    	</div>';
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

