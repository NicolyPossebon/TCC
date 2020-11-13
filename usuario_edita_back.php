<?php
	//Session + banco.
	session_start();
	include("conectar.php");

	//Pegando as informações do usuário.
	$id_usuario    = $_SESSION['id_usuario'];
	$nome_usuario  = mysqli_real_escape_string($conectar, $_POST["nome_usuario"]);
	$email_usuario = mysqli_real_escape_string($conectar, $_POST["email_usuario"]);
	$senha_usuario = md5(mysqli_real_escape_string($conectar, $_POST["senha_usuario"]));

	//Se a pessoa realmente mudar de email, testa
	//pra ver se outra já não o tem; Se ela quiser
	//o mesmo, ainda assim, nenhuma outra deve o ter, 
	//a não ser ela mesmo.
	$select = "SELECT * FROM usuario 
			   WHERE email_usuario = '$email_usuario' 
			   AND id_usuario != $id_usuario";

	//executando o select.
	$result = mysqli_query($conectar, $select);

	//tranformando em numero de retornos.
	$row = mysqli_num_rows($result);

	//Se a pessoa realmente mudar de nome, testa
	//pra ver se outra já não o tem; Se ela quiser
	//o mesmo, ainda assim, nenhuma outra deve o ter, 
	//a não ser ela mesmo.
	$select2 = "SELECT * FROM usuario 
			   WHERE nome_usuario = '$nome_usuario' 
			   AND id_usuario != $id_usuario";

	//executando o select
	$result2 = mysqli_query($conectar, $select2);

	//tranformando em numero de retornos/linhas.
	$row2 = mysqli_num_rows($result2);

	//Se ambas as variáveis deram == 0, significa que não encontrou outro nome/outra linha no banco.
    if ($row == 0 && $row2 == 0){
    	//Assim, o update é feito.
		$update = " UPDATE usuario 
					SET nome_usuario  = '$nome_usuario', 
						email_usuario = '$email_usuario', 
						senha_usuario = '$senha_usuario'
					WHERE id_usuario  = $id_usuario";

		//executando o uptade.
		$query = mysqli_query($conectar, $update);

		//Apagando dados da session erros.
		unset($_SESSION['erros']);

		//E atribuindo a session acertos.
		$_SESSION['acertos'] = "Dados Alterados com Sucesso!";

		//fechando a conexão e redirecionando.
	    mysqli_close($conectar);
		header('location:usuario_edita_front.php');

	//Se ambas derem maiores que 1, significa que há usuários com os dados já cadastrados.
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