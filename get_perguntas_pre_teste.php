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


if(isset($_GET['id_aula']) && isset($_GET['acao'])) {
    $id_aula = $_GET['id_aula'];
    
    $id_vid = get_id_vid_by_aula($conexao, $id_aula);
    $temPreTeste = tem_pre_teste($conexao, $id_vid, $idLog);
    
    if(!$temPreTeste) {
        salvar_pre_teste($conexao, $id_vid, $idLog);
    }

    $acao = $_GET['acao'];
    if($acao == "get") {
        $select = "SELECT * FROM treinamento_pre_teste WHERE id_vid_aula = :id_vid_aula ORDER BY id_pre_teste";  
        try{
            $result = $conexao->prepare($select);
            $result->bindParam(':id_vid_aula', $id_aula, PDO::PARAM_INT);
            $result ->execute();
            $contar = $result->rowCount();
            $json = ["success" => true];
            $res = [];
            if($contar>0){
                while($mostra = $result->FETCH(PDO::FETCH_OBJ)){
                    array_push($res, $mostra);
                }
            } else {
                $json["success"] = false;
            }
    
            $json["result"] = $res;
            
            echo json_encode(array($json));
        } catch (Exception $e) {
            echo $e;
        }
    } elseif ($acao == "pode-fazer") {
        # code...
    }
    
}



function get_id_vid_by_aula($conexao, $id_aula) {
    $select = "SELECT *
    FROM aula_vid
    WHERE aula_id_vid = :id_vid_aula";
    $result = $conexao->prepare($select);
    $result->bindParam(':id_vid_aula', $id_aula, PDO::PARAM_INT);
    $result ->execute();
    $fetch = $result->FETCH(PDO::FETCH_OBJ);
    $id = $fetch->id_vid;
    return $id;
}



function ja_tentou($id, $conexao, $id_aula) {
    $select = "SELECT * FROM quiz_treinamento_pre_teste_tentivas WHERE data_tentativa < DATE_ADD(NOW(), INTERVAL -5 MINUTE) AND id_vid_aula = :id_vid_aula";
    $result = $conexao->prepare($select);
    $result->bindParam(':id_vid_aula', $id_aula, PDO::PARAM_INT);
    $result ->execute();
    $contar = $result->rowCount();
    if($contar >= 1) {
        return true;
    } else {
        return false;
    }
}

function pode_fazer_pre_teste($id, $conexao, $id_aula) {

}

function primeira_aula($conexao, $id_aula) {
    /**
     * 
     * A primeira sempre será liberada!
     * 
     */

    $select = "SELECT * FROM modulo INNER JOIN aula ON aula.mod_id_aula = modulo.id_mod INNER JOIN aula_vid ON aula_vid.aula_id_vid = aula.id_aula AND modulo.treinamento = 'sim' ORDER BY aula.cronograma_semanas ASC";
    $result = $conexao->prepare($select);
    $result->execute();
    $count = $result->rowCount();
    if($count) {
        return true;
    } else {
        return false;
    }
}


function aprovado_aula_anterior() {

}

function aula_liberada($conexao, $id_aula) {

}

function organizarAula() {

}

primeira_aula($conexao, 0);





function errou($conexao, $idUsuario, $idQuiz) {
    if(existe_columa($conexao, $idUsuario)) {
        adicionar_erro($conexao, $idUsuario, $idQuiz);
    } else {
        criar_erros($conexao, $idUsuario, $idQuiz);
        adicionar_erro($conexao, $idUsuario, $idQuiz);
    }
}

function num_erros($conexao, $idUsuario, $idQuiz){
    $select = "SELECT num_erros FROM quiz_treinamento_pre_teste_tentivas WHERE id_usuario = :id_usuario";
    $result = $conexao->prepare($select);
    $result->bindParam(':id_usuario', $idUsuario, PDO::PARAM_INT);
    $result ->execute();    
}


