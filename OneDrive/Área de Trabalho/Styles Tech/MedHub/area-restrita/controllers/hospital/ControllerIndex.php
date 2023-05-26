<?php
    
    
    $resPermissao = permissao($idLogado);
    $temPermissaoHospital = isset($resPermissao["hospital"]) && $resPermissao["hospital"] == 1;
    if($temPermissaoHospital) {
        
        $select = "SELECT * FROM hospital
         INNER JOIN login ON login.id = hospital.usuario_id
          WHERE login.id = :idLogado 
          OR hospital.usuario_id = :idLogado";
        $result = $conexao->prepare($select);
        $result->bindParam(":idLogado", $idLogado);
        $result->execute();
        $contar = $result->rowCount();
    } else {

        $select = "SELECT * FROM hospital WHERE hospital.usuario_id = :idLogado";
        $result = $conexao->prepare($select);
        $result->bindParam(":idLogado", $idLogado);
        $result->execute();
        $contar = $result->rowCount();
    }

    $eAdmin = eAdmin($userLogado); // TODO:  verifique se o usuário é admin para mostrar todos os hospitais
    if($eAdmin) {
        $select = "SELECT * FROM hospital";
        $result = $conexao->prepare($select);
        $result->execute();
        $contar = $result->rowCount();
    }

    try{
        //$result = $conexao->prepare($select);
        //$result ->execute();
        //$contar = $result->rowCount();
 
    if($contar>0){
    while($mostra = $result->FETCH(PDO::FETCH_OBJ)){
?>
<tr>
    <td><?= $mostra->nome_hosp;?></td>
    <td><?= $mostra->resp_hosp;?></td>
    <td><?= $mostra->fone_hosp;?></td>
    <td><?= $mostra->email_hosp;?></td>
    <td>
        <a href="home.php?acao=hospital&id_hosp=<?= $mostra->id_hosp;?>" class="btn btn-icon waves-effect waves-light btn-primary"> <i class="fa fa-eye"></i> </a>
        <a href="home.php?acao=editar-hospital&id_hosp=<?= $mostra->id_hosp;?>" class="btn btn-icon waves-effect waves-light btn-warning"> &nbsp;<i class="fa fa-edit"></i> </a> 
        <a href="home.php?acao=hospitais&delete=<?= $mostra->id_hosp;?>" onClick="return confirm('Deseja realmente excluir?')" class="btn btn-icon waves-effect waves-light btn-danger"> &nbsp;<i class="fas fa-times"></i>&nbsp; </a>
    </td>   
</tr>
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