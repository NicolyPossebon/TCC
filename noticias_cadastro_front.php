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

		<title>Cadastro de Notícia</title>

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

		<!-- navbar -->
		<?php 
			include("navbar.php");
		?>

		<div class="container texto-corpo">
			<div class="row justify-content-center mb-5 pt-2 mt-2">
				<div class="col-sm-12 col-md-10 col-lg-10 shadow-lg p-5 mt-4 rounded-lg bg-white">
					<div class="row d-flex justify-content-center mb-4">
						<div class="col-6 text-center text-white" style="background-color: #3CB371; font-size: 1.5rem; text-transform: uppercase; font-weight: 700;">
							Cadastre uma Notícia!
						</div>
					</div>
					<form action="noticias_cadastro_back.php" method="post" enctype="multipart/form-data">

						<!--Session -->
						<div class="row justify-content-center"> 
							<div class="col-sm-9 col-md-8 col-lg-7 text-center"> 
								 <?php 
									  if(isset($_SESSION['erros_noticias'])) {
									  		echo "<div class='alert alert-danger texto-corpo' style='font-size: 15px;' role='alert'>";
											echo $_SESSION['erros_noticias'];
											echo "</div>";
										}

							     ?>
								<hr>
							</div>
						</div>

						<!-- Título da Notícia -->
						<div class="form-row justify-content-center"> 
							<div class="form-grup col-10 mb-3"> 
								<label for="#">Título</label>
								<input type="text" class="form-control border" name="titulo_noticia"  placeholder="" required data-length="10">
							</div>
						</div>

						<!-- Escolher Foto  -->
						<div class="form-row justify-content-center"> 
							<div class="form-grup col-10 mb-3"> 
								<label for="#">Mídia da Notícia</label>
								<input type="file" class="form-control border" name="foto[]" multiple id="imagem" onchange="previewImagem()">
							</div>
						</div>

						<!-- Vídeo -->
						<div class="form-row justify-content-center">
							<div class="form-grup  mb-3 col-10">
								<label for="#">Vídeo</label>
								<input type="text" class="form-control border" name="video_noticia"  placeholder=""  data-length="10">
							</div>
						</div>


						<!-- Descrição da Notícia -->
						<div class="form-row justify-content-center">
							<div class="form-grup  mb-3 col-10">
								<label for="#">Descrição</label>
								<br>
								<textarea rows="5" cols="85" class="rounded border"  name="descricao_noticia"  placeholder="" required data-length="10"></textarea>
							</div>
						</div>

						<!-- Button -->
						<div class="form-row ">
							<div class="col text-center">
								<button type="submit" class="btn btn-lg cinza text-white texto-buttons" style="background-color: #3CB371; text-transform: uppercase; font-weight: 700;">Enviar</button> 
							</div>
						</div>

					</form>
				</div>
			</div>
		</div>

		<!-- rodapé -->
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