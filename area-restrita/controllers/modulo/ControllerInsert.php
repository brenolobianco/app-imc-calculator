<<<<<<< HEAD
<?php

    if(isset($_POST['cadastrar'])){
        $nome_mod  = trim(strip_tags($_POST["nome_mod"])); 
        $est_id_mod = trim(strip_tags($_POST["est_id_mod"])); 
        $curso_id_mod  = trim(strip_tags($_POST["curso_id_mod"])); 
        $desc_mod  = $_POST["desc_mod"];  
        $est_id_mod_treinamento  = $_POST["est_id_mod_treinamento"];
        $treinamento = null;
        if($est_id_mod_treinamento) {
            $est_id_mod = $est_id_mod_treinamento;
            $treinamento = "sim";
        }

            $insert = "INSERT into modulo ( nome_mod, est_id_mod, curso_id_mod, desc_mod, treinamento ) 
            VALUES ( :nome_mod, :est_id_mod, :curso_id_mod, :desc_mod, :treinamento )";  
            if($treinamento == "sim") {
                $insert = "INSERT into modulo ( nome_mod, est_id_mod, desc_mod, treinamento ) 
                VALUES ( :nome_mod, :est_id_mod, :desc_mod, :treinamento )";  
                    
            }            
        try{
            $result = $conexao->prepare($insert);
            $result ->bindParam(':nome_mod',$nome_mod, PDO::PARAM_STR);
            $result ->bindParam(':est_id_mod',$est_id_mod, PDO::PARAM_INT);
            if($treinamento != "sim") {
                $result ->bindParam(':curso_id_mod',$curso_id_mod, PDO::PARAM_INT);
            }
            $result ->bindParam(':desc_mod',$desc_mod, PDO::PARAM_STR);
            $result ->bindParam(':treinamento', $treinamento, PDO::PARAM_STR);
            $result ->execute();
            $contar = $result->rowCount();

        if($contar>0){
            echo '<div class="alert alert-success">
                <button type="button" class="close" data-dismiss="alert">x</button>
                <strong> Inserido com Sucesso!</strong> 
                </div>';
                header("Refresh: 1, home.php?acao=modulos"); 
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
    
=======
<?php

    if(isset($_POST['cadastrar'])){
        $nome_mod  = trim(strip_tags($_POST["nome_mod"])); 
        $est_id_mod = trim(strip_tags($_POST["est_id_mod"])); 
        $curso_id_mod  = trim(strip_tags($_POST["curso_id_mod"])); 
        $desc_mod  = $_POST["desc_mod"];  
        $est_id_mod_treinamento  = $_POST["est_id_mod_treinamento"];
        $treinamento = null;
        if($est_id_mod_treinamento) {
            $est_id_mod = $est_id_mod_treinamento;
            $treinamento = "sim";
        }

            $insert = "INSERT into modulo ( nome_mod, est_id_mod, curso_id_mod, desc_mod, treinamento ) 
            VALUES ( :nome_mod, :est_id_mod, :curso_id_mod, :desc_mod, :treinamento )";  
            if($treinamento == "sim") {
                $insert = "INSERT into modulo ( nome_mod, est_id_mod, desc_mod, treinamento ) 
                VALUES ( :nome_mod, :est_id_mod, :desc_mod, :treinamento )";  
                    
            }            
        try{
            $result = $conexao->prepare($insert);
            $result ->bindParam(':nome_mod',$nome_mod, PDO::PARAM_STR);
            $result ->bindParam(':est_id_mod',$est_id_mod, PDO::PARAM_INT);
            if($treinamento != "sim") {
                $result ->bindParam(':curso_id_mod',$curso_id_mod, PDO::PARAM_INT);
            }
            $result ->bindParam(':desc_mod',$desc_mod, PDO::PARAM_STR);
            $result ->bindParam(':treinamento', $treinamento, PDO::PARAM_STR);
            $result ->execute();
            $contar = $result->rowCount();

        if($contar>0){
            echo '<div class="alert alert-success">
                <button type="button" class="close" data-dismiss="alert">x</button>
                <strong> Inserido com Sucesso!</strong> 
                </div>';
                header("Refresh: 1, home.php?acao=modulos"); 
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
    
>>>>>>> dbb2c73f370ca8a6d55f2c45adc576d179ae3650
?>