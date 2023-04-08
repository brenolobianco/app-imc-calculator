<<<<<<< HEAD

<?php
    $select = "SELECT * from presenca p JOIN matricula m ON m.id_mat = p.mat_id_pres 
    JOIN academico a ON a.id_acad = p.acad_id_pres
    WHERE mat_id_pres = $id_mat";  
    try{
    $result = $conexao->prepare($select);
    $result ->execute();
    $contar = $result->rowCount();

    if($contar>0){
    while($mostra = $result->FETCH(PDO::FETCH_OBJ)){
?>
<tr>
    <td><?= $mostra->nome_acad;?></td>
    <td><?= $mostra->data_pres;?></td>
    <td><?= $mostra->sit_pres;?></td>
    <td>
    <a href="home.php?acao=editar-presenca&id_pres=<?=$mostra->id_pres;?>" class="btn btn-icon waves-effect waves-light btn-warning"> &nbsp;<i class="fa fa-edit"></i> </a> 
    <a href="home.php?acao=presencas" onClick="return confirm('Deseja realmente excluir?')" class="btn btn-icon waves-effect waves-light btn-danger"> &nbsp;<i class="fas fa-times"></i>&nbsp; </a>
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
    $select = "SELECT * from presenca p JOIN matricula m ON m.id_mat = p.mat_id_pres 
    JOIN academico a ON a.id_acad = p.acad_id_pres
    WHERE mat_id_pres = $id_mat";  
    try{
    $result = $conexao->prepare($select);
    $result ->execute();
    $contar = $result->rowCount();

    if($contar>0){
    while($mostra = $result->FETCH(PDO::FETCH_OBJ)){
?>
<tr>
    <td><?= $mostra->nome_acad;?></td>
    <td><?= $mostra->data_pres;?></td>
    <td><?= $mostra->sit_pres;?></td>
    <td>
    <a href="home.php?acao=editar-presenca&id_pres=<?=$mostra->id_pres;?>" class="btn btn-icon waves-effect waves-light btn-warning"> &nbsp;<i class="fa fa-edit"></i> </a> 
    <a href="home.php?acao=presencas" onClick="return confirm('Deseja realmente excluir?')" class="btn btn-icon waves-effect waves-light btn-danger"> &nbsp;<i class="fas fa-times"></i>&nbsp; </a>
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