<?php
    $select = "SELECT * from estagio e LEFT JOIN hospital h ON h.id_hosp = e.hosp_id_est";  
    try{
    $result = $conexao->prepare($select);
    $result ->execute();
    $contar = $result->rowCount();

    if($contar>0){
    while($mostra = $result->FETCH(PDO::FETCH_OBJ)){
?>
<tr>
    <td><?= $mostra->nome_est;?></td>
    <td><a href="home.php?acao=horarios&id_est=<?= $mostra->id_est;?>" class="btn btn-primary waves-effect waves-light"> <span>Horários</span> </a></td>
    <td><a href="home.php?acao=ranking&id_est=<?= $mostra->id_est;?>" class="btn btn-warning waves-effect waves-light"> <i class="fa fa-rocket mr-1"></i> <span>Rank</span> </a></td>
    <td>
        <a href="home.php?acao=estagio&id_est=<?= $mostra->id_est;?>" class="btn btn-icon waves-effect waves-light btn-primary"> <i class="fa fa-eye"></i> </a>
        <a href="home.php?acao=editar-estagio&id_est=<?= $mostra->id_est;?>" class="btn btn-icon waves-effect waves-light btn-warning"> &nbsp;<i class="fa fa-edit"></i> </a> 
        <a href="home.php?acao=estagios&delete=<?= $mostra->id_est;?>" onClick="return confirm('Deseja realmente excluir?')" class="btn btn-icon waves-effect waves-light btn-danger"> &nbsp;
        <i class="fas fa-times"></i>&nbsp; 
        </a>
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