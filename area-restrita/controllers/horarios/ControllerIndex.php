<?php
   
    $select = "SELECT * from horarios h LEFT JOIN academico a ON a.id_acad = acad_id_hora";  
    try{
    $result = $conexao->prepare($select);
    $result ->execute();
    $contar = $result->rowCount();

    if($contar>0){
    while($mostra = $result->FETCH(PDO::FETCH_OBJ)){
        
        if($mostra->acad_id_hora == null){
            $academico = 'Horário livre';
        }else{
            $academico = $mostra->nome_acad;
        }
  
?>
<tr>
    <td><?= $mostra->dia_hora;?> </td>
    <td><?= $academico;?></td>
    <td><?= $mostra->in_hora;?></td>
    <td><?= $mostra->out_hora;?></td>

    <td>
        <a href="home.php?acao=editar-horario&id_hora=<?=$mostra->id_hora;?>" class="btn btn-icon waves-effect waves-light btn-warning"> &nbsp;<i class="fa fa-edit"></i> </a> 
        <a href="home.php?acao=horarios&id_est=<?= $mostra->est_id_hora;?>&delete=<?= $mostra->id_hora;?>" onClick="return confirm('Deseja realmente excluir?')" class="btn btn-icon waves-effect waves-light btn-danger"> &nbsp;<i class="fas fa-times"></i>&nbsp; </a>
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