<?php
	
	//session + bd.
	session_start();
	include("conectar.php");

	//recendo dados do formulário e tratando com  mysqli_real_escape_string.
	$email_usuario = mysqli_real_escape_string($conectar, $_POST["email_usuario"]);
	$senha_usuario = md5(mysqli_real_escape_string($conectar, $_POST["senha_usuario"]));

	//verificando se o usuário chegou a digitar algo nos campos do formulário
	if(empty($email_usuario) or empty($senha_usuario)) { 
		$_SESSION['erros'] = "Os campos não podem ser nulos!";
		header('location:usuario_login_front.php');
		exit;
	} 


	//select no bd se há um usuário correspondentene ao dados inseridos no fomulário de login;
	$select = "select * from usuario 
			   where email_usuario = '$email_usuario' and senha_usuario = '$senha_usuario'";

	//função mysqli_query executa o comando slq; 
	$query = mysqli_query($conectar, $select); 
	
	//função mysqli_num_rows atribui a variável $row o numero de linhas/usuário 
	//encontrados com os dados inseridos no formulário
	$row = mysqli_num_rows($query);			   

	//mysqli_fetch_array transforma os dados do usuário em um array;
	$user = mysqli_fetch_array($query);
	
	//se row for 1, há um usuário correspondente
	if($row == 1) { 

		//atribuindo os dados do usuário correspondente as sessions
		$_SESSION['id_usuario']   = $user['id_usuario'];	
		$_SESSION['tipo_usuario'] = $user['tipo_usuario'];

		//limpando as sessions
		unset($_SESSION['erros']);
		unset($_SESSION['acertos']);

		if($_SESSION['tipo_usuario'] == 2 ){ 
			//usuario tipo 2 = usuário comum
			//fechando a conexão do bd
	        mysqli_close($conectar);
			header('location: ouvidoria_front.php');

		}elseif ($_SESSION['tipo_usuario'] == 1){ 
			//usuário tipo 1 = usuário adm
			//fechando a conexão do bd
	        mysqli_close($conectar);
			header('location:ouvidoria_front.php');

		} 
		 //Fecha a conexão
	     //mysql_close($conectar);
	}else{
		//Se row for =! 1, algo está errado
		$_SESSION['erros'] = "Usuário e senha incorretos!";
		//fechando a conexão do bd
	    mysqli_close($conectar);
		header('location:usuario_login_front.php');
	}

	
?>