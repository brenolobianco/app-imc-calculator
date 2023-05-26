
<?php

    $resPermissao = permissao($idLogado);
    $temPermissaoAcademico = isset($resPermissao['tem_permissao']) && $resPermissao['tem_permissao'] == 1;
    if($temPermissaoAcademico){
        $select = "SELECT * FROM medico 
        WHERE login.id = :idLogado OR medico.usuario_id = :idLogado";
        $result = $conexao->prepare($select);
        $result->bindParam(":idLogado", $idLogado);
        $result->execute();
        $contar = $result->rowCount();
    } else {
        $select = "SELECT * FROM medico WHERE medico.usuario_id = :idLogado";
        $result = $conexao->prepare($select);
        $result->bindParam(":idLogado", $idLogado);
        $result->execute();
        $contar = $result->rowCount();
    }

    $eAdmin = eAdmin();//TODO : verifique se o usuário é admin para mostrar todos os hospitais
    if($eAdmin){
        $select = "SELECT * FROM medico";
    }
    
    $select = "SELECT * from medico";  
    try{
        

    if($contar>0){
    while($mostra = $result->FETCH(PDO::FETCH_OBJ)){
?>

 "<tr>
                        <td>$mostra->nome_med</td>
                        <td>$mostra->cpf_med</td>
                        <td>$mostra->numero_crm_med</td>
                        <td>
                            <a href='home.php?acao=medico&id_med=$mostra->id_med' class='btn btn-icon waves-effect waves-light btn-primary'> <i class='fa fa-eye'></i> </a>
                            <a href='home.php?acao=medicos&delete=$mostra->id_med' class='btn btn-icon waves-effect waves-light btn-danger'> &nbsp;<i class='fas fa-times'></i>&nbsp; </a>
                        </td>
                    </tr>";
<?php
}
}else{
    echo '<div class="alert alert-info">
        <button type="button" class="close" data-dismiss="warning"></button>
        <strong> Nada Cadastrado!!!</strong> 
        </div>';
}
}catch(PDOException $e){
    echo $e;
}
?> 