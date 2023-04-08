<<<<<<< HEAD
<?php
    $select = "SELECT * from estagio WHERE ativo_est='Ativado'";  
    try{
    $result = $conexao->prepare($select);
    $result ->execute();
    $contar = $result->rowCount();

    if($contar>0){
    while($mostra = $result->FETCH(PDO::FETCH_OBJ)){
?>
<tr>
    <td><?= $mostra->nome_est;?></td>
    <td><a href="home.php?acao=ranking&id_est=<?= $mostra->id_est;?>" class="btn btn-warning waves-effect waves-light"> <i class="fa fa-rocket mr-1"></i> <span>Rank</span> </a></td>
 
</tr>
<?php
}
}else{
    echo '<li>Nada Cadastrado</li>';
}
}catch(PDOException $e){
    echo $e;
}
=======
<?php
    $select = "SELECT * from estagio WHERE ativo_est='Ativado'";  
    try{
    $result = $conexao->prepare($select);
    $result ->execute();
    $contar = $result->rowCount();

    if($contar>0){
    while($mostra = $result->FETCH(PDO::FETCH_OBJ)){
?>
<tr>
    <td><?= $mostra->nome_est;?></td>
    <td><a href="home.php?acao=ranking&id_est=<?= $mostra->id_est;?>" class="btn btn-warning waves-effect waves-light"> <i class="fa fa-rocket mr-1"></i> <span>Rank</span> </a></td>
 
</tr>
<?php
}
}else{
    echo '<li>Nada Cadastrado</li>';
}
}catch(PDOException $e){
    echo $e;
}
>>>>>>> dbb2c73f370ca8a6d55f2c45adc576d179ae3650
?> 