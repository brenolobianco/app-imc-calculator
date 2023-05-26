<?php
$resPermissao = permissao($idLogado);
$temPermissaoListaCadastrado = isset($resPermissao["acad_pa"]) && $resPermissao["acad_pa"] == 1;

if ($temPermissaoListaCadastrado) {
    $select = "SELECT * FROM acad_pa INNER JOIN login ON login.id= acad_pa.usuario_id WHERE login.id = :idLogado OR acad_pa.usuario_id = :idLogado";
    $result = $conexao->prepare($select);
    $result->bindParam(":idLogado", $idLogado);
    $result->execute();
    $contar = $result->rowCount();
} else {
    $select = "SELECT * from acad_pa p JOIN estagio e ON e.id_est = p.est_id_pa";

    $result = $conexao->prepare($select);
    $result->execute();
    $contar = $result->rowCount();
}

$eAdmin = eAdmin(); //TODO : verifique se o usuário é admin para mostrar todos os hospitais 

if ($eAdmin) {
    $select = "SELECT * FROM acad_pa";
}
try {
    if ($contar > 0) {
        while ($mostra = $result->FETCH(PDO::FETCH_OBJ)) {
?>
            <tr>
                <td><?= $mostra->nome_pa; ?></td>
                <td><?= $mostra->nome_est; ?></td>
                <td>

                    <a href="home.php?acao=lista-de-aprovados&delete=<?= $mostra->id_pa; ?>" onClick="return confirm('Deseja realmente excluir?')" class="btn btn-icon waves-effect waves-light btn-danger"> &nbsp;<i class="fas fa-times"></i>&nbsp; </a>
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