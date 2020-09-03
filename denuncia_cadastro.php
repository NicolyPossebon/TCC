<?php
	
	//session + bd.
	session_start();
	include("conectar.php");

	//recebend dados do formulário.
	$id_usuario         = $_SESSION['id_usuario'];
	$titulo_denuncia    = $_POST['titulo_denuncia'];
	$anonimato_denuncia = $_POST['anonimato_denuncia'];
	$data_denuncia      = date("Y/m/d H:i:s");

	//inserindo no banco.
	$insert = "INSERT INTO denuncia
					(id_usuario, titulo_denuncia, data_denuncia, anonimato_denuncia)
				VALUES
					($id_usuario, '$titulo_denuncia', '$data_denuncia', $anonimato_denuncia)";
	//executando o comando insert.
	$query = mysqli_query($conectar, $insert);
	
	//fechando a conexão do bd.
	mysqli_close($conectar);

	//redirecionando.
	header("location:ouvidoria_front.php");

?>