<?php

if (isset($_GET['delete'])) {
    $id_delete = $_GET['delete'];
    $seleciona = "SELECT * FROM medico WHERE id_med=:id_delete";
    try {
        $result = $conexao->prepare($seleciona);
        $result->bindParam('id_delete', $id_delete, PDO::PARAM_INT);
        $result->execute();
        $contar = $result->rowCount();
        if ($contar > 0) {
            $seleciona = "DELETE FROM medico WHERE id_med=:id_delete";
            try {
                $result = $conexao->prepare($seleciona);
                $result->bindParam('id_delete', $id_delete, PDO::PARAM_INT);
                $result->execute();
                $contar = $result->rowCount();
                if ($contar > 0) {

                    echo '<div class="alert alert-success">
                <button type="button" class="close" data-dismiss="alert">x</button>
                <strong> Excluido com Sucesso!</strong> 
                </div>';
                } else {
                    echo '<div class="alert alert-warning">
                <button type="button" class="close" data-dismiss="alert">x</button>
                <strong> Erro ao Excluir!</strong> 
                </div>';
                }
            } catch (PDOException $erro) {
                echo '<div class="alert alert-info">
            <button type="button" class="close" data-dismiss="warning"></button>
            <strong> Você não pode excluir este MÉDICO, pois está vinculado à uma pesquisa!</strong> 
            </div>';
            }
        } else {
        }
    } catch (PDOException $erro) {
        echo $erro;
    }
}
