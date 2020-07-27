<?php
	session_start();
	include("conectar.php");

	$id_usuario    = $_SESSION['id_usuario'];
	$nome_usuario  = $_POST['nome_usuario'];
	$email_usuario = $_POST['email_usuario'];
	$senha_usuario = $_POST['senha_usuario'];

	//Testando se outra pessoa tem 
	$select = "SELECT * FROM usuario 
			   WHERE email_usuario = '$email_usuario' 
			   AND id_usuario != $id_usuario";
	$result = mysqli_query($conectar, $select);
	$row = mysqli_num_rows($result);

	//Testando se tem um 
	$select2 = "SELECT * FROM usuario 
			   WHERE nome_usuario = '$nome_usuario' 
			   AND id_usuario != $id_usuario";
	$result2 = mysqli_query($conectar, $select2);
	$row2 = mysqli_num_rows($result2);
	//echo $row2, $row;

    if ($row == 0 && $row2 == 0){
		$update = "UPDATE usuario 
					SET nome_usuario  = '$nome_usuario', 
						email_usuario = '$email_usuario', 
						senha_usuario = '$senha_usuario'
					WHERE id_usuario = $id_usuario";
		$query = mysqli_query($conectar, $update);
		unset($_SESSION['erros']);
		$_SESSION['acertos'] = "Dados Alterados com Sucesso!";
		header('location:usuario_edita_front.php');
	} else if($row > 0 && $row2 > 0){
		$_SESSION['erros'] = "Estes dados já estão cadastrados!";
	    header('location:usuario_edita_front.php');
	} else if ($row > 0){
		$_SESSION['erros'] = "Este email já está cadastrado!";
		header('location:usuario_edita_front.php');
	} else if ($row2 > 0){
		$_SESSION['erros'] = "Este nome já está cadastrado!";
	    header('location:usuario_edita_front.php');
	} 

mysqli_close($conectar);
?>