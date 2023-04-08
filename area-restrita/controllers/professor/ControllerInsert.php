<<<<<<< HEAD
<?php

    if(isset($_POST['cadastrar'])){
        $nome_prof   = trim(strip_tags($_POST["nome_prof"])); 
        $email_prof  = trim(strip_tags($_POST["email_prof"]));
        $whats_prof  = trim(strip_tags($_POST["whats_prof"]));              
        $link_cv_lates_prof  = $_POST["link_cv_lates_prof"];  
        $desc_prof  = $_POST["desc_prof"];  

            $insert = "INSERT into professor ( nome_prof, email_prof, whats_prof, link_cv_lates_prof, desc_prof ) 
            VALUES ( :nome_prof, :email_prof, :whats_prof,:link_cv_lates_prof, :desc_prof )";  
        try{
            $result = $conexao->prepare($insert);
            $result ->bindParam(':nome_prof',$nome_prof, PDO::PARAM_STR);
            $result ->bindParam(':email_prof',$email_prof, PDO::PARAM_STR);
            $result ->bindParam(':whats_prof',$whats_prof, PDO::PARAM_STR);
            $result ->bindParam(':link_cv_lates_prof',$link_cv_lates_prof, PDO::PARAM_STR);
            $result ->bindParam(':desc_prof',$desc_prof, PDO::PARAM_STR);
            $result ->execute();
            $contar = $result->rowCount();

        if($contar>0){
            echo '<div class="alert alert-success">
                <button type="button" class="close" data-dismiss="alert">x</button>
                <strong> Inserido com Sucesso!</strong> 
                </div>'; 
            header("Refresh: 1, home.php?acao=professores");
        }else{
            echo '<div class="alert alert-warning">
                <button type="button" class="close" data-dismiss="alert">x</button>
                <strong> O Conteúdo não foi inserido de forma correta!</strong> 
                </div>';
        }
        
        }catch(PDOException $e){
            //echo $e;
        }                           

    }
    
=======
<?php

    if(isset($_POST['cadastrar'])){
        $nome_prof   = trim(strip_tags($_POST["nome_prof"])); 
        $email_prof  = trim(strip_tags($_POST["email_prof"]));
        $whats_prof  = trim(strip_tags($_POST["whats_prof"]));              
        $link_cv_lates_prof  = $_POST["link_cv_lates_prof"];  
        $desc_prof  = $_POST["desc_prof"];  

            $insert = "INSERT into professor ( nome_prof, email_prof, whats_prof, link_cv_lates_prof, desc_prof ) 
            VALUES ( :nome_prof, :email_prof, :whats_prof,:link_cv_lates_prof, :desc_prof )";  
        try{
            $result = $conexao->prepare($insert);
            $result ->bindParam(':nome_prof',$nome_prof, PDO::PARAM_STR);
            $result ->bindParam(':email_prof',$email_prof, PDO::PARAM_STR);
            $result ->bindParam(':whats_prof',$whats_prof, PDO::PARAM_STR);
            $result ->bindParam(':link_cv_lates_prof',$link_cv_lates_prof, PDO::PARAM_STR);
            $result ->bindParam(':desc_prof',$desc_prof, PDO::PARAM_STR);
            $result ->execute();
            $contar = $result->rowCount();

        if($contar>0){
            echo '<div class="alert alert-success">
                <button type="button" class="close" data-dismiss="alert">x</button>
                <strong> Inserido com Sucesso!</strong> 
                </div>'; 
            header("Refresh: 1, home.php?acao=professores");
        }else{
            echo '<div class="alert alert-warning">
                <button type="button" class="close" data-dismiss="alert">x</button>
                <strong> O Conteúdo não foi inserido de forma correta!</strong> 
                </div>';
        }
        
        }catch(PDOException $e){
            //echo $e;
        }                           

    }
    
>>>>>>> dbb2c73f370ca8a6d55f2c45adc576d179ae3650
?>