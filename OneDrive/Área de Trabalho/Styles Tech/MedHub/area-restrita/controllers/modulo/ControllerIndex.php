<?php
    
    
    $resPermissao = permissao($idLogado);
    $temPermissaoModulo = isset($resPermissao["modulo"]) && $resPermissao["modulo"] == 1;
    if($temPermissaoModulo) {
        $select = "SELECT * FROM modulo INNER JOIN login ON login.id = modulo.usuario_id WHERE login.id = :idLogado OR modulo.usuario_id = :idLogado";
        $result = $conexao->prepare($select);
        $result->bindParam(":idLogado", $idLogado);
        $result->execute();
        $contar = $result->rowCount();
    } else {
        $select = "SELECT * FROM modulo WHERE modulo.usuario_id = :idLogado";
        $result = $conexao->prepare($select);
        $result->bindParam(":idLogado", $idLogado);
        $result->execute();
        $contar = $result->rowCount();
    }

    $eAdmin = eAdmin(); // TODO:  verifique se o usuário é admin para mostrar todos os hospitais
    if($eAdmin) {
        $select = "SELECT * FROM modulo";
    }

    try{
        //$result = $conexao->prepare($select);
        //$result ->execute();
        //$contar = $result->rowCount();
 
    if($contar>0){
    while($mostra = $result->FETCH(PDO::FETCH_OBJ)){
?>
<tr>
    <td><?= $mostra->nome_mod;?></td>
    <td><?= $mostra->desc_mod;?></td>
    <td>
        <a href="home.php?acao=editar-modulo&id_mod=<?= $mostra->id_mod;?>" class="btn btn-icon waves-effect waves-light btn-warning"> &nbsp;<i class="fa fa-edit"></i> </a> 
        <a href="home.php?acao=modulos&delete=<?= $mostra->id_mod;?>" onClick="return confirm('Deseja realmente excluir?')" class="btn btn-icon waves-effect waves-light btn-danger"> &nbsp;<i class="fas fa-times"></i>&nbsp; </a>
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