<?php

if(isset($_GET['delete'])){
    $id_delete = $_GET['delete'];
    $seleciona= "SELECT * FROM permissao_setor as p INNER JOIN login as l ON p.id_login = l.id WHERE p.id_login = :id";
    try{
        $result = $conexao->prepare($seleciona);
        $result->bindParam('id_delete',$id_delete, PDO::PARAM_INT);
        $result->execute();
        $contar = $result->rowCount();
        if($contar>0){
        $loop = $result->fetchAll();
        foreach ($loop as $exibir){
            
        }

        $seleciona= "DELETE permissao_setor FROM permissao_setor  WHERE permissao_setor id_permissao_setor=:id_delete";
        try{
            $result = $conexao->prepare($seleciona);
            $result->bindParam('id_delete',$id_delete, PDO::PARAM_INT);
            $result->execute();
            $contar = $result->rowCount();
            if($contar>0){

                $fotoDeleta = $exibir['img_hosp'];
                $arquivo = "../upload/".$fotoDeleta;
                unlink($arquivo);

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
            <strong> Você não pode excluir este HOSPITAL, pois está vinculado à um estágio!</strong> 
            </div>';
        }

        }else{

        }
    }catch(PDOException $erro){
        echo $erro;
    }
}
?>  