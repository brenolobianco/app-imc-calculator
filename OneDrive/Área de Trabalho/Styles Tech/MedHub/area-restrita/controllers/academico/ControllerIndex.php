
<?php
    $resPermissao = permissao($idLogado);
    $temPermissaoAcademico = isset($resPermissao['tem_permissao']) && $resPermissao['tem_permissao'] == 1;
    $email = $emailLogado;
    if($temPermissaoAcademico){
        $select = "SELECT * FROM academico INNER JOIN login ON login.id = academico.usuario_id 
        WHERE login.id = :idLogado OR academico.usuario_id = :idLogado";
        $result = $conexao->prepare($select);
        $result->bindParam(":idLogado", $idLogado);
        $result->execute();
        $contar = $result->rowCount();
    } else {
        $select = "SELECT * FROM academico WHERE academico.usuario_id = :idLogado";
        $result = $conexao->prepare($select);
        $result->bindParam(":idLogado", $idLogado);
        $result->execute();
        $contar = $result->rowCount();
    }


    #$eAdmin = eAdmin();//TODO : verifique se o usuário é admin para mostrar todos os hospitais
    #if($eAdmin){
    #    $select = "SELECT * FROM academico";
    #}
    
    $select = "SELECT * from academico";  
    try{
    //$result = $conexao->prepare($select);
    //$result ->execute();
    //$contar = $result->rowCount();
        

    if($contar>0){
    while($mostra = $result->FETCH(PDO::FETCH_OBJ)){
?>
<tr>
    <td><?= $mostra->nome_acad;?></td>
    <td><a href="home.php?acao=matricular-academico-nome&id_acad=<?= $mostra->id_acad;?>" class="btn btn-icon waves-effect waves-light btn-warning"> ADD </a> 
       </td>
    <td><?= $mostra->email_acad;?></td>
    <td><?= $mostra->whats_acad;?></td>
    <td>
        <a href="home.php?acao=academico&id_acad=<?= $mostra->id_acad;?>" class="btn btn-icon waves-effect waves-light btn-primary"> <i class="fa fa-eye"></i> </a>
        <a href="home.php?acao=editar-indicacao&id_acad=<?= $mostra->id_acad;?>" class="btn btn-icon waves-effect waves-light btn-warning"> &nbsp;<i class="fa fa-edit"></i> </a> 
         <a href="home.php?acao=academicos&delete=<?= $mostra->id_acad; ?>" onClick="return confirm('Deseja realmente excluir?')" class="btn btn-icon waves-effect waves-light btn-danger"> &nbsp;<i class="fas fa-times"></i>&nbsp; </a>
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