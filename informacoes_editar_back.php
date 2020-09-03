<?php
	//session + banco.
	session_start();
	include_once("conectar.php");

	//recebendo dados do formulário.
	$cai     = $_POST['descricao_cai'];
	$napne   = $_POST['descricao_napne'];
	$neabi   = $_POST['descricao_neabi'];
	$nugedis = $_POST['descricao_nugedis'];

	//atualizando no banco.
	$update_descricoes = "UPDATE descricoes 
						  SET descricao_cai     = '$cai ', 
							  descricao_napne   = '$napne', 
							  descricao_neabi   = '$neabi', 
							  descricao_nugedis = '$nugedis' 
						  WHERE id_descricao    = 1";
	//executando o comando uptade.
	$query_descricoes = mysqli_query($conectar, $update_descricoes);

	//fechando a conexão.
	mysqli_close($conectar);

	//redirecionando.
	header("location:informacoes_listagem.php");
?>