<<<<<<< HEAD

<?php
    $select = "SELECT * from matricula m 
    JOIN estagio e ON e.id_est = m.est_id_mat
    JOIN academico a ON a.id_acad = m.acad_id_mat";  
    try{
    $result = $conexao->prepare($select);
    $result ->execute();
    $contar = $result->rowCount();

    if($contar>0){
    while($mostra = $result->FETCH(PDO::FETCH_OBJ)){
?>
<tr>
    <td><?= $mostra->nome_acad;?></td>
    <td><?= $mostra->whats_mat;?></td>
    <td><?= $mostra->data_cad_mat;?></td>
    <td><?= $mostra->pag_mat;?></td>
    <!--<td><?php 
    if($mostra->nota_mat == 999){
    echo 'Indicação';
    }else{
     echo $mostra->nota_mat;   
    }?></td>-->
    <td>
        <a href="home.php?acao=academico&id_acad=<?= $mostra->id_acad;?>" class="btn btn-icon waves-effect waves-light btn-primary"> <i class="fa fa-eye"></i> </a>
        <a href="home.php?acao=matricula&id_mat=<?= $mostra->id_mat;?>" class="btn btn-icon waves-effect waves-light btn-warning"> &nbsp;<i class="fa fa-edit"></i> </a>
        <a href="home.php?acao=matriculas&delete=<?= $mostra->id_mat;?>" onClick="return confirm('Deseja realmente excluir?')" class="btn btn-icon waves-effect waves-light btn-danger"> <i class="fa fa-times"></i> </a> 
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
=======

<?php
    $select = "SELECT * from matricula m 
    JOIN estagio e ON e.id_est = m.est_id_mat
    JOIN academico a ON a.id_acad = m.acad_id_mat";  
    try{
    $result = $conexao->prepare($select);
    $result ->execute();
    $contar = $result->rowCount();

    if($contar>0){
    while($mostra = $result->FETCH(PDO::FETCH_OBJ)){
?>
<tr>
    <td><?= $mostra->nome_acad;?></td>
    <td><?= $mostra->whats_mat;?></td>
    <td><?= $mostra->data_cad_mat;?></td>
    <td><?= $mostra->pag_mat;?></td>
    <!--<td><?php 
    if($mostra->nota_mat == 999){
    echo 'Indicação';
    }else{
     echo $mostra->nota_mat;   
    }?></td>-->
    <td>
        <a href="home.php?acao=academico&id_acad=<?= $mostra->id_acad;?>" class="btn btn-icon waves-effect waves-light btn-primary"> <i class="fa fa-eye"></i> </a>
        <a href="home.php?acao=matricula&id_mat=<?= $mostra->id_mat;?>" class="btn btn-icon waves-effect waves-light btn-warning"> &nbsp;<i class="fa fa-edit"></i> </a>
        <a href="home.php?acao=matriculas&delete=<?= $mostra->id_mat;?>" onClick="return confirm('Deseja realmente excluir?')" class="btn btn-icon waves-effect waves-light btn-danger"> <i class="fa fa-times"></i> </a> 
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
>>>>>>> dbb2c73f370ca8a6d55f2c45adc576d179ae3650
?> 