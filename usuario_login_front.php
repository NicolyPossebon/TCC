<?php
	session_start();
?>
<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<title>Login</title>
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

		<!-- NAVBAR -->
		<?php
			include("navbar.php");
		?>

		<!-- FORMULÁRIO -->
		<div class="container">
			<div class="row justify-content-center mb-5 pt-2 mt-2">
				<div class="col-sm-12 col-md-10 col-lg-7 shadow-lg rounded-lg bg-white p-4 mt-4">

					<!-- Formulário -->
					<form action="usuario_login_back.php" method="post">

						<!--Icon -->
						<div class="row justify-content-center"> 
							<div class="col-sm-9 col-md-8 col-lg-7 text-center"> 
								<i class="fas fa-user fa-4x mb-2 mt-4"></i>
								 <?php 
									  if(isset($_SESSION['erros'])) {
									  		echo "<div class='alert alert-success' role='alert'>";
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

						<!-- Email -->
						<div class="row justify-content-center">
							<div class="col-sm-9 col-md-8 col-lg-7 text-center mb-3">
								<label for="#">Email</label>
								<input type="text" class="form-control" id="#" name="email_usuario">
							</div>
						</div>   

						<!-- Senha -->
						<div class="row justify-content-center">
							<div class="col-sm-9 col-md-8 col-lg-7 mb-3">
								<center><label for="#">Senha</label></center>
							    <input type="password" class="form-control" id="#" name="senha_usuario">
							    <a href="#">Esqueceu a senha?</a>
							</div>
						</div>

						<!-- Botão -->
						<div class="row justify-content-center">
					    	<div class="col-sm-9 col-md-8 col-lg-7 text-center mb-2">
								<input type="submit" class="btn text-white" style="background-color: #3CB371;" value="Entrar"> 
							</div>
						</div>

						<!-- Cadastro -->
						<div class="row justify-content-center">
					    	<div class="col-sm-9 col-md-8 col-lg-7 text-center mb-4">
						    	<hr>
								Ainda não tem cadastro? 
								<a href="usuario_cadastro_front.php">
									Cadastre-se aqui!
								</a>
							</div>
						</div>

					</form>
				</div>
			</div>
		</div>

		<!-- RODAPÉ -->
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
