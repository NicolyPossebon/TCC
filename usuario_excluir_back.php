<?php
	
	session_start();
	include ("conectar.php");

	$id_usuario = $_SESSION['id_usuario'];
	$senha_usuario = mysqli_real_escape_string($conectar, $_POST["senha_usuario"]);

	$select = "SELECT * FROM usuario 
				WHERE senha_usuario = '$senha_usuario' 
				AND id_usuario = $id_usuario";
	$query = mysqli_query($conectar, $select);
	$row = mysqli_num_rows($query);

	if ($row == 1){
		$delete = "DELETE FROM usuario WHERE id_usuario = '$id_usuario'";
		$query = mysqli_query($conectar, $delete);
		session_destroy();
		header('location:usuario_login_front.php');
	} else {
		$_SESSION['erros'] = "Não foi possivel deletar sua conta, tente novamente";
		header('location:usuario_excluir_front.php');
	}



?>