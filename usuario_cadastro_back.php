<?php

	//session + bd.
	session_start();
	include("conectar.php");

	//recendo dados do formulário e tratando com  mysqli_real_escape_string.
	$nome_usuario  = mysqli_real_escape_string($conectar, $_POST["nome_usuario"]);
	$email_usuario = mysqli_real_escape_string($conectar, $_POST["email_usuario"]);
	$senha_usuario = md5(mysqli_real_escape_string($conectar, $_POST["senha_usuario"]));

	//verificando se há outro usuário já cadastrado com o email que se deseja cadastrar.
	$select = "select * from usuario where email_usuario = '$email_usuario'";

	//query executando o sql
	$result = mysqli_query($conectar, $select);

	//num_rows atribundo a $row o número de linhas encontradas.
	$row = mysqli_num_rows($result);

	//mesmo com o nome
	$select2 = "select * from usuario where nome_usuario = '$nome_usuario'";
	$result2 = mysqli_query($conectar, $select2);
	$row2 = mysqli_num_rows($result2);

	//se a $row e $row2 não forem 0, significa que usuário á tem as infos cadastras
	if ($row2 >= 1){
		unset($_SESSION['acertos_cadastro_usuario']);
		$_SESSION['erros_cadastro_usuario'] = "Este nome já está cadastrado!";

		 //fechando a conexão do bd
	     mysqli_close($conectar);

		header('location:usuario_cadastro_front.php');
	} else if ($row >= 1){
		unset($_SESSION['acertos_cadastro_usuario']);
		$_SESSION['erros_cadastro_usuario'] = "Este email já está cadastrado!";

		//fechando a conexão do bd
	    mysqli_close($conectar);

		header('location:usuario_cadastro_front.php');

	//somente se ambas as $rows forem 0, é que pode-se efetuar o cadastrado
	} else if ($row == 0 && $row2 == 0){

		$insert = "INSERT INTO usuario 
						(nome_usuario, email_usuario, tipo_usuario, senha_usuario) 
				   VALUES
				 		('$nome_usuario', '$email_usuario', 2, '$senha_usuario')";

		$query = mysqli_query($conectar, $insert);
		unset($_SESSION['erros_cadastro_usuario']);
		$_SESSION['acertos_cadastro_usuario'] = "Cadastro Realizado com Sucesso!";
		//fechando a conexão do bd
	    mysqli_close($conectar);
		header('location:usuario_login_front.php');

	}


?>