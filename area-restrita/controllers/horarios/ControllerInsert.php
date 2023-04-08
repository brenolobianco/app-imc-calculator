<?php

    if(isset($_POST['cadastrar'])){
        $dia_hora  = trim(strip_tags($_POST["dia_hora"])); 
        $in_hora  = trim(strip_tags($_POST["in_hora"]));
        $out_hora = trim(strip_tags($_POST["out_hora"])); 
        $est_id_hora = trim(strip_tags($_POST["est_id_hora"])); 


            $insert = "INSERT into horarios ( dia_hora, in_hora, out_hora, est_id_hora ) 
            VALUES ( :dia_hora, :in_hora, :out_hora, :est_id_hora )";  
        try{
            $result = $conexao->prepare($insert);
            $result ->bindParam(':dia_hora',$dia_hora, PDO::PARAM_STR);
            $result ->bindParam(':in_hora',$in_hora, PDO::PARAM_STR);
            $result ->bindParam(':out_hora',$out_hora, PDO::PARAM_STR);
            $result ->bindParam(':est_id_hora',$est_id_hora, PDO::PARAM_STR);

            $result ->execute();
            $contar = $result->rowCount();

        if($contar>0){
            echo '<div class="alert alert-success">
                <button type="button" class="close" data-dismiss="alert">x</button>
                <strong> Inserido com Sucesso!</strong> 
                </div>'; 
            header("Refresh: 1, home.php?acao=horarios&id_est=$est_id_hora");
        }else{
            echo '<div class="alert alert-warning">
                <button type="button" class="close" data-dismiss="alert">x</button>
                <strong> O Conteúdo não foi inserido de forma correta!</strong> 
                </div>';
        }
        
        }catch(PDOException $e){
            echo $e;
        }                           

    }
    
?>