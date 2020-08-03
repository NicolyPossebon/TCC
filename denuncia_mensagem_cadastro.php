
	<?php
	session_start();
	include("conectar.php");

	$id_usuario  = $_SESSION['id_usuario'];
	$id_denuncia = $_POST['id_denuncia'];
	$mensagem_denuncia = $_POST['texto_mensagem'];
	$data_mensagem      = date("Y/m/d H:i");


	$insert = "INSERT INTO mensagem 
							(id_denuncia, id_usuario, data_mensagem, texto_mensagem)
				VALUES ($id_denuncia, $id_usuario, '$data_mensagem', '$mensagem_denuncia')";
	$query = mysqli_query($conectar, $insert);

	header("location:ouvidoria_front.php?id=$id_denuncia");

	?>