<?php

if(isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $sql = "DELETE FROM avaliacoes WHERE id_avaliacao = :id";
    $result = $conexao->prepare($sql);
    $result->bindParam(':id', $id, PDO::PARAM_INT);
    $result->execute();
    $contar = $result->rowCount();
    if($contar>0){
        echo '<div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert">x</button>
            <strong> Deletado com Sucesso!</strong> 
            </div>'; 

    } else{
        echo '<div class="alert alert-warning">
            <button type="button" class="close" data-dismiss="alert">x</button>
            <strong> O Conteúdo não foi deletado de forma correta!</strong> 
            </div>';
    }
}