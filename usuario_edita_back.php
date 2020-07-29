<?php
	session_start();
	include("conectar.php");

	$id_usuario    = $_SESSION['id_usuario'];
	$nome_usuario  = mysqli_real_escape_string($conectar, $_POST["nome_usuario"]);
	$email_usuario = mysqli_real_escape_string($conectar, $_POST["email_usuario"]);
	$senha_usuario = md5(mysqli_real_escape_string($conectar, $_POST["senha_usuario"]));

	//Se a pessoa realmente mudar de email, testa
	//pra ver se outra já não o tem; Se ela quiser
	//o mesmo, ainda assim, nenhuma outra deve o ter, 
	//a não ser ela mesmo;
	$select = "SELECT * FROM usuario 
			   WHERE email_usuario = '$email_usuario' 
			   AND id_usuario != $id_usuario";
	$result = mysqli_query($conectar, $select);
	$row = mysqli_num_rows($result);

	//Mesma coisa com o nome
	$select2 = "SELECT * FROM usuario 
			   WHERE nome_usuario = '$nome_usuario' 
			   AND id_usuario != $id_usuario";
	$result2 = mysqli_query($conectar, $select2);
	$row2 = mysqli_num_rows($result2);
	//echo $row2, $row;

    if ($row == 0 && $row2 == 0){
		$update = " UPDATE usuario 
					SET nome_usuario  = '$nome_usuario', 
						email_usuario = '$email_usuario', 
						senha_usuario = '$senha_usuario'
					WHERE id_usuario  = $id_usuario";
		$query = mysqli_query($conectar, $update);
		unset($_SESSION['erros']);
		$_SESSION['acertos'] = "Dados Alterados com Sucesso!";
	    mysqli_close($conectar);
		header('location:usuario_edita_front.php');
	} else if($row > 0 && $row2 > 0){
		$_SESSION['erros'] = "Estes dados já estão cadastrados!";
	    mysqli_close($conectar);
	    header('location:usuario_edita_front.php');
	} else if ($row > 0){
		$_SESSION['erros'] = "Este email já está cadastrado!";
	    mysqli_close($conectar);
		header('location:usuario_edita_front.php');
	} else if ($row2 > 0){
		$_SESSION['erros'] = "Este nome já está cadastrado!";
	    mysqli_close($conectar);
	    header('location:usuario_edita_front.php');
	} 


?>