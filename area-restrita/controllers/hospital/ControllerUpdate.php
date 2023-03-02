<?php

 if(!isset($_GET['id_hosp'])){ header("Location: home.php?acao=pagina-nao-existe"); exit;}
    $id_hosp = $_GET['id_hosp'];

        $select = "SELECT * from hospital WHERE id_hosp=:id_hosp";

        try{
            $result = $conexao->prepare($select);
            $result ->bindParam(':id_hosp', $id_hosp, PDO::PARAM_INT);
            $result ->execute();
            $contar = $result->rowCount();

        if($contar>0){
            while($mostra = $result->FETCH(PDO::FETCH_OBJ)){
                $id_hosp    = $mostra->id_hosp;
                $nome_hosp  = $mostra->nome_hosp;
                $resp_hosp   = $mostra->resp_hosp;
                $email_hosp = $mostra->email_hosp;
                $senha_hosp = $mostra->senha_hosp;
                $fone_hosp = $mostra->fone_hosp;
                $cep_hosp   = $mostra->cep_hosp;
                $uf_hosp    = $mostra->uf_hosp;
                $cidade_hosp = $mostra->cidade_hosp;
                $bairro_hosp = $mostra->bairro_hosp;
                $rua_hosp    = $mostra->rua_hosp;
                $num_hosp    = $mostra->num_hosp;
                $img_hosp    = $mostra->img_hosp;

            }
        }else{
            echo '<div class="alert alert-info">
            <button type="button" class="close" data-dismiss="alert">x</button>
            <strong>Opz!!!</strong> Você ainda tem texto adicionado.
            </div>'; exit;
        }
        }catch(PDOException $e){
            echo $e;
        }

        $novoNome = $img_hosp;   

    if(isset($_POST['atualizar'])){
        $nome_hosp   = trim(strip_tags($_POST["nome_hosp"]));
        $resp_hosp   = trim(strip_tags($_POST["resp_hosp"]));
        $email_hosp   = trim(strip_tags($_POST["email_hosp"]));
        $senha_hosp   = trim(strip_tags($_POST["senha_hosp"]));
        $fone_hosp    = trim(strip_tags($_POST["fone_hosp"])); 
        $cep_hosp     = trim(strip_tags($_POST["cep_hosp"]));  
        $uf_hosp      = trim(strip_tags($_POST["uf_hosp"]));  
        $cidade_hosp  = trim(strip_tags($_POST["cidade_hosp"]));  
        $bairro_hosp  = trim(strip_tags($_POST["bairro_hosp"]));  
        $rua_hosp     = trim(strip_tags($_POST["rua_hosp"]));  
        $num_hosp     = trim(strip_tags($_POST["num_hosp"]));

        if(!empty($_FILES['img']['name'])){             

    $file       = $_FILES['img'];
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
        /*echo '<div class="alert alert-danger">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    Selecione uma imagem e tente novamente!
                </div>';*/
    }
    else if($numFile >=2){
        echo '<div class="alert">
                <a href=""><button>x</button></a>
                <strong>Você ultrapassou o limite de dowload!</strong>
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
                $msg[] = "<b>$name :</b> Erro imagem ultrapassa o limite de 5MB";
            else{
                
                if(move_uploaded_file($tmp, $folder.'/'.$novoNome)){
                    //$msg[] = "<b>$name :</b> Upload Realizado com Sucesso!";
                    
                    $arquivo = "../upload/" .$img_hosp;
                    unlink($arquivo);
                    
                }else
                    $msg[] = "<b>$name :</b> Desculpe! Ocorreu um erro...";
            
            }
            
            foreach($msg as $pop)
            echo '';
                //echo $pop.'<br>';
        }
    }
                    
        }// se o input file n estiver vazio
        else{
            $novoNome = $img_hosp;
        }
        
        $update ="UPDATE hospital SET nome_hosp=:nome_hosp, resp_hosp=:resp_hosp, email_hosp=:email_hosp, senha_hosp=:senha_hosp, fone_hosp=:fone_hosp, cep_hosp=:cep_hosp, uf_hosp=:uf_hosp, cidade_hosp=:cidade_hosp, bairro_hosp=:bairro_hosp, rua_hosp=:rua_hosp, num_hosp=:num_hosp, img_hosp=:img_hosp  WHERE id_hosp=:id_hosp"; 
        try{
            $result = $conexao->prepare($update);
            $result ->bindParam(':id_hosp',$id_hosp, PDO::PARAM_INT);
            $result ->bindParam(':nome_hosp',$nome_hosp, PDO::PARAM_STR);
            $result ->bindParam(':resp_hosp',$resp_hosp, PDO::PARAM_STR);
            $result ->bindParam(':email_hosp',$email_hosp, PDO::PARAM_STR);
            $result ->bindParam(':senha_hosp',$senha_hosp, PDO::PARAM_STR);
            $result ->bindParam(':fone_hosp',$fone_hosp, PDO::PARAM_STR);
            $result ->bindParam(':cep_hosp',$cep_hosp, PDO::PARAM_STR);
            $result ->bindParam(':uf_hosp',$uf_hosp, PDO::PARAM_STR);
            $result ->bindParam(':cidade_hosp',$cidade_hosp, PDO::PARAM_STR);
            $result ->bindParam(':bairro_hosp',$bairro_hosp, PDO::PARAM_STR);
            $result ->bindParam(':rua_hosp',$rua_hosp, PDO::PARAM_STR);
            $result ->bindParam(':num_hosp',$num_hosp, PDO::PARAM_STR);
            $result ->bindParam(':img_hosp',$novoNome, PDO::PARAM_STR);
            $result ->execute();
            $contar = $result->rowCount();

        if($contar>0){
            echo '<div class="alert alert-success">
                <button type="button" class="close" data-dismiss="alert">x</button>
                <strong> Atualizado com sucesso!</strong>.
                </div>';
            header("Refresh: 1, home.php?acao=hospitais");

        }else{
            echo '<div class="alert alert-warning">
        <button type="button" class="close" data-dismiss="alert">x</button>
        <strong> Erro ao atualizar!</strong> 
        </div>';
        }
        }catch(PDOException $e){
            echo $e;
        }
    }
?>