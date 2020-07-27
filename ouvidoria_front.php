<?php 
	session_start();
	include ("conectar.php");
	
	//Teste para não deixar ninguem não logado entrar
	if(empty($_SESSION['id_usuario'])) {
		$_SESSION['erros'] = "É necessário login para acessar essa página!";
		header('location:usuario_login_front.php');
	} 
?>
<!DOCTYPE html>
<html lang="pt-br">

	<head>
		<title>Ouvidoria</title>
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

		<?php 
			include("navbar.php");
		?>


		<div class="container-fluid mt-3 mb-3">
			<div class="row justify-content-center">

				<div class="col-3 border border-dark mr-2" style="height: 500px;">
					Denúncias Cadastradas
				</div>

				<div class="col-8 border border-dark">
					MENSAGENS DO
					<?php 
						if ($_SESSION['tipo_usuario'] == 1) {
							echo "ADM";
							# code...
						} else{
							echo "USU COMUM";
						}

					?>
				</div>

			</div>
		</div>

		<?php 
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