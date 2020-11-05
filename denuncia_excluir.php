<?php 
	
	//session + banco.
	session_start();
	include ("conectar.php");

	//id da denuncia.
	$id_denuncia = $_GET['id'];
	
	//deletando primeiro as tabelas estrangeiras.
	$delete_mensagem = "DELETE FROM mensagem WHERE id_denuncia = '$id_denuncia'";
	$query_mensagem = mysqli_query($conectar, $delete_mensagem);

	$delete_arquivos = "DELETE FROM arquivo_denuncia WHERE id_denuncia = '$id_denuncia'";
	$query_arquivos = mysqli_query($conectar, $delete_arquivos);

	//depois a das denúncia de fato.
	$delete_denuncia = "DELETE FROM denuncia WHERE id_denuncia = '$id_denuncia'";
	$query_denuncia = mysqli_query($conectar, $delete_denuncia);
	
	//fechando conexão.
	mysqli_close($conectar);

	//redirecionando.
	header("location:ouvidoria_front.php");
?>