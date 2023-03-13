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

if(!isset($_GET['acao'])) {
    exit(0);
}

$acao = $_GET['acao'];


if(isset($_GET['id_aula'])) {
    $id_aula = $_GET['id_aula'];
    $id_vid = get_id_vid_by_aula($conexao, $id_aula);
    $temPreTeste = tem_pre_teste($conexao, $id_vid, $idLog);
    
    if(!$temPreTeste) {
        salvar_pre_teste($conexao, $id_vid, $idLog);
    }

    if($acao == "get-pre-teste") {
        if(pode_fazer_pre_teste($idLog, $conexao, $id_aula)) {
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
            }
        }
    }   
} elseif ($acao == "verificar-quiz-pre-teste") {
    if(isset($_GET['resposta']) && isset($_GET['id_quiz'])) {
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
                    $id_vid_aula = $mostra->id_vid_aula;
                    if($alternativa_correta == $id_resposta) {
                        acertou($conexao, $idLog, $id_quiz, $id_resposta, $id_vid_aula);
                        echo json_encode(["sucesso" => true, "texto" => "Resposta Correta!", "id" => $id_quiz]);
                    } else {
                        errou($conexao, $idLog, $id_quiz, $id_resposta, $id_vid_aula);
                        echo json_encode(["sucesso" => false, "texto" => "Resposta incorreta!", "id" => $id_quiz]);
                    }
                }
            }
        } catch (Exception $e) {
            echo $e;
        }
    }
} elseif($acao == "finalizr-pre-teste") {
    $count = finalizar_pre_teste($conexao, $idLog, $id_aula);
    if($count >= 1) {
        echo json_encode(["success" => true, "text" => "Finalizao!"]);
    } else {
        echo json_encode(["success" => false, "text" => "Ocorreu um erro!"]);
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


function pode_fazer_pre_teste($id_usuario, $conexao, $id_aula) {
    if(e_primeira_aula($conexao, $id_aula)) {
        return true;
    }

}

function verificar_aulas($conexao, $id_aula, $idLog) {
    $modulos = get_aulas($conexao, $idLog);
    $aula = get_aula($conexao, $id_aula);
    $progresso = get_progresso_pre_teste($conexao, $idLog);
    $assistidas = 1;

    foreach ($modulos as $modulo) {
        $aulas = $modulo['aulas'];
        foreach ($aulas as $aula) {
            $bdAula = $aula->id_aula;
            if($bdAula == $id_aula) {
                return true;
            }
        }
    }
}


function get_progresso_pre_teste($conexao, $idLog) {
    $select = "SELECT * FROM progresso_usuario_pre_teste WHERE id_usuario = :id_usuario";
    $result = $conexao->prepare($select);
    $result->bindParam(":id_usuario", $idLog, PDO::PARAM_INT);
    $result->execute();
    $fetch = $result->FETCH(PDO::FETCH_OBJ);
    return $fetch;
}



// verificar_aulas($conexao, $id_aula, $idLog);

function fez_anterior($id_usuario, $conexao, $id_aula) {
    if(e_primeira_aula($conexao, $id_aula)) {
        return true;
    }
}


function assistiu_aula_anterior($conexao, $id_usuario) {
    $aulas = get_aulas($conexao, $id_usuario);
    foreach ($aulas as $key) {
        echo json_encode($key);
    }
    return $aulas;
}



function e_ultima_aula_modulo($conexao) {
    $select = "SELECT * FROM modulo INNER JOIN aula ON aula.mod_id_aula = modulo.id_mod INNER JOIN aula_vid ON aula_vid.aula_id_vid = aula.id_aula AND modulo.treinamento = 'sim' ORDER BY DESC";
    $result = $conexao->prepare($select);
    $result->execute();
    $count = $result->rowCount();
    $fetch = $result->FETCH(PDO::FETCH_OBJ);
    return $fetch;
}


function primeira_aula($conexao) {
    /**
     * 
     * A primeira sempre será liberada!
     * 
     */
    $select = "SELECT * FROM modulo INNER JOIN aula ON aula.mod_id_aula = modulo.id_mod INNER JOIN aula_vid ON aula_vid.aula_id_vid = aula.id_aula AND modulo.treinamento = 'sim' AND aula.treinamento = 'sim'";
    $result = $conexao->prepare($select);
    $result->execute();
    $count = $result->rowCount();
    $fetch = $result->FETCH(PDO::FETCH_OBJ);
    return $fetch;
}



function e_primeira_aula($conexao, $id_aula) {
    $primeiraAula = primeira_aula($conexao);
    return $primeiraAula->id_aula == $id_aula;
}



function fez_aula_anterior($conexao, $id_aula) {
    if(e_primeira_aula($conexao, $id_aula)) {
        return true;
    }
}

function get_user_est($conexao, $idLog) {
    $select = 'SELECT est_id_mat FROM matricula WHERE acad_id_mat = :acad_id_mat';
    $result = $conexao->prepare($select);
    $result->bindParam(':acad_id_mat', $idLog, PDO::PARAM_INT);
    $result ->execute();

    return $result->FETCH()['est_id_mat'];
}


 
function get_aulas($conexao, $idLog) {
    $user_est = get_user_est($conexao, $idLog);
    $modulos = getModulos($conexao, $user_est);
    $modulosCount = $modulos->rowCount();
    if($modulosCount>0){
        $resp = [];
        while($mostra = $modulos->FETCH(PDO::FETCH_OBJ)){
            $id_mod = $mostra->id_mod;
            $aulas = getAulasModulos($conexao, $id_mod);

            $aulasMod = ["id_mod" => $id_mod, "aulas" => []];
            while($fetchAula = $aulas->FETCH(PDO::FETCH_OBJ)) {
                array_push($aulasMod['aulas'], $fetchAula);
            }

            array_push($resp, $aulasMod);
        }

        return array_values($resp);
    }
}


function get_aula($conexao, $id_aula){
    $select = "SELECT * FROM aula WHERE aula.id_aula = :id_aula";

    $result = $conexao->prepare($select);
    $result ->bindParam(':id_aula', $id_aula, PDO::PARAM_INT);
    $result ->execute();
    return $result;
}

function aula_liberada($conexao, $id_aula, $id_log) {
    $aulas = get_aulas($conexao, $id_log);
}


function finalizar_pre_teste($conexao, $idUsuario, $id_aula) {
    $sql = "INSERT INTO progresso_usuario_pre_teste (id_usuario, id_aula, finalizado)
    
    SELECT * FROM (SELECT :id_usuario, :id_aula, 1) AS tmp
    WHERE NOT EXISTS (
        SELECT * FROM progresso_usuario_pre_teste WHERE id_usuario = :id_usuario_2 AND id_aula = :id_aula_2
    ) LIMIT 1;
    ";  
    $result = $conexao->prepare($sql);
    $result->bindParam(':id_usuario', $idUsuario, PDO::PARAM_INT);
    $result->bindParam(':id_aula', $id_aula, PDO::PARAM_INT);
    $result->bindParam(':id_usuario_2', $idUsuario, PDO::PARAM_INT);
    $result->bindParam(':id_aula_2', $id_aula, PDO::PARAM_INT);



    $result ->execute();
    
    return $result->rowCount();
}


function errou($conexao, $idUsuario, $idQuiz, $resposta, $id_vid) {
    if(existe_coluna($conexao, $idUsuario, $idQuiz)) {
        adicionar_erro($conexao, $idUsuario, $idQuiz, $resposta, $id_vid);
    } else {
        criar_erros($conexao, $idUsuario, $idQuiz);
        adicionar_erro($conexao, $idUsuario, $idQuiz, $resposta, $id_vid);
    }
}

function acertou($conexao, $idUsuario, $idQuiz, $resposta, $id_vid_aula) {
    if(existe_coluna($conexao, $idUsuario, $idQuiz)) {
        adicionar_acerto($conexao, $idUsuario, $idQuiz, $resposta, $id_vid_aula);
    } else {
        criar_erros($conexao, $idUsuario, $idQuiz);
        adicionar_acerto($conexao, $idUsuario, $idQuiz, $resposta, $id_vid_aula);
    }
}

function num_erros($conexao, $idUsuario, $idQuiz){
    $select = "SELECT num_erros FROM quiz_treinamento_pre_teste_tentivas WHERE id_usuario = :id_usuario";
    $result = $conexao->prepare($select);
    $result->bindParam(':id_usuario', $idUsuario, PDO::PARAM_INT);
    $result ->execute();    
}

function adicionar_acerto($conexao, $idUsuario, $idQuiz, $resposta, $id_vid_aula) {
    $sql = "UPDATE quiz_treinamento_pre_teste_tentivas SET aprovado = 1, resposta=:resposta, id_vid_aula=:id_vid_aula WHERE id_usuario = :id_usuario AND id_pre_teste = :id_quiz";  
    $result = $conexao->prepare($sql);
    $result->bindParam(':id_usuario', $idUsuario, PDO::PARAM_INT);
    $result->bindParam(':id_quiz', $idQuiz, PDO::PARAM_INT);
    $result->bindParam(':resposta', $resposta, PDO::PARAM_STR);
    $result->bindParam(':id_vid_aula', $id_vid_aula, PDO::PARAM_INT);

    $result ->execute();
    $contar = $result->rowCount();
    return $contar;
}

function adicionar_erro($conexao, $idUsuario, $idQuiz, $resposta, $id_vid_aula) {
    $sql = "UPDATE quiz_treinamento_pre_teste_tentivas SET num_erros = num_erros + 1, resposta=:resposta WHERE id_usuario = :id_usuario AND id_pre_teste = :id_quiz";  
    $result = $conexao->prepare($sql);
    $result->bindParam(':id_usuario', $idUsuario, PDO::PARAM_INT);
    $result->bindParam(':id_quiz', $idQuiz, PDO::PARAM_INT);
    $result->bindParam(':resposta', $resposta, PDO::PARAM_STR);

    $result ->execute();
    $contar = $result->rowCount();
    return $contar;
}


function criar_erros($conexao, $idUsuario, $idQuiz) {
    try {
        $insert = "INSERT INTO quiz_treinamento_pre_teste_tentivas(id_usuario, id_pre_teste) VALUES(:id_usuario, :id_quiz)";  
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


function existe_coluna($conexao, $idUsuario, $idPreTeste) {
    $select = "SELECT * FROM quiz_treinamento_pre_teste_tentivas WHERE id_usuario = :id_usuario AND id_pre_teste = :id_pre_teste";
    $result = $conexao->prepare($select);
    $result->bindParam(':id_usuario', $idUsuario, PDO::PARAM_INT);
    $result->bindParam(':id_pre_teste', $idPreTeste, PDO::PARAM_INT);
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
    $select = "SELECT * FROM aula_vid INNER JOIN aula ON aula.id_aula = aula_vid.aula_id_vid WHERE aula_vid.id_vid = :id_vid ORDER BY `aula`.`cronograma_semanas` ASC";

    $result = $conexao->prepare($select);
    $result ->bindParam(':id_vid', $id_vid, PDO::PARAM_INT);
    $result ->execute();
    return $result;
}


function getModuloByAulaVid($conexao, $aula_vid_id){
    $select = "SELECT * FROM aula_vid INNER JOIN aula ON aula.id_aula = aula_vid.aula_id_vid WHERE aula_vid.id_vid = :id_vid ORDER BY `aula`.`cronograma_semanas` ASC";

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


function getModulos($conexao, $est_id_mod) {


    $select = "SELECT * FROM modulo WHERE treinamento = 'sim' AND est_id_mod = :est_id_mod";
    $result = $conexao->prepare($select);
    $result->bindParam(':est_id_mod', $est_id_mod, PDO::PARAM_INT);
    $result ->execute();

    return $result;
}













?>