<?php
    
    
    $resPermissao = permissao($idLogado);
    $temPermissaoCurso = isset($resPermissao["curso"]) && $resPermissao["curso"] == 1;
    if($temPermissaoCurso) {
        $select = "SELECT * FROM curso INNER JOIN login ON login.id = curso.usuario_id WHERE login.id = :idLogado OR curso.usuario_id = :idLogado";
        $result = $conexao->prepare($select);
        $result->bindParam(":idLogado", $idLogado);
        $result->execute();
        $contar = $result->rowCount();
    } else {
        $select = "SELECT * FROM curso WHERE curso.usuario_id = :idLogado";
        $result = $conexao->prepare($select);
        $result->bindParam(":idLogado", $idLogado);
        $result->execute();
        $contar = $result->rowCount();
    }

    $eAdmin = eAdmin(); // TODO:  verifique se o usuário é admin para mostrar todos os hospitais
    if($eAdmin) {
        $select = "SELECT * FROM curso";
    }

    try{
        //$result = $conexao->prepare($select);
        //$result ->execute();
        //$contar = $result->rowCount();
 
    if($contar>0){
    while($mostra = $result->FETCH(PDO::FETCH_OBJ)){
?>
<tr>
    <td><?= $mostra->nome_curso;?></td>
    <td><?= $mostra->desc_curso;?></td>
    <td>
        <a href="home.php?acao=curso&id_curso=<?= $mostra->id_curso;?>" class="btn btn-icon waves-effect waves-light btn-primary"> <i class="fa fa-eye"></i> </a>
        <a href="home.php?acao=editar-curso&id_curso=<?= $mostra->id_curso;?>" class="btn btn-icon waves-effect waves-light btn-warning"> &nbsp;<i class="fa fa-edit"></i> </a> 
        <a href="home.php?acao=cursos&delete=<?= $mostra->id_curso;?>" onClick="return confirm('Deseja realmente excluir?')" class="btn btn-icon waves-effect waves-light btn-danger"> &nbsp;<i class="fas fa-times"></i>&nbsp; </a>
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