<?php

		session_start();
		include_once("conectar.php");


		$id_noticia        = $_POST['id_noticia'];
		$titulo_noticia    = $_POST['titulo_noticia'];
		$descricao_noticia = $_POST['descricao_noticia'];


		$update_noticia = " UPDATE noticia 
							SET titulo_noticia    = '$titulo_noticia', 
								descricao_noticia = '$descricao_noticia' 
							WHERE id_noticia  = $id_noticia";

		$query_noticia = mysqli_query($conectar, $update_noticia);

		mysqli_close($conectar);

		header('location:noticias_listagem.php');
?>