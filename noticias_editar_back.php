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


	//se a variável que armazena o que vem do vídeo vem vazia, não atualiza. Caso atualizasse, algo "em branco" iria pro banco e aí o vídeo poderia ser perdido.
	if(empty($noticia)){
		//Se tiver fazio não atualiza.

	//Se tiver algo dentro, atualiza o link.
	}else {

 		$video            = "https://www.youtube.com/embed/";  
        $cortando         = explode( "&", $noticia);
        $pegando          = $cortando[0];
        $videonoticia     = substr($pegando, 32);
        $endereco_arquivo = $video.$videonoticia;

    	//update dos arquivos.
		$update_arquivo = "UPDATE arquivo_noticia
						   SET endereco_arquivo_noticia = '$endereco_arquivo',
						   	   tipo_arquivo_noticia     = 3
						   WHERE id_noticia = $id_noticia and tipo_arquivo_noticia = 3";
		//Query executando o update.
		$query_arquivo = mysqli_query($conectar, $update_arquivo);
	

	}

	//Se a global files não estiver fazia, atualiza as imagens.
	if(!empty($_FILES['foto']['tmp_name'][0])){
		        
		//Extenções permitidas.
	    $extensoes_permitidas = array("png", "jpeg", "jpg", "mp3", "ogg");

	    //Conta quantos arquivo há na global.
	    $quantidadeArquivos = count($_FILES['foto']['name']);

	    $contador = 0;

	    //While que repete até a $quantidadeArquivos.
		while($contador < $quantidadeArquivos){

			//Pega a extensao do arquivo.
			$extensao = pathinfo($_FILES['foto']['name'][$contador], PATHINFO_EXTENSION);

			//Testa para ver se a extenção do arquivos escolhido pelo usuário está no array.
			if(in_array($extensao, $extensoes_permitidas)){

				//Se sim... diretório onde as fotos serão armazenadas.
			    $pasta           ="postagens/";

			    //Nome temporário (?)
		        $temporario      = $_FILES['foto']['tmp_name'][$contador];

		        //Uniqid faz com que cada foto tenha um nome único e concatena com a extensao.
		        $midia           = uniqid().".$extensao";

		        //Une a pasta com o nome do arquivo, ou seja, armazena em $enderecoarquivo o endereco da imagem no pc.
		        $enderecoarquivo = $pasta.$midia;

		        //If que testa se manda pra pasta.
			    if(move_uploaded_file($temporario, $pasta.$midia)){
			        //echo "Upload feito com sucesso";
			        
			        //Testa a estensão para inserir no banco.
			        if ($extensao == "png" or $extensao == "jpeg" or $extensao == "jpg"){
			   			$tipoarquivo = 1;
			    	} elseif ($extensao == "mp3" or $extensao =="ogg") {
			    			$tipoarquivo = 2;
			   	    }

			   	    //Se o contador vem nulo, não arquivos para serem atualizados.
			   	    if($contador == 0){
			   	    	//echo "oi";
			   	   		$excluir_arquivos = "DELETE FROM arquivo_noticia WHERE id_noticia = $id_noticia AND tipo_arquivo_noticia != 3";
						$query_excluir    = mysqli_query($conectar, $excluir_arquivos);
			       	}

					$insert_arquivos  = "INSERT INTO arquivo_noticia 
										    (id_noticia, endereco_arquivo_noticia, tipo_arquivo_noticia) 
										VALUES 
											($id_noticia, '$enderecoarquivo', $tipoarquivo)";
				    $query_insert = mysqli_query($conectar, $insert_arquivos);

		        } else {
			            $_SESSION['erros_noticias'] = "Não foi possível realizar o cadastro. Tente novamente!";
                        header('location:noticias_editar_front.php');
                        exit;
			        }

			}else{
			   $_SESSION['erros_noticias'] = "O formato do arquivo é inválido! Lembre-se, você só pode selecionar arquivos do tipo png, jpeg, jpg, mp3, ogg!";
                header('location:noticias_editar_front.php?id_noticia='.$id_noticia.'');
                exit;
			}

			$contador++;    
		}

	}
	
	// fim da conexão.
	mysqli_close($conectar);

	//redirecionado.
	header('location:noticia_vermais_front.php?id_noticia='.$id_noticia.'');  

?>
