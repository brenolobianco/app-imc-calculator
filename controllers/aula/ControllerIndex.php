
<?php

    $select = "SELECT * from aula a 
    JOIN professor p ON p.id_prof = a.prof_id_aula
    JOIN curso c ON c.id_curso = a.curso_id_aula
    JOIN modulo m ON m.id_mod = a.mod_id_aula
    JOIN estagio e ON e.id_est = a.est_id_aula";  
    try{
    $result = $conexao->prepare($select);
    $result ->execute();
    $contar = $result->rowCount();

    if($contar>0){
    while($mostra = $result->FETCH(PDO::FETCH_OBJ)){
?>
<br><br><br><br>
<div class="col-sm-3">
<p style="color: #fff;">
<?= $mostra->nome_aula;?><br><br>

</p>
</div>
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