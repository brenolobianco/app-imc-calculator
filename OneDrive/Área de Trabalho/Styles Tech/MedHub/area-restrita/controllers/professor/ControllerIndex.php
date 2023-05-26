<?php
    
    
    $resPermissao = permissao($idLogado);
    $temPermissaoProfessor = isset($resPermissao["professor"]) && $resPermissao["professor"] == 1;
    if($temPermissaoProfessor) {
        $select = "SELECT * FROM professor INNER JOIN login ON login.id = professor.usuario_id WHERE login.id = :idLogado OR professor.usuario_id = :idLogado";
        $result = $conexao->prepare($select);
        $result->bindParam(":idLogado", $idLogado);
        $result->execute();
        $contar = $result->rowCount();
    } else {
        $select = "SELECT * FROM professor WHERE professor.usuario_id = :idLogado";
        $result = $conexao->prepare($select);
        $result->bindParam(":idLogado", $idLogado);
        $result->execute();
        $contar = $result->rowCount();
    }

    $eAdmin = eAdmin(); // TODO:  verifique se o usuário é admin para mostrar todos os hospitais
    if($eAdmin) {
        $select = "SELECT * FROM professor";
    }

    try{
        //$result = $conexao->prepare($select);
        //$result ->execute();
        //$contar = $result->rowCount();
 
    if($contar>0){
    while($mostra = $result->FETCH(PDO::FETCH_OBJ)){
?>
<tr>
    <td><?= $mostra->nome_prof;?></td>
    <td><?= $mostra->whats_prof;?></td>
    <td><?= $mostra->email_prof;?></td>
    <td>
        <a href="home.php?acao=professor&id_prof=<?= $mostra->id_prof;?>" class="btn btn-icon waves-effect waves-light btn-primary"> <i class="fa fa-eye"></i> </a>
        <a href="home.php?acao=editar-professor&id_prof=<?= $mostra->id_prof;?>" class="btn btn-icon waves-effect waves-light btn-warning"> &nbsp;<i class="fa fa-edit"></i> </a> 
        <a href="home.php?acao=professores&delete=<?= $mostra->id_prof;?>" onClick="return confirm('Deseja realmente excluir?')" class="btn btn-icon waves-effect waves-light btn-danger"> &nbsp;<i class="fas fa-times"></i>&nbsp; </a>
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