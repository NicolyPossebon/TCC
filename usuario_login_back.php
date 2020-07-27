<?php

	session_start();

	include("conectar.php");

	$email_usuario = mysqli_real_escape_string($conectar, $_POST["email_usuario"]);
	$senha_usuario = mysqli_real_escape_string($conectar, $_POST["senha_usuario"]);

	//Verifica se as variáveis estão fazias 
	if(empty($email_usuario) or empty($senha_usuario)) { 
		$_SESSION['erros'] = "Os campos não podem ser nulos!";
		header('location:usuario_login_front.php');
		exit;
	} 

	$select = "select * from usuario where email_usuario = '$email_usuario' and  senha_usuario = '$senha_usuario'";
	//pesquisa no banco de dados se tem um usuário correspondentene ao dados inseridos no fomulário de login;
	$query = mysqli_query($conectar, $select); 
	//função mysqli_query executa o comando slq; 
	$row = mysqli_num_rows($query);			   
	//função mysqli_num_rows atribui a variável $row o número de linhas retornadas da tabela usuário que batem com os dados;
	$user = mysqli_fetch_array($query);
	//mysqli_fetch_array transforma os dados do usuários em um array;


	if($row == 1) { 

		$_SESSION['id_usuario']   = $user['id_usuario'];	
		$_SESSION['tipo_usuario'] = $user['tipo_usuario'];
		unset($_SESSION['erros']);
		unset($_SESSION['acertos']);

		if($_SESSION['tipo_usuario'] == 2 ){ 
			// Se o usuário é 0, ou seja, um usuário comum;
			header('location: ouvidoria_front.php');

		}elseif ($_SESSION['tipo_usuario'] == 1){ 
			//Se o usuário é 1, ou seja, usuário administrador;
			header('location:ouvidoria_front.php');

		} 
		
	}else{
		$_SESSION['erros'] = "Usuário e senha incorretos!";
		header('location:usuario_login_front.php');
	}

	mysql_close($conectar);
?>