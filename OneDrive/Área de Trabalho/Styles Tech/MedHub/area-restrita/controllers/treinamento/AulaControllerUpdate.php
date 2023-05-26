<?php


function updateVidAula($aula_id_vid, $nome_vid) {
    global $conexao;
    $conn = $conexao;

    //Receber os dados do formulário
    $nome_arq = $_FILES['arq_vid']['name'];
    $ext = pathinfo($nome_arq, PATHINFO_EXTENSION);
    $base = pathinfo($nome_arq, PATHINFO_FILENAME);

    $nome_arq_webm = null;
    if(!empty($nome_arq)){
        $nome_arq_webm = $base . "." . $ext;
    };


    $aula = getAulaVidByAula($aula_id_vid);
    $id = $aula->id_vid;
    
    //Diretório onde o arquivo vai ser salvo
    $diretorio = __DIR__ . '/../../../videos/' . $id . '/';
    
    $targetFile = $diretorio . $base . "." . $ext;


    //var_dump($_FILES['imagem']);
    //Inserir no BD
    $result_img = "UPDATE aula_vid SET nome_vid = :nome_vid, arq_vid = :arq_vid WHERE aula_id_vid = :aula_id_vid";
    $insert_msg = $conn->prepare($result_img);
    $insert_msg->bindParam(':nome_vid', $nome_vid);
    $insert_msg->bindParam(':aula_id_vid', $aula_id_vid);
    $insert_msg->bindParam(':arq_vid', $nome_arq_webm);
    //Verificar se os dados foram inseridos com sucesso
    if ($insert_msg->execute()) {
        if (!empty($nome_arq)) {
            
            //Recuperar último ID inserido no banco de dados
            $permitido = array(
                "mp4",
                "avi",
                "mov",
                "wmv",
                "flv",
                "mkv",
                "webm",
                "m4v"
            );
            
            $ext = pathinfo($nome_arq, PATHINFO_EXTENSION);
            if (!in_array($ext, $permitido)) {
                $_SESSION['msg'] = "<div class='alert alert-danger'>
                <button type='button' class='close' data-dismiss='alert'>x</button>
                <strong> Erro! Apenas video!</strong> 
                </div>";
                exit(0);
            }

            
            if(file_exists($targetFile)) {
                chmod($targetFile, 0755); //Change the file permissions if allowed
                unlink($targetFile); //remove the file
            }

            if(!@mkdir($diretorio, 0755, true)) {
                $error = error_get_last();
                // echo $error['message'];
            }

            $tmp = $_FILES['arq_vid']['tmp_name'];
            if (move_uploaded_file($tmp, $targetFile)) {
                $_SESSION['msg'] = "<div class='alert alert-success'>
                <button type='button' class='close' data-dismiss='alert'>x</button>
                <strong> Inserido com Sucesso!</strong> 
                </div>";
            }
        }

        $_SESSION['msg'] = "<div class='alert alert-success'>
        <button type='button' class='close' data-dismiss='alert'>x</button>
        <strong> Inserido com Sucesso!</strong> 
        </div>";
    } else {
        $_SESSION['msg'] = "<div class='alert alert-danger'>
        <button type='button' class='close' data-dismiss='alert'>x</button>
        <strong> Erro!</strong> 
        </div>";
    }
 }


 if(isset($_POST['remove_video'])){
    if(isset($_GET['id_aula'])){
        $id_aula = $_GET['id_aula'];
        $id_vid = getAulaVidByAula($id_aula)->id_vid;
        if(empty($id_vid)){
            exit(0);
        }

        $diretorio = __DIR__ . '/../../../videos/' . $id_vid;

        if($id_vid) {
            // deletar todos os arquivos de video
            deleteByExtension($diretorio, array("mp4", "avi", "mov", "wmv", "flv", "mkv", "webm", "m4v"));
        }
    }
}

function deleteByExtension($dir, $exts) {
    foreach(glob($dir . "/*") as $file) {
        $nameFile = basename($file);
        $ext = pathinfo($nameFile, PATHINFO_EXTENSION);
        if(in_array($ext, $exts)) {
            chmod($file, 0755); //Change the file permissions if allowed
            unlink($file);
            break;
        }
    }
}

function dropfyThumb($dir, $exts) {
    foreach(glob($dir . "/*") as $file) {
        $nameFile = basename($file);
        $ext = pathinfo($nameFile, PATHINFO_EXTENSION);
        if(in_array($ext, $exts)) {
            if(file_exists($file) && is_file($file)) {
                return $file;
            }
        }
    }

    return false;
}


function getAulaVidByAula($id_aula) {
    global $conexao;
    $conn = $conexao;

    $select = "SELECT * FROM aula_vid WHERE aula_id_vid = :aula_id_vid LIMIT 1";
    $result = $conn->prepare($select);
    $result->bindParam(':aula_id_vid', $id_aula);
    $result->execute();
    $aula_vid = $result->fetchAll(PDO::FETCH_OBJ);
    return $aula_vid[0];
}



