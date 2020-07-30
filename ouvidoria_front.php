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
				<div class="col-lg-3 col-md-3 col-sm-10 border border-dark mr-2 mb-3" 
				     style="height: 500px; overflow: auto; background-color: #E5E5E5;">

				     <?php 

				      	$id_usuario = $_SESSION['id_usuario'];

				     	if($_SESSION['tipo_usuario'] == 2){
				     		echo '
								<!-- Botão de Cadastro -->
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

								<!-- Formulário de Cadastro -->
								<form id="cadastrar" action="denuncia_cadastro.php" method="post" style="display:none">
									<!--Título da Denúncia -->
									<div class="row text-center">
										<div class="col-12">
											<input type="text" class="form-control mt-2" placeholder="De um Título a Denúncia" name="titulo_denuncia" required>
										</div>
								    </div>
								    <!--Anonimato-->
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
								    <!--Button-->
									<div class="row justify-content-center">
										<div class="col-10">					    
											<input type="submit" class="btn btn-block btn-outline-success mt-2 mb-2 texto-login" value="Cadastrar">
											<hr>
										</div>
								    </div>
								</form> ';


								//caso contrário, o select só pega as denúncia que o usuário fez, tendo em vista que //ele não é adm.
							$select = "SELECT * FROM  denuncia
												WHERE id_usuario = $id_usuario 
												ORDER BY data_denuncia DESC";

							//query exeutando o select
							$query = mysqli_query($conectar, $select);

							//foreach pra conseguir as infos da denuncia
							foreach ($query as $denuncia) {
							 	$id     = $denuncia['id_denuncia'];
							 	$titulo_denuncia = $denuncia['titulo_denuncia'];

							//Listagem do titulo das denúncias + opção de CRUD
							echo '
								<div class="row">
									<div class="col">
									<button class="btn btn-outline-dark btn-block texto-login  mb-2 text-center" type="button" data-toggle="collapse" data-target="#collapseExample'.$id.'" aria-expanded="false" aria-controls="collapseExample'.$id.'">
    								'.$titulo_denuncia.'
  									</button>
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
							 }//fim do foreach
						
						} else if($_SESSION['tipo_usuario'] == 1){
					
							//informações da denúncia
							$select = "SELECT * FROM denuncia ORDER BY data_denuncia DESC";
							$query = mysqli_query($conectar, $select);

							//foreache da denu
							foreach ($query as $denuncia) {
							 	$id     = $denuncia['id_denuncia'];
							 	$titulo_denuncia = $denuncia['titulo_denuncia'];

 						 	    //Listagem só dos títulos, tendo em vista que o adm não pode editar
								echo '
								<div class="row">
									<div class="col">
									<button class="btn btn-outline-dark btn-block texto-login mt-1 mb-2 text-center" type="button" data-toggle="collapse" data-target="#collapseExample'.$id.'" aria-expanded="false" aria-controls="collapseExample'.$id.'">
    								'.$titulo_denuncia.'
  									</button>
  									</div>
  								</div>';

							 }

						} 
						
					?>

					<script>
						//Função toggle + evento click responsável
						//pelo efeito do cadastro da denúncia
						$("#mostrar-form").click(function () {
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