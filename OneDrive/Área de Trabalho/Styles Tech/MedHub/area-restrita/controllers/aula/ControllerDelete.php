<?php

if(isset($_GET['delete'])){
    
    $id_delete = $_GET['delete'];
    $seleciona= "SELECT * FROM aula LEFT JOIN aula_vid ON aula.id_aula=aula_vid.aula_id_vid WHERE id_aula=:id_delete";
    try{
        $result = $conexao->prepare($seleciona);
        $result->bindParam('id_delete',$id_delete, PDO::PARAM_INT);
        $result->execute();
        $contar = $result->rowCount();
        if($contar>0){
        $loop = $result->fetchAll();
        foreach ($loop as $exibir){
            
        }

        $temAulaVid = $exibir['aula_id_vid'];
        if($temAulaVid != null && $temAulaVid != 0 && $temAulaVid != "" && $temAulaVid != false){
            $seleciona= "DELETE FROM aula_vid WHERE aula_id_vid=:id_delete";
            try{
                $result = $conexao->prepare($seleciona);
                $result->bindParam('id_delete',$id_delete, PDO::PARAM_INT);
                $result->execute();
                $contar = $result->rowCount();
            }catch(PDOException $erro){
                echo '<div class="alert alert-info">
                <button type="button" class="close" data-dismiss="warning"></button>
                <strong> Ocorreu um erro!</strong> 
                </div>';
            }
        }

        $seleciona= "DELETE FROM aula WHERE id_aula=:id_delete";
        try{
            $result = $conexao->prepare($seleciona);
            $result->bindParam('id_delete',$id_delete, PDO::PARAM_INT);
            $result->execute();
            $contar = $result->rowCount();
            if($contar>0){
                echo '<div class="alert alert-success">
                <button type="button" class="close" data-dismiss="alert">x</button>
                <strong> Excluido com Sucesso!</strong> 
                </div>';
            }else{
                echo '<div class="alert alert-warning">
                <button type="button" class="close" data-dismiss="alert">x</button>
                <strong> Erro ao Excluir!</strong> 
                </div>';
            }
        }catch(PDOException $erro){
            echo '<div class="alert alert-info">
            <button type="button" class="close" data-dismiss="warning"></button>
            <strong> Você não pode excluir esta AULA, pois está vinculado à um PDF ou Vídeo!</strong> 
            </div>';
        }

        }else{

        }
    }catch(PDOException $erro){
        echo $erro;
    }
}

?>  