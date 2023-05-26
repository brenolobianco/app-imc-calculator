
<?php
    $resPermissao = permissao($idLogado);
    $temPermissaoAcademico = isset($resPermissao['tempermissao']) && $resPermissao['tem_permissao'] == 1;
    if($temPermissaoAcademico){
        $select = "SELECT * FROM hospital
        INNER JOIN curso ON  curso.acad_id_mat =  matricula.curso_id_ma
         INNER JOIN academico ON  matricula.acad_id_mat =  curso.id_curso
        JOIN login ON login.id = matricula.usuario_id 
        WHERE login.id = :idLogado OR matricula.usuario_id = :idLogado"; 
        $result = $conexao->prepare($select);
        $result->bindParam(":idLogado", $idLogado);
        $result->execute();
        $contar = $result->rowCount();
    } else{
        $select = "SELECT * FROM matricula INNER JOIN academico ON academico.id_acad = matricula.acad_id_mat
		JOIN login ON matricula.usuario_id = login.id
        WHERE login.id = :idLogado OR academico.usuario_id = :idLogado";
        $result = $conexao->prepare($select);
        $result->bindParam(":idLogado",$idLogado);
        $result->execute();
        $contar = $result->rowCount();
    }


    $eAdmin = eAdmin(); 
    if($eAdmin){
        $select = "SELECT * FROM matricula ";
    }
    
    $select = "SELECT * FROM matricula";
    try{
    

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
?> 