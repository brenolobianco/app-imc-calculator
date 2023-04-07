
<?php
    $select = "SELECT * from aula_pdf p JOIN aula a ON a.id_aula = p.aula_id_pdf";  
    try{
    $result = $conexao->prepare($select);
    $result ->execute();
    $contar = $result->rowCount();

    if($contar>0){
    while($mostra = $result->FETCH(PDO::FETCH_OBJ)){
?>
<tr>
    <td><?= $mostra->nome_pdf;?></td>
    <td><?= $mostra->nome_aula;?></td>
    <td>
        <a href="home.php?acao=aula-pdf&id_pdf=<?= $mostra->id_pdf;?>" class="btn btn-icon waves-effect waves-light btn-primary"> <i class="fa fa-eye"></i> </a>
        <a href="home.php?acao=aulas-pdf&delete=<?= $mostra->id_pdf;?>" onClick="return confirm('Deseja realmente excluir?')" class="btn btn-icon waves-effect waves-light btn-danger"> &nbsp;<i class="fas fa-times"></i>&nbsp; </a>
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