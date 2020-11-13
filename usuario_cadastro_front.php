<?php 
	session_start();
?>
<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<title>Cadastro do Usuário</title>
			
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

		<!-- script responsável pela validação da senha -->
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

					<form name="cadastro_form" action="usuario_cadastro_back.php" method="post">

						<!--Icon e Session -->
						<div class="row justify-content-center"> 
							<div class="col-sm-11 col-md-10 col-lg-9 text-center"> 
								<i class="fa fa-users fa-4x margin mb-1" aria-hidden="true"></i>
								 <?php 
									  if(isset($_SESSION['erros'])) {
									  		echo "<div class='alert alert-danger texto-corpo' role='alert'>";
											echo $_SESSION['erros'];
											echo "</div>";
										}
							     ?>
								<hr>
							</div>
						</div>

						<!-- Nome -->
						<div class="row justify-content-center"> 
							<div class="col-sm-11 col-md-10 col-lg-9 mb-3"> 
								<label for="#" class="texto-corpo">Nome</label>
								<input type="text" class="form-control texto-corpo" name="nome_usuario"  placeholder="" required>
							</div>
						</div>

						<!-- Email -->
						<div class="row justify-content-center">
							<div class="col-sm-11 col-md-10 col-lg-9 mb-3 ">
								<label for="#" class="texto-corpo">Email</label>
								<input type="Email" class="form-control texto-corpo" name="email_usuario" placeholder="">
							</div>
						</div>

						<!-- Senha -->
						<div class="row justify-content-center">
							<div class="col-sm-11 col-md-10 col-lg-9 mb-3">
								<label class="texto-corpo">Senha</label>
								<input type="password" class="form-control" name="senha_usuario" placeholder="">
							</div>
						</div>

						<!-- Confirmando a senha -->
						<div class="row justify-content-center">
							<div class="col-sm-11 col-md-10 col-lg-9 mb-3">
								<label class="texto-corpo">Confirme a Senha</label>
								<input type="password" class="form-control" name="confirmar_senha_usuario" placeholder="">
							</div>
						</div>

						<!-- Button -->
						<div class="row justify-content-center">
							<div class="col-sm-11 col-md-10 col-lg-9 text-center">
								<button type="submit" style="background-color: #f35753" class="btn text-white texto-buttons texto-corpo" onclick="return validar()">
									ENVIAR
								</button> 
							</div>
						</div>

						<!-- Login -->
						<div class="row justify-content-center">
					    	<div class="col-sm-11 col-md-10 col-lg-9 text-center mb-4 texto-corpo">
					    	<hr>
							Já possui cadastro? <a href="usuario_login_front.php">Faça login aqui!</a>
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
	    <!-- Bootstrap: jQuery, Popper.js, Plugin JS  -->
	    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
	    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
	    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
	</body>
</html>