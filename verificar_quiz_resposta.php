<?php



include 'controllers/log/logado.php'; 

$select = "SELECT * from m";  
try{
    $result = $conexao->prepare($select);
    $result ->execute();
    $contar = $result->rowCount();

    if($contar>0){
        while($mostra = $result->FETCH(PDO::FETCH_OBJ)){

            if($mostra->m_m != '1'){
                echo 'MANUTENÇÃO';
                exit(0);
            }
        }
    }
} catch (Exception $e) {
    echo $e;
}


include_once 'controllers/log/logado.php';
if(isset($_GET['id_aula']) && isset($_GET['resposta'])) {
    $id_aula = $_GET['id_aula'];
    $id_resposta = $_GET['resposta'];
    $select = "SELECT * FROM quiz_treinamento WHERE id_quiz = :id_quiz";  
    try{
        $result = $conexao->prepare($select);
        $result->bindParam(':id_quiz', $id_quiz, PDO::PARAM_INT);
        $result ->execute();
        $contar = $result->rowCount();
        if($contar>0){
            while($mostra = $result->FETCH(PDO::FETCH_OBJ)){
                $alternativa_correta = $mostra->alternativa_correta;
                $id_quiz = $mostra->id_quiz;
                if($alternativa_correta == $id_resposta) {
                    echo json_encode(["sucesso" => true, "texto" => "Resposta Correta!"]);
                } else {
                    errou($conexao, $idLog, $id_quiz);
                    echo json_encode(["sucesso" => false, "texto" => "Resposta incorreta!"]);
                }
            }
        }
} catch (Exception $e) {
    echo $e;
}
}


function errou($conexao, $idUsuario, $idQuiz) {
    if(existe_columa($conexao, $idUsuario)) {
        adicionar_erro($conexao, $idUsuario, $idQuiz);
    } else {
        criar_erros($conexao, $idUsuario, $idQuiz);
        adicionar_erro($conexao, $idUsuario, $idQuiz);
    }
}

function num_erros($conexao, $idUsuario, $idQuiz){
    $select = "SELECT num_erros FROM quiz_treinamento_num_erros WHERE id_usuario = :id_usuario";
    $result = $conexao->prepare($select);
    $result->bindParam(':id_usuario', $idUsuario, PDO::PARAM_INT);
    $result ->execute();    
}


function adicionar_erro($conexao, $idUsuario, $idQuiz) {
    $sql = "UPDATE quiz_treinamento_num_erros SET num_erros = num_erros + 1 WHERE id_usuario = :id_usuario AND id_quiz = :id_quiz";  
    $result = $conexao->prepare($sql);
    $result->bindParam(':id_usuario', $idUsuario, PDO::PARAM_INT);
    $result->bindParam(':id_quiz', $idQuiz, PDO::PARAM_INT);
    $result ->execute();
    $contar = $result->rowCount();
    return $contar;
}

function criar_erros($conexao, $idUsuario, $idQuiz) {
    try {
        $insert = "INSERT INTO quiz_treinamento_num_erros(id_usuario, id_quiz) VALUES(:id_usuario, :id_quiz)";  
        $result = $conexao->prepare($insert);
        $result->bindParam(':id_usuario', $idUsuario, PDO::PARAM_INT);
        $result->bindParam(':id_quiz', $idQuiz, PDO::PARAM_INT);
        $result->execute();
        $contar = $result->rowCount();
        return $contar;
    } catch (\Exception $th) {
        throw $th;
    }
}

function existe_columa($conexao, $idUsuario) {
    $select = "SELECT * FROM quiz_treinamento_num_erros WHERE id_usuario = :id_usuario";
    $result = $conexao->prepare($select);
    $result->bindParam(':id_usuario', $idUsuario, PDO::PARAM_INT);
    $result ->execute();
    $contar = $result->rowCount();
    return $contar;
}



?>