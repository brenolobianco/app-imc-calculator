<?php

 if(!isset($_GET['id_acad'])){ header("Location: home.php?acao=pagina-nao-existe"); exit;}
    $id_acad = $_GET['id_acad'];
    
        $select = "SELECT * from academico WHERE id_acad=:id_acad";

        try{
            $result = $conexao->prepare($select);
            $result ->bindParam(':id_acad', $id_acad, PDO::PARAM_INT);
            $result ->execute();
            $contar = $result->rowCount();

        if($contar>0){
            while($mostra = $result->FETCH(PDO::FETCH_OBJ)){
                $id_acad    = $mostra->id_acad;
                $nome_acad  = $mostra->nome_acad;
                $email_acad = $mostra->email_acad;
                $senha_acad = $mostra->senha_acad;
                $cpf_acad   = $mostra->cpf_acad;
                $data_nasc_acad = $mostra->data_nasc_acad;
                $periodo_acad = $mostra->periodo_acad;
                $univ_imp_acad = $mostra->univ_imp_acad;
                $senha_acad = $mostra->senha_acad;
                $img_acad = $mostra->img_acad;
                $interesse_acad = $mostra->interesse_acad;
                $outro_inter_acad = $mostra->outro_inter_acad;
            }
        }else{
            echo '<br ?><div class="alert alert-info">
            <button type="button" class="close" data-dismiss="alert">x</button>
            <strong>Opss!!!</strong> Nada adicionado.
            </div>'; exit;
        }
        }catch(PDOException $e){
            echo $e;
        }

        $novoNome = $img_acad;   

    if(isset($_POST['atualizar'])){
        $nome_acad  = trim(strip_tags($_POST["nome_acad"])); 
        $email_acad = trim(strip_tags($_POST["email_acad"]));            
        $cpf_acad   = trim(strip_tags($_POST["cpf_acad"]));
        $data_nasc_acad = trim(strip_tags($_POST["data_nasc_acad"]));
        $periodo_acad   = trim(strip_tags($_POST["periodo_acad"]));
        $univ_imp_acad  = trim(strip_tags($_POST["univ_imp_acad"]));
        $senha_acad = trim(strip_tags($_POST["senha_acad"]));
        $interesse_acad = trim(strip_tags($_POST["interesse_acad"]));
        $outro_inter_acad = trim(strip_tags($_POST["outro_inter_acad"]));

        if(!empty($_FILES['img']['name'])){             

    $file       = $_FILES['img'];
    $numFile    = count(array_filter($file['name']));
    
    //PASTA
    $folder     = 'upload/';
    
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
                    
                    $arquivo = "upload/" .$img_acad;
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
            $novoNome = $img_acad;
        }
        
        $update ="UPDATE academico SET nome_acad=:nome_acad, email_acad=:email_acad, 
        cpf_acad=:cpf_acad, data_nasc_acad=:data_nasc_acad, periodo_acad=:periodo_acad,
        univ_imp_acad=:univ_imp_acad, senha_acad=:senha_acad, img_acad=:img_acad,
        interesse_acad=:interesse_acad, outro_inter_acad=:outro_inter_acad
        WHERE id_acad=:id_acad"; 
    
        try{
            $result = $conexao->prepare($update);
            $result ->bindParam(':id_acad',$id_acad, PDO::PARAM_INT);
            $result ->bindParam(':nome_acad',$nome_acad, PDO::PARAM_STR);
            $result ->bindParam(':email_acad',$email_acad, PDO::PARAM_STR);
            $result ->bindParam(':cpf_acad',$cpf_acad, PDO::PARAM_STR);
            $result ->bindParam(':data_nasc_acad',$data_nasc_acad, PDO::PARAM_STR);
            $result ->bindParam(':periodo_acad',$periodo_acad, PDO::PARAM_STR);
            $result ->bindParam(':univ_imp_acad',$univ_imp_acad, PDO::PARAM_STR);
            $result ->bindParam(':senha_acad',$senha_acad, PDO::PARAM_STR);
            $result ->bindParam(':interesse_acad',$interesse_acad, PDO::PARAM_STR);
            $result ->bindParam(':outro_inter_acad',$outro_inter_acad, PDO::PARAM_STR);
            $result ->bindParam(':img_acad',$novoNome, PDO::PARAM_STR);
            $result ->execute();
            $contar = $result->rowCount();

        if($contar>0){
            echo '<br /><div class="alert alert-success">
                <button type="button" class="close" data-dismiss="alert">x</button>
                <strong> Atualizado com sucesso!</strong>.
                </div>';
            //header("Refresh: 1, home.php?acao=home.php?acao=perfil&id_acad=$idLog");

        }else{
            echo '<br /><div class="alert alert-warning">
        <button type="button" class="close" data-dismiss="alert">x</button>
        <strong> Erro ao atualizar!</strong> 
        </div>';
        }
        }catch(PDOException $e){
            echo $e;
        }
    }
?>