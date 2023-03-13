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
if(isset($_GET['resposta']) && isset($_GET['id_quiz']) ) {
    $id_resposta = $_GET['resposta'];
    $id_quiz = $_GET['id_quiz'];

    $select = "SELECT * FROM treinamento_pre_teste WHERE id_pre_teste = :id_quiz";  
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
                    echo json_encode(["sucesso" => true, "texto" => "Resposta Correta!", "id" => $id_quiz]);
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




?>