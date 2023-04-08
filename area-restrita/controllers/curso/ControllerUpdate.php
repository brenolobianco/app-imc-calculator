<?php

 if(!isset($_GET['id_curso'])){ header("Location: home.php?acao=pagina-nao-existe"); exit;}
    $id_curso = $_GET['id_curso'];
        $select = "SELECT * FROM curso c JOIN estagio e ON e.id_est = c.est_id_curso WHERE id_curso=:id_curso";

        try{
            $result = $conexao->prepare($select);
            $result ->bindParam(':id_curso', $id_curso, PDO::PARAM_INT);
            $result ->execute();
            $contar = $result->rowCount();

        if($contar>0){
            while($mostra = $result->FETCH(PDO::FETCH_OBJ)){
                $id_curso    = $mostra->id_curso;
                $nome_curso  = $mostra->nome_curso;
                $desc_curso  = $mostra->desc_curso;
                $img_curso   = $mostra->img_curso;
                $id_est    = $mostra->id_est;
                $nome_est  = $mostra->nome_est;

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

        $novoNome = $img_curso;   

    if(isset($_POST['atualizar'])){
        $nome_curso  = trim(strip_tags($_POST["nome_curso"]));   
        $est_id_curso = trim(strip_tags($_POST["est_id_curso"])); 
        $desc_curso  = $_POST["desc_curso"];  

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
                    
                    $arquivo = "../upload/" .$img_curso;
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
            $novoNome = $img_curso;
        }
        
        $update ="UPDATE curso SET nome_curso=:nome_curso, est_id_curso=:est_id_curso, desc_curso=:desc_curso, img_curso=:img_curso  WHERE id_curso=:id_curso"; 
        try{
            $result = $conexao->prepare($update);
            $result ->bindParam(':id_curso',$id_curso, PDO::PARAM_INT);
            $result ->bindParam(':nome_curso',$nome_curso, PDO::PARAM_STR);
            $result ->bindParam(':est_id_curso',$est_id_curso, PDO::PARAM_INT);
            $result ->bindParam(':desc_curso',$desc_curso, PDO::PARAM_STR);
            $result ->bindParam(':img_curso',$novoNome, PDO::PARAM_STR);
            $result ->execute();
            $contar = $result->rowCount();

        if($contar>0){
            echo '<div class="alert alert-success">
        <button type="button" class="close" data-dismiss="alert">x</button>
        <strong> Atualizado com sucesso!</strong>.
        </div>';
        header("Refresh: 1, home.php?acao=cursos");
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