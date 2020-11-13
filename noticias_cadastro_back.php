<?php
    
    //Sesseion + banco.
	session_start();
	include("conectar.php");

    //Recebendo os dados do formulário.
	$titulo_noticia    = $_POST['titulo_noticia'];
	$descricao_noticia = $_POST['descricao_noticia'];
	$data_noticia      = date("Y/m/d H:i:s");
    $noticia           = $_POST['video_noticia'];
  
    //Se a $_FILES não estiver vazia...
	if(!empty($_FILES['foto']['tmp_name'][0])){

		//Incerção dos dados na tabela notícia.
        $insert_noticias = "INSERT INTO noticia
        						(titulo_noticia, data_noticia, descricao_noticia) 
        				   VALUES 
        				        ('$titulo_noticia', '$data_noticia', '$descricao_noticia')";
        //Query executando.
        $query_noticias = mysqli_query($conectar, $insert_noticias);

        //Bloco de código que seleciona a última postagem, no caso a feita no início do arquivo, 
        //para que assim o arquivo seja incerido com o id da postagem certo.
        $select_noticia = "SELECT * FROM noticia ORDER BY id_noticia DESC limit 1";
        $query_select_noticia = mysqli_query($conectar, $select_noticia);
        $dados = mysqli_fetch_assoc($query_select_noticia);
        $id_noticia = $dados['id_noticia'];

        if(empty($noticia)){
            
            //Se tiver vazia, não cadastra nada, senão aparece o "esqueleto" do vídeo por causa da $video.
        } else {
          
            $video            = "https://www.youtube.com/embed/";  
            $cortando         = explode( "&", $noticia);
            $pegando          = $cortando[0];
            $videonoticia     = substr($pegando, 32);
            $endereco_arquivo = $video.$videonoticia;

            $insert_arquivos = "INSERT INTO arquivo_noticia
                                    (id_noticia, endereco_arquivo_noticia, tipo_arquivo_noticia)
                                VALUES
                                    ($id_noticia, '$endereco_arquivo', 3)";
            $query_arquivos = mysqli_query($conectar, $insert_arquivos);
        }
    
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
                $pasta ="postagens/";

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
    				    $insert_arquivo = "INSERT INTO arquivo_noticia 
    				    				(id_noticia, endereco_arquivo_noticia, tipo_arquivo_noticia) 
    				    			VALUES 
    				    				($id_noticia, '$arquivo_insert', $tipo)";
    				    $query_arquivo = mysqli_query($conectar, $insert_arquivo);
            
                    } else {
                        //Se não vai para a pasta
                        echo "não foi possivel fazer o upload.";
                    }

            } else {
                //Se não é das extenções permitidas
                $_SESSION['arquivo_invalido'] = "O formato do arquivo é inválido!";
                echo "Formato inválido";
                header('location:noticias_cadastro_front.php');
                exit;
            }

            $contador++;    
        }


    header('location:noticias_listagem.php');



	} else {

        //Insert inserido a notícia no banco.
    	$insert_noticia = "INSERT INTO noticia
    						(titulo_noticia, data_noticia, descricao_noticia)
    					   VALUES 
    					   	('$titulo_noticia', '$data_noticia', '$descricao_noticia')";

        //Query executando.
    	$query_noticia = mysqli_query($conectar, $insert_noticia);

        if(empty($noticia)){
            //Se tiver vazia, não cadastra nada, senão aparece o "esqueleto" do vídeo por causa da $video.
        } else {
            $video            = "https://www.youtube.com/embed/";  
            $cortando         = explode( "&", $noticia);
            $pegando          = $cortando[0];
            $videonoticia     = substr($pegando, 32);
            $endereco_arquivo = $video.$videonoticia;

            //Bloco de código que pega o ID da notícia recem postada, para que o vídeo abaixo seja inserido com o ID correto.
            $select_id = "SELECT * FROM noticia ORDER BY id_noticia DESC limit 1";
            $query_select_id = mysqli_query($conectar, $select_id);
            $dados = mysqli_fetch_assoc($query_select_id);
            $id_noticia = $dados['id_noticia'];

            //Inserindo os Arquivos.
             $insert_arquivos = "INSERT INTO arquivo_noticia
                                    (id_noticia, endereco_arquivo_noticia, tipo_arquivo_noticia)
                                VALUES
                                    ($id_noticia, '$endereco_arquivo', 3)";
           
            //Query executando o insert.
            $query_arquivos = mysqli_query($conectar, $insert_arquivos);
            }

        //Fechando a conexão.
    	mysqli_close($conectar);

        //Redirecionando.
    	header("location:noticias_listagem.php");
	} 
?>