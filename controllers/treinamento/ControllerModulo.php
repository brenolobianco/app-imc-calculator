<?php

if(!isset($_GET['id_est'])){ header("Location: home.php?acao=pagina-nao-existe"); exit;}
   $id_est = $_GET['id_est'];
    $select = "SELECT * from modulo WHERE est_id_mod=:est_id_mod AND treinamento = 'sim'";

    try{
        $result = $conexao->prepare($select);
        $result ->bindParam(':est_id_mod', $id_est, PDO::PARAM_INT);
        $result ->execute();
        $contar = $result->rowCount();
        
    
    }catch(PDOException $e){
        echo $e;
    }

?>