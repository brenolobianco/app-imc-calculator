<?php


session_start();


function inserirVidAula($aula_id_vid, $nome_vid) {
    global $conexao;
    $conn = $conexao;


    //Receber os dados do formulário
    $nome_arq = $_FILES['arq_vid']['name'];
    $ext = pathinfo($nome_arq, PATHINFO_EXTENSION);
    $base = pathinfo($nome_arq, PATHINFO_FILENAME);

    // $nome_arq
    $nome_arq_webm = $base .  "." . $ext;
    //var_dump($_FILES['imagem']);
    //Inserir no BD
    $result_img = "INSERT INTO aula_vid (nome_vid, aula_id_vid, arq_vid) VALUES (:nome_vid, :aula_id_vid, :arq_vid)";
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
            $base = pathinfo($nome_arq, PATHINFO_FILENAME);
            if (!in_array($ext, $permitido)) {
                $_SESSION['msg'] = "<div class='alert alert-danger'>
                <button type='button' class='close' data-dismiss='alert'>x</button>
                <strong> Erro! Apenas video!</strong> 
                </div>";
                exit(0);
            }

            $ultimo_id = $conn->lastInsertId(); // ultimo id da tabela aula_vid
            //Diretório onde o arquivo vai ser salvo
            $diretorio = __DIR__ . '/../../../videos/' . $ultimo_id . '/';
            if (!@mkdir($diretorio, 0755, true)) {
                $error = error_get_last();
                echo $error['message'];
            }
            

            //Criar a pasta de foto 
            $tmp = $_FILES['arq_vid']['tmp_name'];

            if (move_uploaded_file($tmp, $diretorio . $nome_arq_webm ) ) {
                return true;
            }
            
        }
    } else {
        return false;
    }

}


    // insert aula
    if(isset($_POST['cadastrar'])){
        include_once("../../controllers/aulaVideo/ControllerInsert.php");

        $nome_aula   = trim(strip_tags($_POST["nome_aula"]));
        $desc_aula   = trim(strip_tags($_POST["desc_aula"])); 
        $curso_id_aula  = trim(strip_tags($_POST["curso_id_aula"]));   
        $mod_id_aula  = trim(strip_tags($_POST["mod_id_aula"]));  
        $est_id_aula  = trim(strip_tags($_POST["est_id_aula"]));
        $prof_id_aula  = trim(strip_tags($_POST["prof_id_aula"]));
        $cronograma_semanas = trim(strip_tags($_POST["cronograma_semanas"]));;
        $taxa_acerto_quiz = trim(strip_tags($_POST["taxa_acerto_quiz"]));
        if($taxa_acerto_quiz > 100) {
            $taxa_acerto_quiz = 100;
        }
        

        $arq_vid = $_FILES['arq_vid']['name'];

        $est_id_aula_treinamento  = $_POST["est_id_aula_treinamento"];
        $treinamento = null;
        $est_id_aula = $est_id_aula_treinamento;
        $treinamento = "sim";

            try{
                $insert = "INSERT INTO aula (nome_aula, desc_aula, mod_id_aula, est_id_aula, prof_id_aula, treinamento, cronograma_semanas, taxa_acerto_quiz) 
                VALUES ( 
                :nome_aula, 
                :desc_aula, 
                :mod_id_aula, 
                :est_id_aula, 
                :prof_id_aula, 
                :treinamento, 
                :cronograma_semanas, 
                :taxa_acerto_quiz)";
                $result = $conexao->prepare($insert);
                $result ->bindParam(':nome_aula',$nome_aula, PDO::PARAM_STR);
                $result ->bindParam(':desc_aula',$desc_aula, PDO::PARAM_STR);
                $result ->bindParam(':mod_id_aula',$mod_id_aula, PDO::PARAM_INT);
                $result ->bindParam(':est_id_aula',$est_id_aula, PDO::PARAM_INT);
                $result ->bindParam(':treinamento',$treinamento, PDO::PARAM_STR);

                
                $result->bindParam(':cronograma_semanas', $cronograma_semanas, PDO::PARAM_INT);
                
                $result ->bindParam(':prof_id_aula',$prof_id_aula, PDO::PARAM_INT);
                $result ->bindParam(':taxa_acerto_quiz',$taxa_acerto_quiz, PDO::PARAM_INT);

                $exec = $result ->execute();
                $contar = $result->rowCount();

                $idAulaAtual = $conexao->lastInsertId();
                inserirVidAula($idAulaAtual, $nome_aula);

            if($contar>0){
                echo '<div class="alert alert-success">
                    <button type="button" class="close" data-dismiss="alert">x</button>
                    <strong> Inserido com Sucesso!</strong> 
                    </div>'; 
            }else{
                echo '<div class="alert alert-warning">
                    <button type="button" class="close" data-dismiss="alert">x</button>
                    <strong> O Conteúdo não foi inserido de forma correta!</strong> 
                    </div>';
            }
        }catch(PDOException $e){
            echo $e;
        }
                        

    }
    

?>
