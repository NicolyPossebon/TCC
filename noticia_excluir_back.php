<?php 
	
	//session + banco.
	session_start();
	include ("conectar.php");

	//id da denuncia
	$id_noticia = $_GET['id'];
	
	//deletando primeiro a tabela estrangeira
	$delete_arquivo = "DELETE FROM arquivo_noticia WHERE id_noticia = $id_noticia";
	$query_arquivo = mysqli_query($conectar, $delete_arquivo);

	//depois a das denúncia de fato
	$delete_noticia = "DELETE FROM noticia WHERE id_noticia = '$id_noticia'";
	$query_noticia = mysqli_query($conectar, $delete_noticia);

	//fechando conexão
	mysqli_close($conectar);

	//redirecionando
	//header("location:noticia_listagem.php");
?>