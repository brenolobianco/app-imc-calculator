<?php

    if(isset($_POST['cadastrar'])){
        $linkFiscallize  = $_POST["link_fiscallize"];
        $dataProva  = (isset($_POST["data_avaliacao"])) ?  $_POST["data_avaliacao"]: null;
        $nomeProva  = (isset($_POST["nome_avaliacao"])) ?  $_POST["nome_avaliacao"]: null;
        $liberado  = (isset($_POST["liberado"])) ?  $_POST["liberado"]: null;

        $insert = "INSERT INTO avaliacoes(link_fiscallize, data_avaliacao, nome_avaliacao, liberado) VALUES (:link_fiscallize, :data_avaliacao, :nome_avaliacao, :liberado)";
        try{
            $result = $conexao->prepare($insert);
            $result ->bindParam(':link_fiscallize',$linkFiscallize, PDO::PARAM_STR);
            $result ->bindParam(':data_avaliacao',$dataProva, PDO::PARAM_STR);
            $result ->bindParam(':nome_avaliacao',$nomeProva, PDO::PARAM_STR);
            $result ->bindParam(':liberado',$liberado, PDO::PARAM_STR);
            $result ->execute();
            $contar = $result->rowCount();

        if($contar>0){
            echo '<div class="alert alert-success">
                <button type="button" class="close" data-dismiss="alert">x</button>
                <strong> Inserido com Sucesso!</strong> 
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
    
?>