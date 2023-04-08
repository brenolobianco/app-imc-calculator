<?php

    if(isset($_POST['cadastrar'])){
        $sit_pres    = trim(strip_tags($_POST["sit_pres"])); 
        $data_pres   = trim(strip_tags($_POST["data_pres"]));
        $mat_id_pres = trim(strip_tags($_POST["mat_id_pres"])); 
        $acad_id_pres = trim(strip_tags($_POST["acad_id_pres"]));


            $insert = "INSERT into presenca ( sit_pres, data_pres, mat_id_pres, acad_id_pres ) 
            VALUES ( :sit_pres, :data_pres, :mat_id_pres, :acad_id_pres )";  
        try{
            $result = $conexao->prepare($insert);
            $result ->bindParam(':sit_pres',$sit_pres, PDO::PARAM_STR);
            $result ->bindParam(':data_pres',$data_pres, PDO::PARAM_STR);
            $result ->bindParam(':mat_id_pres',$mat_id_pres, PDO::PARAM_INT);
            $result ->bindParam(':acad_id_pres',$acad_id_pres, PDO::PARAM_INT);
            $result ->execute();
            $contar = $result->rowCount();

        if($contar>0){
            echo '<div class="alert alert-success">
                <button type="button" class="close" data-dismiss="alert">x</button>
                <strong> Inserido com Sucesso!</strong> 
                </div>'; 
                header("Refresh: 1, home.php?acao=presencas&id_mat=$id_mat");
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