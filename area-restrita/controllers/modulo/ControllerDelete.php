<?php

if(isset($_GET['delete'])){
    $id_delete = $_GET['delete'];
    $seleciona= "SELECT * FROM modulo WHERE id_mod=:id_delete";
    try{
        $result = $conexao->prepare($seleciona);
        $result->bindParam('id_delete',$id_delete, PDO::PARAM_INT);
        $result->execute();
        $contar = $result->rowCount();
        if($contar>0){
        $loop = $result->fetchAll();
        foreach ($loop as $exibir){
            
        }

        $seleciona= "DELETE FROM modulo WHERE id_mod=:id_delete";
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
            <strong> Você não pode excluir este MÓDULO, pois está vinculado à uma ou mais Aulas!</strong> 
            </div>';
        }

        }else{

        }
    }catch(PDOException $erro){
        echo $erro;
    }
}
?>  