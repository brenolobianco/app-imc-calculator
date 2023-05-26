<?php
    $select = "SELECT * from modulo";  
    try{
    $result = $conexao->prepare($select);
    $result ->execute();
    $contar = $result->rowCount();

    if($contar>0){
    while($mostra = $result->FETCH(PDO::FETCH_OBJ)){
?>
<div class="container">
        <h5><?= $mostra->nome_mod;?></h5>
        <div class="row">
            <?php include_once 'controllers/aula/ControllerIndex.php';?>
        </div>
    </div>
    <br><br><br><br><br>
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