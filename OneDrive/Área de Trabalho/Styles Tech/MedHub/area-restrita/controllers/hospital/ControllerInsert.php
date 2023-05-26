<?php

    if(isset($_POST['cadastrar'])){
        $nome_hosp   = trim(strip_tags($_POST["nome_hosp"]));
        $fone_hosp   = trim(strip_tags($_POST["fone_hosp"]));
        $resp_hosp   = trim(strip_tags($_POST["resp_hosp"]));
        $email_hosp  = trim(strip_tags($_POST["email_hosp"]));
        $senha_hosp  = trim(strip_tags($_POST["senha_hosp"]));
        $cep_hosp    = trim(strip_tags($_POST["cep_hosp"]));
        $uf_hosp     = trim(strip_tags($_POST["uf_hosp"]));
        $cidade_hosp = trim(strip_tags($_POST["cidade_hosp"]));
        $bairro_hosp = trim(strip_tags($_POST["bairro_hosp"]));
        $rua_hosp    = trim(strip_tags($_POST["rua_hosp"]));    
        $num_hosp    = trim(strip_tags($_POST["num_hosp"]));   
        $usuario = trim(strip_tags($_POST["usuario_id"])); 
        

        //INFO IMAGEM
        $file       = $_FILES['img_hosp'];
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
                            $insert = "INSERT into hospital ( nome_hosp, fone_hosp, resp_hosp, email_hosp, senha_hosp, cep_hosp, uf_hosp, cidade_hosp, bairro_hosp, rua_hosp, num_hosp, img_hosp, usuario_id ) 
                            VALUES ( :nome_hosp, :fone_hosp, :resp_hosp, :email_hosp, :senha_hosp, :cep_hosp, :uf_hosp, :cidade_hosp, :bairro_hosp, :rua_hosp, :num_hosp, :img_hosp, :usuario_id )";  
                        try{
                            $result = $conexao->prepare($insert);
                            $result ->bindParam(':nome_hosp',$nome_hosp, PDO::PARAM_STR);
                            $result ->bindParam(':fone_hosp',$fone_hosp, PDO::PARAM_STR);
                            $result ->bindParam(':resp_hosp',$resp_hosp, PDO::PARAM_STR);
                            $result ->bindParam(':email_hosp',$email_hosp, PDO::PARAM_STR);
                            $result ->bindParam(':senha_hosp',$senha_hosp, PDO::PARAM_STR);
                            $result ->bindParam(':cep_hosp',$cep_hosp, PDO::PARAM_STR);
                            $result ->bindParam(':uf_hosp',$uf_hosp, PDO::PARAM_STR);
                            $result ->bindParam(':cidade_hosp',$cidade_hosp, PDO::PARAM_STR);
                            $result ->bindParam(':bairro_hosp',$bairro_hosp, PDO::PARAM_STR);
                            $result ->bindParam(':rua_hosp',$rua_hosp, PDO::PARAM_STR);
                            $result ->bindParam(':num_hosp',$num_hosp, PDO::PARAM_STR);
                            $result ->bindParam(':img_hosp',$novoNome, PDO::PARAM_STR);
                            $result ->bindParam(':usuario_id',$usuario, PDO::PARAM_INT);
                            $result ->execute();
                            $contar = $result->rowCount();

                        if($contar>0){
                            echo '<div class="alert alert-success">
                                <button type="button" class="close" data-dismiss="alert">x</button>
                                <strong> Inserido com Sucesso!</strong> 
                                </div>'; 
                            header("Refresh: 1, home.php?acao=hospitais");
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