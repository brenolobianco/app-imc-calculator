<?php

    if(isset($_POST['atualizar'])){

        $avaliacaoId  = $_POST["avaliacao_id_fiscallize"];
        $dataProva  = $_POST["data_avaliacao"];
        $nomeProva  = (isset($_POST["nome_avaliacao"])) ?  $_POST["nome_avaliacao"]: null;
        $idEst = (isset($_POST["id_est"])) ?  $_POST["id_est"]: null;
        $liberado  = (isset($_POST["liberado"])) ?  $_POST["liberado"]: null;

        $sqlUpdate = "UPDATE avaliacoes SET avaliacao_id_fiscallize = :avaliacao_id_fiscallize, data_avaliacao = :data_avaliacao, nome_avaliacao = :nome_avaliacao, id_est = :id_est, liberado = :liberado WHERE id_avaliacao = :id";
        try{
            $update = $conexao->prepare($sqlUpdate);
            $update ->bindParam(':id',$id, PDO::PARAM_INT);
            $update ->bindParam(':avaliacao_id_fiscallize', $avaliacaoId, PDO::PARAM_STR);
            $update->bindParam(':id_est',$idEst, PDO::PARAM_INT);
            $update ->bindParam(':data_avaliacao',$dataProva, PDO::PARAM_STR);
            $update ->bindParam(':nome_avaliacao',$nomeProva, PDO::PARAM_STR);
            $update ->bindParam(':liberado',$liberado, PDO::PARAM_STR);
            $update ->execute();
            $contar = $update->rowCount();

        if($contar>0){
            echo '<div class="alert alert-success">
                <button type="button" class="close" data-dismiss="alert">x</button>
                <strong> Atualizado com Sucesso!</strong> 
                </div>'; 
            // header("Refresh: 1, home.php?acao=novo-quiz");
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

    $select = "SELECT * FROM avaliacoes WHERE id_avaliacao = :id_avaliacao";
    $result = $conexao->prepare($select);
    $result->bindParam(':id_avaliacao', $id, PDO::PARAM_INT);
    $result->execute();
    $mostra = $result->fetch(PDO::FETCH_ASSOC);
    $atual = $mostra['data_avaliacao'];
    $liberado = $mostra['liberado'];
    $atual = date('Y-m-d\TH:i', strtotime($atual)); 
    
?>