<?php



function bloquearAula($conexao, $id_aula) {
    $select = "UPDATE aula SET status = 'bloqueado' WHERE id_aula = :id_aula AND treinamento = 'sim' AND status = 'liberado' ";
    try{
        $result = $conexao->prepare($select);
        $result ->bindParam(':id_aula', $id_aula, PDO::PARAM_INT);
        $result ->execute();
        $contar = $result->rowCount();
        if($contar>0){
            echo '<div class="alert alert-success">
                <button type="button" class="close" data-dismiss="warning"></button>
                <strong> Aula bloqueada com sucesso!!!</strong> 
                </div>';
        }else{
            echo '<div class="alert alert-danger">
                <button type="button" class="close" data-dismiss="warning"></button>
                <strong> Aula não bloqueada!!!</strong> 
                </div>';
        }
    }catch(PDOException $e){
        echo $e;
    }
}

function liberarAula($conexao, $id_aula) {
    $select = "UPDATE aula SET status = 'liberado' WHERE id_aula = :id_aula AND treinamento = 'sim' AND status = 'bloqueado' ";
    try{
        $result = $conexao->prepare($select);
        $result ->bindParam(':id_aula', $id_aula, PDO::PARAM_INT);
        $result ->execute();
        $contar = $result->rowCount();
        if($contar>0){
            echo '<div class="alert alert-success">
                <button type="button" class="close" data-dismiss="warning"></button>
                <strong> Aula liberada com sucesso!!!</strong> 
                </div>';
        }
    }catch(PDOException $e){
        echo $e;
    }
}


if(isset($_GET['block'])) {
    $id_aula = $_GET['block'];
    $select = "SELECT * FROM aula WHERE id_aula = :id_aula AND treinamento = 'sim'";
    try{
        $result = $conexao->prepare($select);
        $result ->bindParam(':id_aula', $id_aula, PDO::PARAM_INT);
        $result ->execute();
        $contar = $result->rowCount();
        if($contar>0){
            $fetch = $result->fetch(PDO::FETCH_ASSOC);
            $status = $fetch['status'];
            if($status == 'liberado'){
                bloquearAula($conexao, $id_aula);
            }else{
                liberarAula($conexao, $id_aula);
            }
            echo '<div class="alert alert-success">
                <button type="button" class="close" data-dismiss="warning"></button>
                <strong> Aula bloqueada com sucesso!!!</strong> 
                </div>';
        }else{
            echo '<div class="alert alert-danger">
                <button type="button" class="close" data-dismiss="warning"></button>
                <strong> Aula não bloqueada!!!</strong> 
                </div>';
        }
    }catch(PDOException $e){
        echo $e;
    }
}

?>