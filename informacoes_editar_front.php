<?php 
	//Session + banco.
	session_start();
	include ("conectar.php");
	
	//Teste para não deixar ninguem não logado ou que não seja adm entrar.
	if(empty($_SESSION['id_usuario']) || $_SESSION['tipo_usuario'] != 1) {
		$_SESSION['erros'] = "É necessário login para acessar essa página!";
		header('location:usuario_login_front.php');
	} 

	//Selecionando informações que quero editar.
	$select_descricoes = "SELECT * FROM descricao";
	//Executando select.
	$query_descricoes  = mysqli_query($conectar, $select_descricoes);

		//percorrendo o array.
		foreach ($query_descricoes as $dados_descricoes) {
			$cai     = $dados_descricoes['cai_descricao'];
			$napne   = $dados_descricoes['napne_descricao'];
			$neabi   = $dados_descricoes['neabi_descricao'];
			$nugedis = $dados_descricoes['nugedis_descricao'];
	    }
?>

<!DOCTYPE html>
<html>
<head>
	<title>Alteração dos Dados</title>

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

		<!-- Navbar-->
		<?php
			include("navbar.php");
		?>


			<div class="container">
				<div class="row justify-content-center mb-5 pt-2 mt-2">
					<div class="col-sm-12 col-md-10 col-lg-10 shadow-lg p-5 mt-4 rounded-lg bg-white">
				
						<!-- Formulário -->
						<form action="informacoes_editar_back.php" method="post" enctype="multipart/form-data">

							<!-- CAI -->
							<div class="form-row justify-content-center"> 
								<div class="form-grup col-10 mb-3"> 
									<label for="#">Descrição CAI</label>
									<input type="text" class="form-control" name="descricao_cai" value="<?php echo $cai; ?>"  placeholder="" required data-length="10">
								</div>
							</div>

							<!-- NAPNE -->
							<div class="form-row justify-content-center"> 
								<div class="form-grup col-10 mb-3"> 
									<label for="#">Descrição NAPNE</label>
									<input type="text" class="form-control" name="descricao_napne" value="<?php echo $napne; ?>"  placeholder="" required data-length="10">
								</div>
							</div>

							<!-- NEABI -->
							<div class="form-row justify-content-center"> 
								<div class="form-grup col-10 mb-3"> 
									<label for="#">Descrição NEABI</label>
									<input type="text" class="form-control" name="descricao_neabi" value="<?php echo $neabi; ?>"  placeholder="" required data-length="10">
								</div>
							</div>

							<!-- NUGEDIS -->
							<div class="form-row justify-content-center"> 
								<div class="form-grup col-10 mb-3"> 
									<label for="#">Descrição NUGEDIS</label>
									<input type="text" class="form-control" name="descricao_nugedis" value="<?php echo $nugedis; ?>"  placeholder="" required data-length="10">
								</div>
							</div>

							<!-- BUTTON -->
							<div class="form-row ">
								<div class="col text-center">
									<button type="submit" class="btn cinza text-white">Enviar</button> 
								</div>
							</div>

						</form>
					</div>
				</div>
			</div>

		<!-- Rodapé -->
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