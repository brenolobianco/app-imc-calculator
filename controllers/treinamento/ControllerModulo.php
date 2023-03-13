<?php


function getAulasModulos($conexao, $id_mod){
    $select = "SELECT * FROM aula INNER JOIN aula_vid ON aula_vid.aula_id_vid = aula.id_aula WHERE mod_id_aula=:mod_id_aula AND treinamento = 'sim' ORDER BY `aula`.`cronograma_semanas` ASC";

    $result = $conexao->prepare($select);
    $result ->bindParam(':mod_id_aula', $id_mod, PDO::PARAM_INT);
    $result ->execute();
    return $result;
}



function getModulos($conexao, $id_est) {

    $select = "SELECT * FROM modulo WHERE est_id_mod=:est_id_mod AND treinamento = 'sim'";

    $result = $conexao->prepare($select);
    $result ->bindParam(':est_id_mod', $id_est, PDO::PARAM_INT);
    $result ->execute();
    return $result;
}

if(!isset($_GET['id_est'])){ header("Location: home.php?acao=pagina-nao-existe"); exit;}
   

    $id_est = $_GET['id_est'];
    $select = "SELECT * from modulo WHERE est_id_mod=:est_id_mod AND treinamento = 'sim' ";

    try{
        $result = $conexao->prepare($select);
        $result ->bindParam(':est_id_mod', $id_est, PDO::PARAM_INT);
        $result ->execute();
        $contar = $result->rowCount();
        
    
    }catch(PDOException $e){
        echo $e;
    }



    function getQuizes($conexao, $id_est) {
        $select = "SELECT * FROM quiz_treinamento INNER JOIN aula ON aula.id_aula = quiz_treinamento.id_vid_aula WHERE aula.treinamento = 'sim' AND aula.est_id_aula = :id_est";
        try{
            $result = $conexao->prepare($select);
            $result ->bindParam(':id_est', $id_est, PDO::PARAM_INT);
            $result ->execute();
            return $result;
        }catch(PDOException $e){
        }   
    }


    function getAulas($conexao, $id_est) {
        $select = "SELECT * FROM aula INNER JOIN quiz_treinamento ON quiz_treinamento.id_vid_aula = aula.id_aula WHERE aula.treinamento = 'sim' AND aula.est_id_aula = :est_id";
        try{
            $result = $conexao->prepare($select);
            $result ->bindParam(':est_id', $id_est, PDO::PARAM_INT);
            $result ->execute();
            return $result;
        }catch(PDOException $e){
            echo $e;
        }
    }


?>