<?php
	
	//Session + Banco.		
	session_start();
	include_once("conectar.php");

	//Recebendo Dados por POST
	$id_noticia        = $_POST['id_noticia'];
	$titulo_noticia    = $_POST['titulo_noticia'];
	$descricao_noticia = $_POST['descricao_noticia'];
	$noticia           = $_POST['video_noticia'];

	//Atualizando as Notícias;
	$update_noticia = " UPDATE noticia 
						SET titulo_noticia    = '$titulo_noticia', 
							descricao_noticia = '$descricao_noticia'	
						WHERE id_noticia  = $id_noticia";
	//Executando o Update.
	$query_noticia = mysqli_query($conectar, $update_noticia);

	if(empty($noticia)){
		//Se tiver fazio não atualiza.
	}else {

		
		$video             	   = "https://www.youtube.com/embed/";
		$video_noticia         = substr($noticia, 32,-28);
    	$endereco_noticia      = $video.$video_noticia;


    	//update dos arquivos.
		$update_arquivo = "UPDATE arquivo_noticia
						   SET endereco_arquivo_noticia = '$endereco_noticia',
						   	   tipo_arquivo_noticia     = 3
						   WHERE id_noticia = $id_noticia and tipo_arquivo_noticia = 3";
		//Query executando o update.
		$query_arquivo = mysqli_query($conectar, $update_arquivo);
	

	}

	if(!empty($_FILES['foto']['tmp_name'][0])){
		        
		//arquivos permitidos
	    $extensoes_permitidas = array("png", "jpeg", "jpg", "mp3", "ogg");
	    $quantidadeArquivos = count($_FILES['foto']['name']);
	    $contador = 0;

		while($contador < $quantidadeArquivos){

			$extensao = pathinfo($_FILES['foto']['name'][$contador], PATHINFO_EXTENSION);

			if(in_array($extensao, $extensoes_permitidas)){
			    $pasta           ="postagens/";
		        $temporario      = $_FILES['foto']['tmp_name'][$contador];
		        $midia           = uniqid().".$extensao";
		        $enderecoarquivo = $pasta.$midia;


			    if(move_uploaded_file($temporario, $pasta.$midia)){
			        echo "Upload feito com sucesso";
			        
			        if ($extensao == "png" or $extensao == "jpeg" or $extensao == "jpg"){
			   			$tipoarquivo = 1;
			    	} elseif ($extensao == "mp3" or $extensao =="ogg") {
			    			$tipoarquivo = 2;
			   	    }

			   	    if($contador == 0){
			   	    	echo "oi";
			   	   		$excluir_arquivos = "DELETE FROM arquivo_noticia WHERE id_noticia = $id_noticia AND tipo_arquivo_noticia != 3";
						$query_excluir    = mysqli_query($conectar, $excluir_arquivos);
			       	}

					$insert_arquivos  = "INSERT INTO arquivo_noticia 
										    (id_noticia, endereco_arquivo_noticia, tipo_arquivo_noticia) 
										VALUES 
											($id_noticia, '$enderecoarquivo', $tipoarquivo)";
				    $query_insert = mysqli_query($conectar, $insert_arquivos);

		        } else {
			            echo "não foi possivel fazer o upload.";
			        }

			}else{
			    echo "Formato inválido";
			}

			$contador++;    
		}

	}
	
	mysqli_close($conectar);
	
	header('location:noticia_vermais_front.php?id_noticia='.$id_noticia.'');  

?>
