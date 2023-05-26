<?php

    if(isset($_POST['cadastrar'])){
        $nome_est   = trim(strip_tags($_POST["nome_est"])); 
        $valor_est  = trim(strip_tags($_POST["valor_est"]));
        $valor_desc_est = trim(strip_tags($_POST["valor_desc_est"])); 
        $hosp_id_est = trim(strip_tags($_POST["hosp_id_est"]));
        $desc_est   = $_POST["desc_est"];
        $edital_est  = $_POST["edital_est"];
        $ativo_est   = trim(strip_tags($_POST["ativo_est"])); 
        $nota_med_est = trim(strip_tags($_POST["nota_med_est"])); 
        $exc_est   = trim(strip_tags($_POST["exc_est"]));
        $vagas_est   = trim(strip_tags($_POST["vagas_est"]));
        $link_valor_est  = $_POST["link_valor_est"];
        $val_pix_est   = trim(strip_tags($_POST["val_pix_est"]));
        $chave_pix_est  = $_POST["chave_pix_est"];
        $link_huber_est  = $_POST["link_huber_est"]; 
        $link_prova_est  = $_POST["link_prova_est"];             
        $data_inicio_est  = trim(strip_tags($_POST["data_inicio_est"])); 
        $data_termino_est  = trim(strip_tags($_POST["data_termino_est"])); 
        $treinamento  = trim(strip_tags($_POST["treinamento"]));     
        $usuario = trim(strip_tags($_POST["usuario_id"])); 

            $insert = "INSERT into estagio ( nome_est, valor_est, valor_desc_est, hosp_id_est, ativo_est, nota_med_est, 
            exc_est, vagas_est, desc_est, edital_est, link_valor_est, val_pix_est, chave_pix_est, link_huber_est, link_prova_est, data_inicio_est, data_termino_est, usuario_id ) 
            VALUES ( :nome_est, :valor_est, :valor_desc_est, :hosp_id_est, :ativo_est, :nota_med_est, :exc_est, :vagas_est, 
            :desc_est, :edital_est, :link_valor_est, :val_pix_est, :chave_pix_est, :link_huber_est, :link_prova_est, :data_inicio_est, :data_termino_est, :usuario_id)";  
        try{
            $result = $conexao->prepare($insert);
            $result ->bindParam(':nome_est',$nome_est, PDO::PARAM_STR);
            # $result ->bindParam(':treinamento',$treinamento, PDO::PARAM_STR);
            $result ->bindParam(':valor_est',$valor_est, PDO::PARAM_STR);
            $result ->bindParam(':valor_desc_est',$valor_desc_est, PDO::PARAM_STR);
            $result ->bindParam(':hosp_id_est',$hosp_id_est, PDO::PARAM_INT);
            $result ->bindParam(':desc_est',$desc_est, PDO::PARAM_STR);
            $result ->bindParam(':edital_est',$edital_est, PDO::PARAM_STR);
            $result ->bindParam(':ativo_est',$ativo_est, PDO::PARAM_STR);
            $result ->bindParam(':nota_med_est',$nota_med_est, PDO::PARAM_STR);
            $result ->bindParam(':exc_est',$exc_est, PDO::PARAM_STR);
            $result ->bindParam(':vagas_est',$vagas_est, PDO::PARAM_STR);
            $result ->bindParam(':link_valor_est',$link_valor_est, PDO::PARAM_STR);
            $result ->bindParam(':val_pix_est',$val_pix_est, PDO::PARAM_STR);
            $result ->bindParam(':chave_pix_est',$chave_pix_est, PDO::PARAM_STR);
            $result ->bindParam(':link_huber_est',$link_huber_est, PDO::PARAM_STR);
            $result ->bindParam(':link_prova_est',$link_prova_est, PDO::PARAM_STR);
            $result ->bindParam(':data_inicio_est',$data_inicio_est, PDO::PARAM_STR);
            $result ->bindParam(':data_termino_est',$data_termino_est, PDO::PARAM_STR);
            $result ->bindParam(':usuario_id',$usuario, PDO::PARAM_STR);
            $result ->execute();
            $contar = $result->rowCount();

        if($contar>0){
            echo '<div class="alert alert-success">
                <button type="button" class="close" data-dismiss="alert">x</button>
                <strong> Inserido com Sucesso!</strong> 
                </div>'; 
            header("Refresh: 1, home.php?acao=estagios");
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