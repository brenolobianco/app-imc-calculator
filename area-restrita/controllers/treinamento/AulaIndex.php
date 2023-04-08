
<?php
    $select = "SELECT * from aula a 
    JOIN modulo m ON m.id_mod = a.mod_id_aula 
    JOIN estagio e ON e.id_est = a.est_id_aula";  
    try{
    $result = $conexao->prepare($select);
    $result ->execute();
    $contar = $result->rowCount();

    if($contar>0){
    while($mostra = $result->FETCH(PDO::FETCH_OBJ)){
?>
<tr>
    <td><?= $mostra->nome_aula;?></td>
    <td><?= $mostra->nome_mod;?></td>
    <td><?= $mostra->nome_curso;?></td>
    <td><?= $mostra->nome_est;?></td>
    <td>
        <a href="home.php?acao=aula&id_aula=<?= $mostra->id_aula;?>" class="btn btn-icon waves-effect waves-light btn-primary"> <i class="fa fa-eye"></i> </a>
        <a href="home.php?acao=editar-aula&id_aula=<?= $mostra->id_aula;?>" class="btn btn-icon waves-effect waves-light btn-warning"> &nbsp;<i class="fa fa-edit"></i> </a> 
        <a href="home.php?acao=aulas&delete=<?= $mostra->id_aula;?>" onClick="return confirm('Deseja realmente excluir?')" class="btn btn-icon waves-effect waves-light btn-danger"> &nbsp;<i class="fas fa-times"></i>&nbsp; </a>
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