if(!isset($_GET['id_aula'])){ header("Location: home.php?acao=pagina-nao-existe"); exit;}
   $id_aula = $_GET['id_aula'];
        
        $select = "SELECT * from aula a 
        LEFT JOIN modulo m ON m.id_mod = a.mod_id_aula 
        LEFT JOIN curso s ON s.id_curso = a.curso_id_aula
        LEFT JOIN estagio e ON e.id_est = a.est_id_aula
        LEFT JOIN professor p ON p.id_prof = a.prof_id_aula 
        WHERE id_aula=:id_aula AND a.treinamento = 'sim'";

        try{
          $result = $conexao->prepare($select);
          $result ->bindParam(':id_aula', $id_aula, PDO::PARAM_INT);
          $result ->execute();
          $contar = $result->rowCount();

        if($contar>0){
          while($mostra = $result->FETCH(PDO::FETCH_OBJ)){
            $id_aula    = $mostra->id_aula;
            $nome_aula  = $mostra->nome_aula;
            $curso_id_aula = $mostra->curso_id_aula;
            $prof_id_aula = $mostra->prof_id_aula;
            $mod_id_aula = $mostra->mod_id_aula;
            $est_id_aula = $mostra->est_id_aula;
            $desc_aula  = $mostra->desc_aula;
            $nome_prof = $mostra->nome_prof;
            $nome_curso = $mostra->nome_curso;
            $nome_mod = $mostra->nome_mod;
            $nome_est = $mostra->nome_est;
            $taxa_acerto_quiz = $mostra->taxa_acerto_quiz ?? 0;
            $aula = getAulaVidByAula($id_aula);
            $id_vid = $aula->id_vid;
            $cronograma_semanas = $mostra->cronograma_semanas;

            $dropfy_thumb = false;
            $exists = dropfyThumb(__DIR__ . '/../../../videos/' . $id_vid,  array("mp4", "avi", "mov", "wmv", "flv", "mkv", "webm", "m4v"));
            if($exists && !empty($id_vid)) {
                $dropfy_thumb = $exists;
            }

        }
        }else{
          echo '<div class="alert alert-info">
          <button type="button" class="close" data-dismiss="alert">x</button>
          <strong>Opz!!!</strong> Nada adicionado.
          </div>'; exit;
        }
        }catch(PDOException $e){
          echo $e;
        }

    if(isset($_POST['atualizar'])){
      $nome_aula   = trim(strip_tags($_POST["nome_aula"]));
      $desc_aula   = trim(strip_tags($_POST["desc_aula"])); 
      $mod_id_aula  = trim(strip_tags($_POST["mod_id_aula"]));  
      $est_id_aula  = trim(strip_tags($_POST["est_id_aula"]));
      $prof_id_aula  = trim(strip_tags($_POST["prof_id_aula"]));
      $taxa_acerto_quiz = trim(strip_tags($_POST["taxa_acerto_quiz"]));
        $cronograma_semanas = trim(strip_tags($_POST["cronograma_semanas"]));
      
            $update ="UPDATE aula SET nome_aula=:nome_aula, 
            mod_id_aula=:mod_id_aula, est_id_aula=:est_id_aula, prof_id_aula=:prof_id_aula,
            desc_aula=:desc_aula, taxa_acerto_quiz=:taxa_acerto, cronograma_semanas=:cronograma_semanas WHERE id_aula=:id_aula"; 
            try{
                $result = $conexao->prepare($update);
                $result ->bindParam(':id_aula',$id_aula, PDO::PARAM_INT);
                $result ->bindParam(':nome_aula',$nome_aula, PDO::PARAM_STR);
                $result ->bindParam(':desc_aula',$desc_aula, PDO::PARAM_STR);
                $result ->bindParam(':mod_id_aula',$mod_id_aula, PDO::PARAM_INT);
                $result ->bindParam(':est_id_aula',$est_id_aula, PDO::PARAM_INT);
                $result ->bindParam(':prof_id_aula',$prof_id_aula, PDO::PARAM_INT);
                $result ->bindParam(':taxa_acerto',$taxa_acerto_quiz, PDO::PARAM_INT);
                $result ->bindParam(':cronograma_semanas',$cronograma_semanas, PDO::PARAM_INT);
                $result ->execute();
                $contar = $result->rowCount();
                updateVidAula($id_aula, $nome_aula);

            if($contar>0){
                echo '<div class="alert alert-success">
                    <button type="button" class="close" data-dismiss="alert">x</button>
                    <strong> Atualizado com Sucesso!</strong> 
                    </div>'; 
                    header("Refresh: 1, home.php?acao=aulas-treinamento-v2");
            }else{
                echo '<div class="alert alert-success">
                <button type="button" class="close" data-dismiss="alert">x</button>
                <strong> Atualizado com Sucesso!</strong> 
                </div>'; 
            }
        }catch(PDOException $e){
            echo $e;
        }
                                    
    }    

?>