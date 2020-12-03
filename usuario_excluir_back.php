<?php
	
	//session + bd.
	session_start();
	include ("conectar.php");

	//recebendo dados.
	$id_usuario = $_SESSION['id_usuario'];
	$senha_usuario = md5(mysqli_real_escape_string($conectar, $_POST["senha_usuario"]));

	//testando se a senha é do id em session.
	$select = "SELECT * FROM usuario 
				WHERE senha_usuario = '$senha_usuario' 
				AND id_usuario = $id_usuario";

	//query executando o sql.
	$query = mysqli_query($conectar, $select);

	//num_rows atrbuindo o numero de linhas encontradas.
	$row = mysqli_num_rows($query);

	//row == 1, dados bateram.
	if ($row == 1){

		$select_denuncia = "SELECT * FROM denuncia WHERE id_usuario = '$id_usuario'";
		$query_select    = mysqli_query($conectar, $select_denuncia);

		foreach ($query_select as $excluir) {
			$id_denuncia = $excluir['id_denuncia'];

			//sql que deleta o usuario e suas denuncias.
			$delete_mensagem = "DELETE FROM mensagem WHERE id_denuncia = '$id_denuncia'";
			$query_mensagem = mysqli_query($conectar, $delete_mensagem);

			$delete_arquivos = "DELETE FROM arquivo_denuncia WHERE id_denuncia = '$id_denuncia'";
			$query_arquivos = mysqli_query($conectar, $delete_arquivos);

			$delete_denuncia = "DELETE FROM denuncia WHERE id_denuncia = '$id_denuncia'";
			$query_denuncia = mysqli_query($conectar, $delete_denuncia);

		}
	
		$delete_usuario  = "DELETE FROM usuario WHERE id_usuario = '$id_usuario'";
		$query_usuario  = mysqli_query($conectar, $delete_usuario);

		
		//destruindo sessions vinculadas ao usuário deletado.
		session_destroy();

		//Fecha a conexão
		mysqli_close($conectar);

		//redirecionando.
		header('location:usuario_login_front.php');

	//$row =! 1, algo está errado
	} else {
		$_SESSION['erros_excluir_usuarios'] = "Não foi possivel deletar sua conta, tente novamente";
		//Fecha a conexão
		mysqli_close($conectar);
		header('location:usuario_excluir_front.php');
	
	}

?>