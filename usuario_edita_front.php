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
		<title>Edição do Usuário</title>

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

			<?php 

				$id_usuario = $_SESSION['id_usuario'];
				$sql = "select * from usuario where id_usuario = $id_usuario";
				$query = mysqli_query($conectar, $sql);
				$usuario = mysqli_fetch_assoc($query);

			?>

			<script type="text/javascript">
				function validar(){

					var senha = cadastro_form.senha_usuario.value;
					var confirmar_senha = cadastro_form.confirmar_senha_usuario.value;

					if (senha == "" || senha.length < 6 || senha.length > 10){
						alert("A senha precisa ter de 6 a 10 caracteres!");
						cadastro_form.senha_usuario.focus();
						return false;
					}

					if (senha != confirmar_senha){
						alert("senhas diferentes");
						cadastro_form.confirmar_senha_usuario.focus();
						return false;
					}


				}

			</script>
	</head>
	<body>

		<!-- NAVBAR -->
		<?php
			include("navbar.php");
		?>

		<!-- FORMULÁRIO DE CADASTRO -->
		<div class="container">
			<div class="row justify-content-center mb-5 pt-2 mt-2">
				<div class="col-sm-12 col-md-10 col-lg-7 shadow-lg p-4 mt-4 rounded-lg bg-white">

					<form name="cadastro_form" action="usuario_edita_back.php" method="post">

						<!--Icon -->
						<div class="row justify-content-center"> 
							<div class="col-sm-11 col-md-10 col-lg-9 text-center"> 
								<i class="fa fa-users fa-4x margin mb-1" aria-hidden="true"></i>
								 <?php 
									  if(isset($_SESSION['erros'])) {
									  		echo "<div class='alert alert-danger' role='alert'>";
											echo $_SESSION['erros'];
											echo "</div>";
										}

										if(isset($_SESSION['acertos'])){
											echo "<div class='alert alert-success' role='alert'>";
											echo $_SESSION['acertos'];
											echo "</div>";
										}
							     ?>
								<hr>
							</div>
						</div>

						<!-- Nome -->
						<div class="row justify-content-center"> 
							<div class="col-sm-11 col-md-10 col-lg-9 mb-3"> 
								<label for="#">Nome</label>
								<input type="text" class="form-control" name="nome_usuario" 
								value="<?php echo $usuario['nome_usuario'];?>" required>
							</div>
						</div>

						<!-- Email -->
						<div class="row justify-content-center">
							<div class="col-sm-11 col-md-10 col-lg-9 mb-3 ">
								<label for="#">Email</label>
								<input type="Email" class="form-control" name="email_usuario" 
								value="<?php echo $usuario['email_usuario'];?>" required>
							</div>
						</div>

						<!-- Senha -->
						<div class="row justify-content-center">
							<div class="col-sm-11 col-md-10 col-lg-9 mb-3">
								<label>Senha</label>
								<input type="password" class="form-control" name="senha_usuario" value="<?php echo $usuario['senha_usuario'];?>">
							</div>
						</div>

						<!-- Confirmando a senha -->
						<div class="row justify-content-center">
							<div class="col-sm-11 col-md-10 col-lg-9 mb-3">
								<label>Confirme a Senha</label>
								<input type="password" class="form-control" name="confirmar_senha_usuario" placeholder="">
							</div>
						</div>

						<!-- Button -->
						<div class="row justify-content-center">
							<div class="col-sm-11 col-md-10 col-lg-9 text-center">
								<button type="submit" class="btn cinza text-white" 
										onclick="return validar()">
									Salvar
								</button> 
							</div>
						</div>
					</form>
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