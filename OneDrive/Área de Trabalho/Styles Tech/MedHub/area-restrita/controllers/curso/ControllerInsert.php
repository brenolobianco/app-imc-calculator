<?php

    if(isset($_POST['cadastrar'])){
        $nome_curso  = trim(strip_tags($_POST["nome_curso"]));   
        $est_id_curso = trim(strip_tags($_POST["est_id_curso"]));  
        $desc_curso  = $_POST["desc_curso"]; 
        $usuario = trim(strip_tags($_POST["usuario_id"]));         

        //INFO IMAGEM
        $file       = $_FILES['img_curso'];
        $numFile    = count(array_filter($file['name']));
        
        //PASTA
        $folder     = '../upload/';
        
        //REQUISITOS
        $permite    = array('image/jpeg', 'image/png');
        $maxSize    = 3000 * 3000 * 4;
        
        //MENSAGENS
        $msg        = array();
        $errorMsg   = array(
            1 => 'O arquivo no upload é maior do que o limite definido em upload_max_filesize no php.ini.',
            2 => 'O arquivo ultrapassa o limite de tamanho em MAX_FILE_SIZE que foi especificado no formulário HTML',
            3 => 'o upload do arquivo foi feito parcialmente',
            4 => 'Não foi feito o upload do arquivo'
        );
        
        if($numFile <= 0){
            echo '<div class="alert">
                    <a href=""><button>x</button></a>
                    Selecione uma Imagem.
                </div><br /><br />'; 
        }
        else if($numFile >=2){
            echo '<div class="alert">
                    <a href=""><button>x</button></a>
                    Você ultrapasso o limite de Imagem.
                </div><br /><br />'; 
        }else{
            for($i = 0; $i < $numFile; $i++){
                $name   = $file['name'][$i];
                $type   = $file['type'][$i];
                $size   = $file['size'][$i];
                $error  = $file['error'][$i];
                $tmp    = $file['tmp_name'][$i];
                
                $extensao = @end(explode('.', $name));
                $novoNome = rand().".$extensao";
                
                if($error != 0)
                    $msg[] = "<b>$name :</b> ".$errorMsg[$error];
                else if(!in_array($type, $permite))
                    $msg[] = "<b>$name :</b> Erro imagem não suportada!";
                else if($size > $maxSize)
                    $msg[] = "<b>$name :</b> Erro imagem ultrapassa o limite de 1MB";
                else{
                    
                    if(move_uploaded_file($tmp, $folder.'/'.$novoNome)){
                        //$msg[] = "<b>$name :</b> Upload Realizado com Sucesso!";
                            $insert = "INSERT into curso ( nome_curso, est_id_curso, desc_curso, img_curso, usuario_id) 
                            VALUES ( :nome_curso, :est_id_curso, :desc_curso, :img_curso, :usuario_id )";  
                        try{
                            $result = $conexao->prepare($insert);
                            $result ->bindParam(':nome_curso',$nome_curso, PDO::PARAM_STR);
                            $result ->bindParam(':est_id_curso',$est_id_curso, PDO::PARAM_STR);
                            $result ->bindParam(':desc_curso',$desc_curso, PDO::PARAM_STR);
                            $result ->bindParam(':img_curso',$novoNome, PDO::PARAM_STR);
                            $result ->bindParam(':usuario_id',$usuario, PDO::PARAM_STR);
                   
                            $result ->execute();
                            $contar = $result->rowCount();

                        if($contar>0){
                            echo '<div class="alert alert-success">
                                <button type="button" class="close" data-dismiss="alert">x</button>
                                <strong> Inserido com Sucesso!</strong> 
                                </div>'; 
                                header("Refresh: 1, home.php?acao=cursos");
                        }else{
                            echo '<div class="alert alert-warning">
                                <button type="button" class="close" data-dismiss="alert">x</button>
                                <strong> O Conteúdo não foi inserido de forma correta!</strong> 
                                </div>';
                        }
                        }catch(PDOException $e){
                            echo $e;
                        }
                            
                    }else
                        $msg[] = "<b>$name :</b> Desculpe! Ocorreu um erro...";
                
                }
                
                foreach($msg as $pop)
                echo '';
                    //echo $pop.'<br>';
            }
        }
    }

?>