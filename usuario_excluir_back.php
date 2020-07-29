<?php
	
	//session + bd.
	session_start();
	include ("conectar.php");

	//recebendo dados.
	$id_usuario = $_SESSION['id_usuario'];
	$senha_usuario = md5(mysqli_real_escape_string($conectar, $_POST["senha_usuario"]));

	//testando de a senha é do id em session.
	$select = "SELECT * FROM usuario 
				WHERE senha_usuario = '$senha_usuario' 
				AND id_usuario = $id_usuario";

	//query executando o sql.
	$query = mysqli_query($conectar, $select);

	//num_rows atrbuindo o numero de linhas encontradas.
	$row = mysqli_num_rows($query);

	//row == 1, dados bateram.
	if ($row == 1){
		//sql que deleta o usuario.
		$delete = "DELETE FROM usuario WHERE id_usuario = '$id_usuario'";

		//query que executa o sql
		$query = mysqli_query($conectar, $delete);

		//destruindo sessions vinculadas ao usuário deletado.
		session_destroy();

		//redirecionando.
		header('location:usuario_login_front.php');

	//$row =! 1, algo está errado
	} else {
		$_SESSION['erros'] = "Não foi possivel deletar sua conta, tente novamente";
		header('location:usuario_excluir_front.php');
	}

	//Fecha a conexão
	mysql_close($conectar);

?>