<?php
	//session + banco.
	session_start();
	include("conectar.php");

	if(empty($_POST['id']) == false){

		//recebendo dados do formulário.
		echo $id_denuncia        = $_POST['id'];   
		echo $titulo_denuncia    = $_POST['titulo'];

		//atualizando no banco.
		$update_denuncia = "UPDATE denuncia 
							SET titulo_denuncia = '$titulo_denuncia'
							WHERE id_denuncia = $id_denuncia";
		//executando o camando update.
		$query_denuncia = mysqli_query($conectar, $update_denuncia);

		//limpando a session.
		unset($_SESSION['erros_edicao']);

		//fechando a conexão do bd.
		mysqli_close($conectar);

		//redirecionando.
		header("location:ouvidoria_front.php");
	}else{
		//Atribuindo à session.
		$_SESSION['erros_edicao'] = "Você precisa selecionar a denuncia que deseja editar. Clique sobre ela!";

		//fechando a conexão do bd.
		mysqli_close($conectar);

		//redirecionando.
		header("location:ouvidoria_front.php");
	}

	
?>