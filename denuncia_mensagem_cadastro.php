<?php
    
    //Sesseion + banco.
	session_start();
	include("conectar.php");

	//recebendo os dados.
	$id_usuario  = $_SESSION['id_usuario'];
	$id_denuncia = $_POST['id_denuncia'];
	$mensagem_denuncia = $_POST['texto_mensagem'];
	$data_mensagem      = date("Y/m/d H:i");
  
    //Se a $_FILES não estiver vazia......
	if(!empty($_FILES['foto']['tmp_name'][0])){


		//inserindo no banco.
		$insert_mensagem = "INSERT INTO mensagem 
							(id_usuario, id_denuncia, data_mensagem, tipo_mensagem, endereco_mensagem)
				     VALUES ($id_usuario, $id_denuncia, '$data_mensagem', 0, '$mensagem_denuncia')";
		//executando o comando insert.
		$query_mensagem = mysqli_query($conectar, $insert_mensagem);

      
        //Exetenções de arquivos permitidas,
        $extensoes_permitidas = array("png", "jpeg", "jpg", "mp3", "ogg");

        //Conta quantos arquivos tem na global
        $quantidadeArquivos = count($_FILES['foto']['name']);

        $contador = 0;

        //While que repete até a $quantidadeArquivos
        while($contador < $quantidadeArquivos){

            //Pega a extensao do arquivo
            $extensao = pathinfo($_FILES['foto']['name'][$contador], PATHINFO_EXTENSION);

            //Testa para ver se a extenção do arquivos escolhido pelo usuário está no array
            if(in_array($extensao, $extensoes_permitidas)){

                //Diretório onde as fotos serão armazenadas
                $pasta ="denuncias/";

                //Nome temporário (?)
                $temporario = $_FILES['foto']['tmp_name'][$contador];

                //uniqid faz com que cada foto tenha um nome único e concatena com a extensao
                $foto = uniqid().".$extensao";

                $arquivo_insert = $pasta.$foto;
                // if que testa se manda pra pasta
                    if(move_uploaded_file($temporario, $pasta.$foto)){

                        //echo "Upload feito com sucesso";
                        //Testa a extenção para depois incerir no banco
                        if ($extensao == "png" or $extensao == "jpeg" or $extensao == "jpg"){
        					$tipo = 1;
        				} elseif ($extensao == "mp3" or $extensao =="ogg") {
        					$tipo = 2;
       					}

                        //Incere os arquivos
    				    $insert_arquivo = "INSERT INTO mensagem
    				    				(id_usuario, id_denuncia, data_mensagem, endereco_mensagem, tipo_mensagem) 
    				    			VALUES 
    				    				($id_usuario, $id_denuncia,'$data_mensagem', '$arquivo_insert', $tipo)";
    				    $query_arquivo = mysqli_query($conectar, $insert_arquivo);
            
                    } else {
                        //Se não vai para a pasta
                        $_SESSION['erros_formatos'] = "Não foi possível cadastrar a mídia selecionada";
                        header('location:ouvidoria_front.php?id='.$id_denuncia.'');
                        exit;
                    }

            } else {
                //Se não é das extenções permitidas
                $_SESSION['erros_formatos'] = "O formato do arquivo é inválido! Lembre-se, você só pode selecionar arquivos do tipo png, jpeg, jpg, mp3, ogg!";
                header('location:ouvidoria_front.php?id='.$id_denuncia.'');
                exit;
            }

            $contador++;    
        }

    mysqli_close($conectar);


    header('location:ouvidoria_front.php?id='.$id_denuncia.'');



	} else {

		//inserindo no banco.
		$insert_mensagem = "INSERT INTO mensagem 
                            (id_usuario, id_denuncia, data_mensagem, tipo_mensagem, endereco_mensagem)
                     VALUES ($id_usuario, $id_denuncia, '$data_mensagem', 0, '$mensagem_denuncia')";
		//executando o comando insert.
		$query_mensagem = mysqli_query($conectar, $insert_mensagem);

        //Fechando a conexão.
    	mysqli_close($conectar);

        //Redirecionando.
    	header('location:ouvidoria_front.php?id='.$id_denuncia.'');
	} 
?>