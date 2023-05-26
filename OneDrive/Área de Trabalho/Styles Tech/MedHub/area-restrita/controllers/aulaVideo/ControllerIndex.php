<?php
$resPermissao = permissao($idLogado);
$temPermissaoAulaVideo = isset($resPermissao["aula"]) && $resPermissao["aula"] == 1;
if ($temPermissaoAulaVideo) {
    $select = "SELECT * from aula_vid  
    JOIN aula  ON aula.id_aula = aula_vid.aula_id_vid 
    JOIN login ON login.id = aula_vid.usuario_id
    WHERE login.id= :idLogado OR aula_vid.usuario_id = :idLogado";
    $result = $conexao->prepare($select);
    $result->bindParam(":idLogado", $idLogado);
    $result->execute();
    $contar = $result->rowCount();
} else {
    $select = "SELECT * from aula_vid  WHERE aula_vid.usuario_id= :idLogado";
    $result = $conexao->prepare($select);
    $result->bindParam(":idLogado", $idLogado);
    $result->execute();
    $contar = $result->rowCount();
}

$eAdmin = eAdmin(); // TODO:  verifique se o usuário é admin para mostrar todos os hospitais
if($eAdmin) {
    $select = "SELECT * FROM aula_vid";
}
try {
    //$result = $conexao->prepare($select);
    //$result->execute();
    //$contar = $result->rowCount();

    if ($contar > 0) {
        while ($mostra = $result->FETCH(PDO::FETCH_OBJ)) {
?>
            <tr>
                <td><?= $mostra->nome_aula; ?></td>
                <td><?= $mostra->nome_vid; ?></td>
                <td><?= $mostra->nome_curso; ?></td>
                <td><?= $mostra->nome_est; ?></td>
                <td>
                    <a href="home.php?acao=aula&id_aula=<?= $mostra->id_aula; ?>" class="btn btn-icon waves-effect waves-light btn-primary"> <i class="fa fa-eye"></i> </a>
                    <a href="home.php?acao=editar-aula&id_aula=<?= $mostra->id_aula; ?>" class="btn btn-icon waves-effect waves-light btn-warning"> &nbsp;<i class="fa fa-edit"></i> </a>
                    <a href="home.php?acao=aulas&delete=<?= $mostra->id_aula; ?>" onClick="return confirm('Deseja realmente excluir?')" class="btn btn-icon waves-effect waves-light btn-danger"> &nbsp;<i class="fas fa-times"></i>&nbsp; </a>
                </td>
            </tr>
<?php
        }
    } else {
        echo '<div class="alert alert-info">
        <button type="button" class="close" data-dismiss="warning"></button>
        <strong> Nada Cadastrado!!!</strong> 
        </div>';
    }
} catch (PDOException $e) {
    echo $e;
}
?>