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
			<!-- JQuery -->
			<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
			
	</head>
	<body>

		<?php 
			include("navbar.php");
		?>


		<div class="container-fluid mt-3 mb-3">
			<div class="row justify-content-center">
				<div class="col-lg-3 col-md-3 col-sm-10 border border-dark bg-white mr-2 mb-3" 
				     style="height: 500px;">
					
					<!-- Botão de Cadastro -->
					<button type="button" 
							id="mostrar-form" 
							class="btn btn-lg btn-block btn-outline-dark texto-login mt-3"> 
						Cadastrar Denúncia
						<i class="fas fa-caret-down ml-1"></i>
					</button>


					<!-- Formulário de Cadastro -->
					<form id="cadastrar" action="denuncia_cadastro.php" method="post" style="display:none">
						
						<div class="row text-center">
							<div class="col-12">
								<input type="text" class="form-control mt-2" placeholder="De um Título a Denúncia" name="titulo_denuncia" required>
							</div>
					    </div>

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

						<div class="row justify-content-center">
							<div class="col-10">					    
								<input type="submit" class="btn btn-block btn-outline-success mt-2 texto-login" value="Cadastrar">
							</div>
					    </div>
					</form>



					<script>

						//#mostrar-form: id do botão atribuido ao evento click. Quando o evento é disparado, chama toggle.
						$("#mostrar-form").click(function () {
							//#cadastrar: id do elemento que é pra ser exibido/ocultado, no caso do formulário
							$("#cadastrar").toggle();

						})

					</script>


				</div>

				<!-- MENSAGENS DAS DENÚNCIAS -->
				<div class="col-lg-8 col-md-3 col-sm-10 border border-dark bg-white" 
				     style="height: 500px;">
					



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