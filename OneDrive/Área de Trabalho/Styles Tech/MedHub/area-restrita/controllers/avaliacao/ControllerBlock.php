<?php


function status($conexao, $id){
    $sql = "SELECT liberado FROM avaliacoes WHERE id_avaliacao = :id";
    $result = $conexao->prepare($sql);
    $result->bindParam(':id', $id, PDO::PARAM_INT);
    $result->execute();
    $contar = $result->rowCount();
    if($contar>0){
        $liberado = $result->fetch(PDO::FETCH_ASSOC);
        return $liberado['liberado'];
    } else{
        return false;
    }
}

if(isset($_GET['block'])) {
    $id = $_GET['block'];
    $status = status($conexao, $id);
    if($status == 'liberado') {
        $sql = "UPDATE avaliacoes SET liberado = 'bloqueado' WHERE id_avaliacao = :id";
    } else {
        $sql = "UPDATE avaliacoes SET liberado = 'liberado' WHERE id_avaliacao = :id";
    }

    $result = $conexao->prepare($sql);
    $result->bindParam(':id', $id, PDO::PARAM_INT);
    $result->execute();
    $contar = $result->rowCount();
    if($contar>0){
        $status = status($conexao, $id);
        echo '<div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert">x</button>
            <strong> '.$status.' com Sucesso!</strong> 
            </div>'; 

    } else{
        echo '<div class="alert alert-warning">
            <button type="button" class="close" data-dismiss="alert">x</button>
            <strong> O Conteúdo não foi deletado de forma correta!</strong> 
            </div>';
    }
}