function adicionar_erro($conexao, $idUsuario, $idQuiz) {
    $sql = "UPDATE quiz_treinamento_pre_teste_tentivas SET num_erros = num_erros + 1 WHERE id_usuario = :id_usuario AND id_quiz = :id_quiz";  
    $result = $conexao->prepare($sql);
    $result->bindParam(':id_usuario', $idUsuario, PDO::PARAM_INT);
    $result->bindParam(':id_quiz', $idQuiz, PDO::PARAM_INT);
    $result ->execute();
    $contar = $result->rowCount();
    return $contar;
}

function criar_erros($conexao, $idUsuario, $idQuiz) {
    try {
        $insert = "INSERT INTO quiz_treinamento_pre_teste_tentivas(id_usuario, id_quiz) VALUES(:id_usuario, :id_quiz)";  
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
    $select = "SELECT * FROM quiz_treinamento_pre_teste_tentivas WHERE id_usuario = :id_usuario";
    $result = $conexao->prepare($select);
    $result->bindParam(':id_usuario', $idUsuario, PDO::PARAM_INT);
    $result ->execute();
    $contar = $result->rowCount();
    return $contar;
}

function salvar_pre_teste($conexao, $id_vid_aula, $id_usuario) {
    $select = "INSERT INTO quiz_treinamento_pre_teste_novo(id_vid_aula, id_usuario) VALUES (:id_vid_aula, :id_usuario)";

    $result = $conexao->prepare($select);
    $result ->bindParam(':id_vid_aula', $id_vid_aula, PDO::PARAM_INT);
    $result ->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
    $result ->execute();
    return $result;
}

function tem_pre_teste($conexao, $id_vid, $id_usuario) {
    $select = "SELECT * FROM quiz_treinamento_pre_teste_novo  WHERE id_vid_aula = :id_vid_aula AND id_usuario = :id_usuario";

    $result = $conexao->prepare($select);
    $result ->bindParam(':id_vid_aula', $id_vid, PDO::PARAM_INT);
    $result ->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
    $result ->execute();
    $count = $result->rowCount();
    if($count >= 1) {
        return true;
    } else {
        return false;
    }
}



function getAulasModulos($conexao, $id_mod){
    $select = "SELECT * FROM aula INNER JOIN aula_vid ON aula_vid.aula_id_vid = aula.id_aula WHERE mod_id_aula=:mod_id_aula AND treinamento = 'sim'";

    $result = $conexao->prepare($select);
    $result ->bindParam(':mod_id_aula', $id_mod, PDO::PARAM_INT);
    $result ->execute();
    return $result;
}

function getAulasByAulaVid($conexao, $id_vid){
    $select = "SELECT * FROM aula_vid INNER JOIN aula ON aula.id_aula = aula_vid.aula_id_vid WHERE aula_vid.id_vid = :id_vid";

    $result = $conexao->prepare($select);
    $result ->bindParam(':id_vid', $id_vid, PDO::PARAM_INT);
    $result ->execute();
    return $result;
}


function getModuloByAulaVid($conexao, $aula_vid_id){
    $select = "SELECT * FROM aula_vid INNER JOIN aula ON aula.id_aula = aula_vid.aula_id_vid WHERE aula_vid.id_vid = :id_vid";

    $result = $conexao->prepare($select);
    $result ->bindParam(':id_vid', $aula_vid_id, PDO::PARAM_INT);
    $result ->execute();
    return $result;
}


function getModulo($conexao, $id_est) {

    $select = "SELECT * FROM modulo WHERE est_id_mod=:est_id_mod AND treinamento = 'sim'";

    $result = $conexao->prepare($select);
    $result ->bindParam(':est_id_mod', $id_est, PDO::PARAM_INT);
    $result ->execute();
    return $result;
}

function getModulos($conexao) {
    $select = "SELECT * FROM modulo WHERE treinamento = 'sim'";

    $result = $conexao->prepare($select);
    $result ->execute();
    return $result;
}


?>