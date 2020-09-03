<?php
	//sessions + banco.
	session_start();
	include("conectar.php");

	//recebendo os dados.
	$id_usuario  = $_SESSION['id_usuario'];
	echo $id_denuncia = $_POST['id_denuncia'];
	$mensagem_denuncia = $_POST['texto_mensagem'];
	$data_mensagem      = date("Y/m/d H:i");

	//inserindo no banco.
	$insert = "INSERT INTO mensagem 
							(id_denuncia, id_usuario, data_mensagem, texto_mensagem)
				     VALUES ($id_denuncia, $id_usuario, '$data_mensagem', '$mensagem_denuncia')";
	//executando o comando insert.
	$query = mysqli_query($conectar, $insert);

	//fechando a conexão do bd.
	mysqli_close($conectar);

	//redirecionando.
	header("location:ouvidoria_front.php?id=$id_denuncia");
?>