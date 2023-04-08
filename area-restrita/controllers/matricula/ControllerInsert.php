<?php

    if(isset($_POST['cadastrar'])){
        $insc_mat  = trim(strip_tags($_POST["insc_mat"])); 
        $whats_mat  = trim(strip_tags($_POST["whats_mat"]));
        $pag_mat  = trim(strip_tags($_POST["pag_mat"]));
        $acad_id_mat  = trim(strip_tags($_POST["acad_id_mat"])); 
        $curso_id_mat  = trim(strip_tags($_POST["curso_id_mat"])); 
        $est_id_mat  = trim(strip_tags($_POST["est_id_mat"])); 
        $data_cad_mat  = trim(strip_tags($_POST["data_cad_mat"]));
        $hosp_id_mat  = trim(strip_tags($_POST["hosp_id_mat"])); 
 

        $insert = "INSERT into matricula ( insc_mat, whats_mat, pag_mat, acad_id_mat, curso_id_mat, data_cad_mat, est_id_mat, hosp_id_mat  ) 
        VALUES ( :insc_mat, :whats_mat, :pag_mat, :acad_id_mat, :curso_id_mat, :data_cad_mat, :est_id_mat, :hosp_id_mat  )";  

        try{
            $result = $conexao->prepare($insert);
            $result ->bindParam(':insc_mat',$insc_mat, PDO::PARAM_STR);
            $result ->bindParam(':whats_mat',$whats_mat, PDO::PARAM_STR);
            $result ->bindParam(':pag_mat',$pag_mat, PDO::PARAM_STR);
            $result ->bindParam(':acad_id_mat',$acad_id_mat, PDO::PARAM_INT);
            $result ->bindParam(':curso_id_mat',$curso_id_mat, PDO::PARAM_INT);
            $result ->bindParam(':est_id_mat',$est_id_mat, PDO::PARAM_INT);
            $result ->bindParam(':data_cad_mat',$data_cad_mat, PDO::PARAM_STR);
            $result ->bindParam(':hosp_id_mat',$hosp_id_mat, PDO::PARAM_INT);

            $result ->execute();
            $contar = $result->rowCount();

        if($contar>0){
            echo '<br />
            <div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert">x</button>
            <strong> Cadastrado com Sucesso!</strong> 
            </div>'; 
            header("Refresh: 1, home.php?acao=matriculas");
        }else{
            echo '<br />
            <div class="alert alert-warning">
            <button type="button" class="close" data-dismiss="alert">x</button>
            <strong>Não foi efetuado de forma correta!</strong> 
            </div>';
        }
        
        }catch(PDOException $e){
            echo $e;
        }                           

    }
    
?>